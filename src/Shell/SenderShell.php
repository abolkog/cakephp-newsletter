<?php

namespace Newsletter\Shell;

use Cake\Console\Shell;
use Cake\Mailer\Email;

/**
 * Sender Shell. Process the emails queue
 *
 * @property \NewsLetter\Model\Table\MessagesTable $Messages
 * @property \NewsLetter\Model\Table\CampaignsTable $Campaigns
 * @package Newsletter\Shell
 */


class SenderShell extends Shell {

//    public $modelClass = 'Newsletter.Messages';

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Newsletter.Campaigns');
        $this->loadModel('Newsletter.Messages');
    }

    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser
            ->setDescription('[Newsletter.Sender] Process and Send out Campaign Emails')
            ->addOption('limit',[
                'short'=>'l',
                'help'=>'How many emails should be sent per batch',
                'default'=>50
            ])
            ->addSubcommands([
                'run'=>[
                    'help'=>'Start processing the campaign emails',
                ],
                'show'=>[
                    'help'=>'Show Current Emails in the queue',
                ],
                'delete'=>[
                    'help'=>'Delete all emails (even if they are not processed)'
                ]
            ]);

        return $parser;
    }

    /**
     * Start Sending the emails
     */
    public function run(){
        $this->out('[' . date('Y-m-d H:i:s') . '] Processing Emails ...');
        $limit = $this->params['limit'];
        $emails = $this->_getEmails($limit);
        $this->out('Emails found are: '.$emails->count());

        foreach ($emails as $email){
            $success = $this->_process($email);
            if($success) {
                $this->Messages->success($email->id);
            }else{
                $this->Messages->fail($email->id, $email->attempts);
            }
        }

        $this->_updateStatus() ;

        $this->_clean();

        $this->out('[' . date('Y-m-d H:i:s') . '] Done Processing.');
    }


    public function show(){
        $this->out('[' . date('Y-m-d H:i:s') . '] Fetching Queued Emails ...');
        $limit = $this->params['limit'];
        $emails = $this->_getEmails($limit);
        $this->out('Current Queue count is: '.$emails->count());
        $this->out();
        $mask = "|%2s | %-70s | %-30s | %-9s | %-5s \n";
        printf($mask, 'ID', 'Subject', 'To','Attempts','Created');
        foreach ($emails as $email){
            printf($mask, $email->id,
                $email->subject, $email->email,
                $email->attempts  ,
                $email->created);
        }
    }

    public function delete() {
        $this->out('[Warning] This command will delete all emails regardless of the status (sent or no)');
        $answer = readline("Do you want to continue? [y/n]");
        if(strtolower($answer) == 'y') {
            $this->Messages->deleteAll(['1 =1']);
            $this->out('All emails has been deleted');
        }
    }

    /**
     * Process sending the email
     * @param $email
     */
    private function _process($email) {
        $from = explode(',',$email->sender);
        $mailer = new Email();
//        $mailer->setDomain("");
        $mailer->setEmailFormat('html');
        $mailer->setTo($email->email);
        $mailer->setSubject($email->subject);
        $mailer->setSender($from[0], $from[1]);
        return $mailer->send($email->contents);
    }

    /**
     * Update Campaign Status
     */
    private function _updateStatus() {
        $readyCampaigns = $this->Campaigns->find('all', [
            'conditions'=> ['Campaigns.status'=>2]
        ]);

        foreach ($readyCampaigns as $current ) {
            $messages = $this->Messages->find('all', ['conditions'=>['Messages.campaign_id'=>$current->id]]);
            $sent     = $this->Messages->find('all', [
                'conditions'=> [
                    'AND'=> [
                        'Messages.campaign_id'=>$current->id,
                        'Messages.sent'=>true
                    ]
                ]
            ]);
            if ($messages->count() == $sent->count()) {
                $this->Campaigns->completed($current->id);
            }

        }
    }

    /**
     * Remove sent email from the queue
     */
    public function _clean(){
        $completed = $this->Campaigns->find('all', [
            'conditions'=> ['Campaigns.status ='=>3]
        ]);

        foreach ($completed as $current ) {
            $this->Messages->deleteAll(['campaign_id'=>$current->id]);
        }
    }

    private function _getEmails($limit = 50){
        return $this->Messages->find('all',[
            'conditions'=>[
                'AND'=>[
                    'sent'=>false,
                    'attempts < 3'
                ]
            ],
            'limit'=>$limit
        ]);
    }
}
