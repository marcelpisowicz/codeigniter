<?php

use Phinx\Migration\AbstractMigration;

class InitMigration extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('users')) {
            $this->dropTable('users');
        }

        $users = $this->table('users');
        $users->addColumn('username', 'string', ['limit' => 20])
            ->addColumn('password', 'string', ['limit' => 32])
            ->addColumn('salt', 'string', ['limit' => 16])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('ip_address', 'string', ['limit' => 16])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime', ['null' => true])
            ->addColumn('last_login', 'datetime', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => false])
            ->addColumn('admin', 'boolean', ['default' => false])
            ->addIndex(['username', 'email'], ['unique' => true])
            ->save();

        if ($this->hasTable('groups')) {
            $this->dropTable('groups');
        }

        $groups = $this->table('groups');
        $groups->addColumn('name', 'string', ['limit' => 20])
            ->addColumn('description', 'string', ['limit' => 100, 'null' => true])
            ->addIndex(['id'], ['unique' => true])
            ->save();

        if ($this->hasTable('login_attempts')) {
            $this->dropTable('login_attempts');
        }

        $login_attempts = $this->table('login_attempts');
        $login_attempts->addColumn('ip_address', 'string', ['limit' => 16])
            ->addColumn('login', 'string', ['limit' => 20])
            ->addColumn('time', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['id'], ['unique' => true])
            ->save();

        $rows = [
            [
                'id' => '1',
                'name' => 'admin',
                'description' => 'Administrator'
            ],
            [
                'id' => '2',
                'name' => 'members',
                'description' => 'General User'
            ]
        ];

        $this->insert('groups', $rows);

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
