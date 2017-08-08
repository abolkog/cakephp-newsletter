<?php
use Migrations\AbstractMigration;

class AddDefaultMailingList extends AbstractMigration
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
        $table = $this->table('groups');

        $data = [
            [
                'title' => 'Default',
                'description' => 'Default Mailing List',
                'created' => date('Y-m-d H:i:s')
            ]
        ];

        $table->insert($data);
        $table->update();
    }
}
