<?php

use Phinx\Migration\AbstractMigration;

class RememberLogin extends AbstractMigration
{
    public function up()
    {
        if (!$this->hasTable('remember_login')) {

            $users = $this->table('remember_login', ['id' => false, 'primary_key' => ['user_id']]);
            $users->addColumn('user_id', 'integer')
                ->addColumn('remember_code', 'string', ['limit' => 16])
                ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->save();
        }
    }

    public function down()
    {

    }
}
