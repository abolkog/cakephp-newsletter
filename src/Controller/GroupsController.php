<?php
namespace Newsletter\Controller;

use Newsletter\Controller\AppController;

/**
 * Groups Controller
 *
 * @property \newsletter\Model\Table\GroupsTable $Groups

 */
class GroupsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Paginator->setConfig(['limit'=>10]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $groups = $this->paginate($this->Groups);
        $this->set(compact('groups'));
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $group = $this->Groups->get($id);

        $subscribers = $this->Groups->Subscriptions->find('all',[
            'conditions'=>['Subscriptions.group_id'=>$id],
            'contain'=>['Subscribers']
        ]);

        $this->set(compact('group','subscribers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The mailing list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mailing list could not be saved. Please, try again.'));
        }
        $this->set(compact('group'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->getData());
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The mailing list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mailing list could not be saved. Please, try again.'));
        }
        $this->set(compact('group'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The mailing list has been deleted.'));
        } else {
            $this->Flash->error(__('The mailing list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add a subscriber to the mailing list
     *
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function addSubscriber($id = null)
    {
        $group = $this->Groups->get($id);
        $subscribers = $this->Groups->Subscriptions->Subscribers->find('list');


        $subscription = $this->Groups->Subscriptions->newEntity();
        $subscription->group_id = $group->id;
        if($this->request->is('post')) {
            if(!$this->_alreadySubscribed($this->request->getData('subscriber_id'),$group->id)) {
                $subscription = $this->Groups->Subscriptions->patchEntity($subscription, $this->request->getData());
                if($this->Groups->Subscriptions->save($subscription)) {
                    $this->Flash->success("The user has been added to mailing list");
                    return $this->redirect(['action'=>'view', $group->id]);
                }else {
                    $this->Flash->error(__('An error occurred please try again'));
                }
            }else{
                $this->Flash->error(__("This user already a member of the list [$group->title]"));
            }
        }

        $this->set(compact('group','subscribers','subscription'));

    }

    /**
     * Remove Subscriber from list
     */
    public function removeFromList($subscriberId, $groupId){
        $this->request->allowMethod(['post', 'delete']);
        $subscription = $this->Groups->Subscriptions->find('all',[
            'conditions'=>[
                'AND'=>[
                    'group_id'=>$groupId,
                    'subscriber_id'=>$subscriberId
                ]
            ]
        ])->first();


        if ($this->Groups->Subscriptions->delete($subscription)) {
            $this->Flash->success(__('Removed successfully'));
        }else {
            $this->Flash->error(__('An error occurred please try again'));
        }

        $this->redirect(['action'=>'view',$groupId]);
    }


    /**
     * Import Subscribers from file
     * @param $id
     */
    public function importSubscriber($id)
    {
        $group = $this->Groups->get($id);

        if($this->request->is('post')) {
            $file = $this->request->getData('listfile');
            if($file['type'] != 'text/csv') {
                $this->Flash->error('Only CSV file are accepted');
            }else if($file['error']) {
                $this->Flash->error('Cannot read this file');
            }else if($file['size'] == 0) {
                $this->Flash->error('File is empty !');
            }
            else {
                $this->_parseFile($id, $file);
            }

        }

        $this->set(compact('group'));

    }

    /**
     * Parse the file and save the subscribers informations
     * @param $groupId
     * @param $file
     * @return \Cake\Http\Response|null
     */
    private function _parseFile($groupId, $file) {
        $counter = 0;
        $saved   = 0;
        $new     = 0;
        if (($handle = fopen($file['tmp_name'], "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $counter++;

                $name = $data[0];
                $email = $data[1];

                $saveResult = $this->_saveSubsriber($name, $email);
                if ($saveResult['new']) {
                    $new++;
                }

                $subscription = $this->Groups->Subscriptions->newEntity();
                $subscriberDetails = $saveResult['info'];
                if(!$this->_alreadySubscribed($subscriberDetails->id, $groupId)) {
                    $subscription->group_id = $groupId;
                    $subscription->subscriber_id = $subscriberDetails->id;
                    if($this->Groups->Subscriptions->save($subscription)) {
                        $saved++;
                    }
                }

            }
        }else {
            $this->Flash->error('Failed to read the file, please try again');
        }

        if($counter > 1) {
            $ignored = $counter - $saved;
            $message = __("Successfully Imported. Total Records in the file [{0}]. 
                Total New Subscribers [{1}]. New Subscribers added toe mailing list [{2}]. Total Ignored because already subscribred [{3}]", $counter, $new, $saved, $ignored);
            $this->Flash->success($message);
        }else {
            $this->Flash->error("Failed to import.");
        }

        return $this->redirect(['action'=>'view',$groupId]);
    }

    /**
     * Save Single Entry from the file
     * @param $name
     * @param $email
     * @return array
     */
    private function _saveSubsriber($name, $email) {
        $result = [];
        $subscribersModel = $this->Groups->Subscriptions->Subscribers;
        $subscriber = $subscribersModel->find('all', [
            'conditions'=> ['Subscribers.email'=>$email]
        ])->first();

        if($subscriber) {
            $result['new'] = false;
            $result['info'] = $subscriber;
        }else {
            $subscriber = $subscribersModel->newEntity();
            $subscriber->email = $email;
            $subscriber->name = $name;
            $subscribersModel->save($subscriber); //Assume it is saved lol.
            $result['new'] = true;
            $result['info'] = $subscriber;
        }

        return $result;
    }

    private function _alreadySubscribed($userId, $listId) {
        return $this->Groups->Subscriptions->find('all',[
                'conditions'=>[
                    'AND'=>[
                        'subscriber_id'=>$userId,
                        'group_id'=>$listId
                    ]
                ]
            ])->first() != null;
    }
}
