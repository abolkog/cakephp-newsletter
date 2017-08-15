<?php
namespace Newsletter\Controller;

use Newsletter\Controller\AppController;

/**
 * Campaigns Controller
 *
 * @property \newsletter\Model\Table\CampaignsTable $Campaigns
 */

class CampaignsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups', 'Templates']
        ];
        $campaigns = $this->paginate($this->Campaigns);

        $this->set(compact('campaigns'));
        $this->set('_serialize', ['campaigns']);
    }

    /**
     * View method
     *
     * @param string|null $id Campaign id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $campaign = $this->Campaigns->get($id, [
            'contain' => ['Groups', 'Templates']
        ]);

        if ($this->request->is('post')) {
            $this->_startCampaign($id);
        }
        $this->set(compact('campaign'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $campaign = $this->Campaigns->newEntity();
        if ($this->request->is('post')) {
            $campaign = $this->Campaigns->patchEntity($campaign, $this->request->getData());
            $campaign->status = 1;
            if ($this->Campaigns->save($campaign)) {
                $this->Flash->success(__('The campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campaign could not be saved. Please, try again.'));
        }
        $groups = $this->Campaigns->Groups->find('list', ['limit' => 200]);
        $templates = $this->Campaigns->Templates->find('list', ['limit' => 200]);
        $this->set(compact('campaign', 'groups', 'templates'));
        $this->set('_serialize', ['campaign']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Campaign id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $campaign = $this->Campaigns->get($id, [
            'contain' => []
        ]);

        if($campaign->status > 1) {
            $this->Flash->error(__('You cannot edit a campaign while its being sent'));
            return $this->redirect(['action'=>'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {

            $campaign = $this->Campaigns->patchEntity($campaign, $this->request->getData());
            if ($this->Campaigns->save($campaign)) {
                $this->Flash->success(__('The campaign has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The campaign could not be saved. Please, try again.'));
        }
        $groups = $this->Campaigns->Groups->find('list', ['limit' => 200]);
        $templates = $this->Campaigns->Templates->find('list', ['limit' => 200]);
        $this->set(compact('campaign', 'groups', 'templates'));
        $this->set('_serialize', ['campaign']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Campaign id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $campaign = $this->Campaigns->get($id);
        if ($this->Campaigns->delete($campaign)) {
            $this->Flash->success(__('The campaign has been deleted.'));
        } else {
            $this->Flash->error(__('The campaign could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function createClone($id = null){
        $this->request->allowMethod(['post']);
        $campaign = $this->Campaigns->get($id, ['contain'=>[]]);
        if(!$campaign) {
            $this->Flash->error(__('Invalid Link'));
            return $this->redirect(['action'=>'index']);
        }

        $clone = $this->Campaigns->newEntity($campaign->toArray());;
        $clone->subject = $clone->subject.' cloned';
        $clone->status = 1;
        $clone->completed = null;

        if ($this->Campaigns->save($clone)) {
            $this->Flash->success(__('The campaign was cloned successfully'));
        }else{
            $this->Flash->error(__('Error cloning the campaign'));
        }
        return $this->redirect(['action'=>'index']);
    }

    /**
     * Preview Template Design
     * @param $id
     */
    public function preview($id) {
        $this->viewBuilder()->setLayout('ajax');
        $campaign = $this->Campaigns->get($id, [
            'contain' => ['Templates']
        ]);
        $contents = null;
        if($campaign->template) {
            $contents = str_ireplace("%contents%",$campaign->contents, $campaign->template->body);
        } else {
            $contents = $campaign->contents;
        }
        $this->set('contents', $contents);
    }

    /**
     * Start The campaign and queue all the emails
     *
     * @param null $id the Campagin id
     * @return \Cake\Http\Response|null
     */
    private function _startCampaign($id = null) {
        $campaign = $this->Campaigns->get($id, [
            'contain' => ['Templates']
        ]);

        if(!$campaign) {
            $this->Flash->error('Invalid Campaign');
            return $this->redirect(['action'=>'index']);
        }

        if($campaign->status > 1 ) {
            $this->Flash->error('Campaign is already on going or completed');
            return $this->redirect(['action'=>'index']);
        }

        $subscribers = $this->_getSubsribersData($campaign->group_id);

        if ($subscribers->count() == 0 ) {
            $this->Flash->error('NewsLetter has 0 subsribers');
            return $this->redirect(['action'=>'index']);
        }

        $contents = null;
        if($campaign->template) {
            $contents = str_ireplace("%contents%",$campaign->contents, $campaign->template->body);
        } else {
            $contents = $campaign->contents;
        }


        $this->loadModel('Messages');
        foreach ($subscribers as $subscriber) {
            $message = $this->Messages->newEntity();
            $message->sender = $campaign->sender_email.','.$campaign->sender_name;
            $message->email = $subscriber->subscriber->email;
            $message->subject = $campaign->subject;
            $message->contents = $contents;
            $message->attempts = 0;
            $message->send = false;
            $message->created = date('Y-m-d H:i:s');
            $message->campaign_id = $campaign->id;
            $this->Messages->save($message);
        }


        $campaign->status = 2;
        $this->Campaigns->save($campaign);

        $this->Flash->success('Campaign has started successfully ....');
        $this->redirect(['action'=>'view', $campaign->id]);



    }

    /**
     * Get a mailing list subscribers
     *
     * @param $newsLetterId the mailing list id
     * @return \Cake\ORM\Query
     */
    private function _getSubsribersData($newsLetterId) {
        $subscribers = $this->Campaigns->Groups->Subscriptions->find('all',[
            'conditions'=>['Subscriptions.group_id'=>$newsLetterId],
            'contain'=>['Subscribers']
        ]);

        return $subscribers;
    }
}
