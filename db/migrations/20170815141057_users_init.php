<?php

use Phinx\Migration\AbstractMigration;

class UsersInit extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('users')) {
            $this->dropTable('users');
        }

        $users = $this->table('users');
        $users->addColumn('username', 'string', ['limit' => 32])
            ->addColumn('password', 'string', ['limit' => 32])
            ->addColumn('salt', 'string', ['limit' => 16])
            ->addColumn('email', 'string', ['limit' => 128])
            ->addColumn('ip_address', 'string', ['limit' => 16])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime', ['null' => true])
            ->addColumn('last_login', 'datetime', ['null' => true])
            ->addColumn('lang', 'string', ['default' => 'pl', 'limit' => 8])
            ->addColumn('active', 'boolean', ['default' => false])
            ->addColumn('admin', 'boolean', ['default' => false])
            ->addIndex(['username', 'email'], ['unique' => true])
            ->save();

        $singleRow = [
            'ip_address' => '127.0.0.1',
            'username' => 'admin',
            'password' => 'ecc55965a1ede2c9e2a51dc19c51ced0',
            'salt' => '4eb78f2331b82b29',
            'email' => 'admin@example.com',
            'active' => 1,
            'admin' => 1
        ];

        $users->insert($singleRow);
        $users->saveData();

    }

    public function down()
    {

    }
}
