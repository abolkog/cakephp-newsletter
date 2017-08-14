<?php
use Migrations\AbstractMigration;

class UpdateCampaignsTable extends AbstractMigration
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
        $table = $this->table('campaigns');

        $table->renameColumn('sender', 'sender_name');

        $table->addColumn('sender_email', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);

        $table->update();
    }
}
