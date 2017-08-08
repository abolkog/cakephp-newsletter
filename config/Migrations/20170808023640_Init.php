<?php
use Migrations\AbstractMigration;

class Init extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->_createGroupsTable();

        $this->_createSubscribersTable();

        $this->_createSubscriptionTable();

        $this->_createTemplatesTable();

        $this->_createCampaignsTable();

        $this->_createMessagesTable();
    }

    /**
     * Create the Group Table (Mailing Lists)
     */
    private function _createGroupsTable() {
        $tableName = "groups";

        $table = $this->table($tableName);

        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->create();

    }

    /**
     * Subscribers Table
     */
    private function _createSubscribersTable() {
        $tableName = "subscribers";
        $table = $this->table($tableName);

        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->create();
    }

    /**
     * Subscription Table
     */
    private function _createSubscriptionTable() {
        $tableName = "subscriptions";
        $table = $this->table($tableName);

        $table->addColumn('group_id', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
        ]);

        $table->addColumn('subscriber_id', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
        ]);

        $table->create();
    }

    /**
     * Create Templates Table
     */
    private function _createTemplatesTable() {
        $tableName = "templates";
        $table = $this->table($tableName);

        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->create();
    }

    /**
     * Create Campaigns Tables
     */
    private function _createCampaignsTable(){

        $table = $this->table('campaigns');

        $table->addColumn('subject', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('sender', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);

        $table->addColumn('contents', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('group_id', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
        ]);

        $table->addColumn('template_id', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => true,
        ]);


        $table->addColumn('status', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('completed', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->create();

    }
    /**
     * Create Messges Table
     */
    private function _createMessagesTable() {
        $tableName = "messages";

        $table = $this->table($tableName);

        $table->addColumn('sender', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);


        $table->addColumn('subject', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('contents', 'text', [
            'default' => null,
            'null' => false,
        ]);


        $table->addColumn('attempts', 'integer', [
            'default' => 0,
            'limit' => 11,
            'null' => false,
        ]);

        $table->addColumn('sent', 'boolean', [
            'default' => false,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);


        $table->create();
    }
}

