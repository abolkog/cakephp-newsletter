<?php
namespace Newsletter\Controller;

use Newsletter\Controller\AppController;

/**
 * Subscriptions Controller
 *
 * @property \newsletter\Model\Table\SubscriptionsTable $Subscriptions
 *
 * @method \newsletter\Model\Entity\Subscription[] paginate($object = null, array $settings = [])
 */
class SubscriptionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups', 'Subscribers']
        ];
        $subscriptions = $this->paginate($this->Subscriptions);

        $this->set(compact('subscriptions'));
        $this->set('_serialize', ['subscriptions']);
    }

    /**
     * View method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subscription = $this->Subscriptions->get($id, [
            'contain' => ['Groups', 'Subscribers']
        ]);

        $this->set('subscription', $subscription);
        $this->set('_serialize', ['subscription']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subscription = $this->Subscriptions->newEntity();
        if ($this->request->is('post')) {
            $subscription = $this->Subscriptions->patchEntity($subscription, $this->request->getData());
            if ($this->Subscriptions->save($subscription)) {
                $this->Flash->success(__('The subscription has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
        }
        $groups = $this->Subscriptions->Groups->find('list', ['limit' => 200]);
        $subscribers = $this->Subscriptions->Subscribers->find('list', ['limit' => 200]);
        $this->set(compact('subscription', 'groups', 'subscribers'));
        $this->set('_serialize', ['subscription']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subscription = $this->Subscriptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscription = $this->Subscriptions->patchEntity($subscription, $this->request->getData());
            if ($this->Subscriptions->save($subscription)) {
                $this->Flash->success(__('The subscription has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription could not be saved. Please, try again.'));
        }
        $groups = $this->Subscriptions->Groups->find('list', ['limit' => 200]);
        $subscribers = $this->Subscriptions->Subscribers->find('list', ['limit' => 200]);
        $this->set(compact('subscription', 'groups', 'subscribers'));
        $this->set('_serialize', ['subscription']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscription id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subscription = $this->Subscriptions->get($id);
        if ($this->Subscriptions->delete($subscription)) {
            $this->Flash->success(__('The subscription has been deleted.'));
        } else {
            $this->Flash->error(__('The subscription could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
