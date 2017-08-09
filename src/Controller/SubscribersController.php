<?php
namespace Newsletter\Controller;

use Newsletter\Controller\AppController;

/**
 * Subscribers Controller
 *
 * @property \newsletter\Model\Table\SubscribersTable $Subscribers
 *
 */
class SubscribersController extends AppController
{



    /**
     * Handles the Subscriber form (Subscriber Widget)
     */
    public function subscribe()
    {
        $this->request->allowMethod(['post']);
        $subscriber = $this->Subscribers->newEntity();
        $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->getData());
        if($this->Subscribers->save($subscriber)) {
            $lists = $this->Subscribers->Subscriptions->Groups->find('all');
            foreach ($lists as $list) {
                $this->_saveSubscriptions($list->id, $subscriber->id); // Assume Saved again
            }
            $this->Flash->success(__('Thank you, you have successfully subscibred to our mailing list'));
        }else {
            $this->Flash->success(__('Error, please try again'));
        }

        return $this->redirect(['controller'=>'pages','action'=>'display','plugin'=>false]);
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $subscribers = $this->Subscribers->find('all',[
            'order'=>['created DESC']
        ]);
        $this->set('subscribers', $this->Paginator->paginate($subscribers));
    }

    /**
     * View method
     *
     * @param string|null $id Subscriber id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subscriber = $this->Subscribers->get($id);
        $lists = $this->Subscribers->Subscriptions->find('all',[
            'conditions' => ['Subscriptions.subscriber_id' => $subscriber->id],
            'contain'=> ['Groups'],
        ]);

        $this->set(compact('subscriber','lists'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subscriber = $this->Subscribers->newEntity();
        if ($this->request->is('post')) {
            $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->getData());
            if ($this->Subscribers->save($subscriber)) {
                $this->Flash->success(__('The subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscriber could not be saved. Please, try again.'));
        }
        $this->set(compact('subscriber'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subscriber id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subscriber = $this->Subscribers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->getData());
            if ($this->Subscribers->save($subscriber)) {
                $this->Flash->success(__('The subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscriber could not be saved. Please, try again.'));
        }
        $this->set(compact('subscriber'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscriber id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subscriber = $this->Subscribers->get($id);
        if ($this->Subscribers->delete($subscriber)) {
            $this->Flash->success(__('The subscriber has been deleted.'));
        } else {
            $this->Flash->error(__('The subscriber could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     *
     * Add a subscriber to a Mailing list
     * @param null $id Subscriber Id
     */
    public function addToList($id = null) {
        $subscriber = $this->Subscribers->get($id);
        if(!$subscriber) {
            $this->Flash->error(__('Invalid Subscriber Id'));
            return $this->redirect(['action'=>'index']);
        }

        $subscription = $this->Subscribers->Subscriptions->newEntity();
        $subscription->subscriber_id = $subscriber->id;
        if($this->request->is('post')) {
            $selectedMailingListId = $this->request->getData('group_id');
            if(!$this->_alreadySubscribed($subscriber->id, $selectedMailingListId)) {
                $subscription = $this->Subscribers->Subscriptions->patchEntity($subscription, $this->request->getData());
                if($this->Subscribers->Subscriptions->save($subscription)) {
                    $this->Flash->success("$subscriber->name has been added to the mailing list");
                    return $this->redirect(['action'=>'view', $subscriber->id]);
                }else {
                    $this->Flash->error(__('An error occurred please try again'));
                }
            }else{
                $this->Flash->error(__('This user already a member of the selected mailing list'));
            }
        }

        $groups = $this->Subscribers->Subscriptions->Groups->find('list');
        $this->set(compact('groups','subscriber','subscription'));
    }

    /**
     * Remove Subscriber from list
     */
    public function removeFromList($subscriberId, $newsLetterId){
        $this->request->allowMethod(['post', 'delete']);
        $subscription = $this->Subscribers->Subscriptions->find('all',[
            'conditions'=>[
                'AND'=>[
                    'group_id'=>$newsLetterId,
                    'subscriber_id'=>$subscriberId
                ]
            ]
        ])->first();


        if ($this->Subscribers->Subscriptions->delete($subscription)) {
            $this->Flash->success(__('Removed successfully'));
        }else {
            $this->Flash->error(__('An error occurred please try again'));
        }

        $this->redirect(['action'=>'view',$subscriberId]);
    }

    /**
     * Check if the User already a member of the selected mailing list
     * @param $userId subscriber Id
     * @param $listId mailing list id
     * @return bool true if already subscribed, false otherwise
     */
    private function _alreadySubscribed($userId, $listId) {
        return $this->Subscribers->Subscriptions->find('all',[
                'conditions'=>[
                    'AND'=>[
                        'subscriber_id'=>$userId,
                        'group_id'=>$listId
                    ]
                ]
            ])->first() != null;
    }

    private function _saveSubscriptions($groupId, $subscriberId) {
        $subscription = $this->Subscribers->Subscriptions->newEntity();
        $subscription->subscriber_id = $subscriberId;
        $subscription->group_id = $groupId;
        return $this->Subscribers->Subscriptions->save($subscription);
    }
}
