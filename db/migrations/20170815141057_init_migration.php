<?php
defined('BASEPATH') OR define('BASEPATH', TRUE);
include('application'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'constants.php');
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
            ->addColumn('password', 'string', ['limit' => HASH_LENGTH])
            ->addColumn('password_salt', 'string', ['limit' => SALT_LENGTH])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('ip_address', 'string', ['limit' => 16])
            ->addColumn('first_name', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('last_name', 'string', ['limit' => 30, 'null' => true])
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

        $password = "admin";
        $salt = bin2hex(openssl_random_pseudo_bytes(SALT_LENGTH/2));
        $hash = hash_pbkdf2(HASH_ALGORITHM, $password, $salt, HASH_ITERATIONS, HASH_LENGTH);

        $singleRow = [
            'ip_address' => '127.0.0.1',
            'username'    => 'admin',
            'password'  => $hash,
            'password_salt' => $salt,
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
