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
}
