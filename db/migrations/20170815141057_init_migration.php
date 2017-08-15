<?php
defined('BASEPATH') OR define('BASEPATH', TRUE);
include('application'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'constants.php');
use Phinx\Migration\AbstractMigration;

class InitMigration extends AbstractMigration
{
    public function up()
    {
        $users = $this->table('users');
        $users->addColumn('username', 'string', array('limit' => 20))
            ->addColumn('password', 'string', array('limit' => HASH_LENGTH))
            ->addColumn('password_salt', 'string', array('limit' => SALT_LENGTH))
            ->addColumn('email', 'string', array('limit' => 100))
            ->addColumn('first_name', 'string', array('limit' => 30, 'null' => true))
            ->addColumn('last_name', 'string', array('limit' => 30, 'null' => true))
            ->addColumn('created', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated', 'datetime', array('null' => true))
            ->addColumn('active', 'boolean', array('default' => false))
            ->addColumn('admin', 'boolean', array('default' => false))
            ->addIndex(array('username', 'email'), array('unique' => true))
            ->save();

        $password = "admin";
        $salt = bin2hex(openssl_random_pseudo_bytes(SALT_LENGTH/2));
        $hash = hash_pbkdf2(HASH_ALGORITHM, $password, $salt, HASH_ITERATIONS, HASH_LENGTH);

        $singleRow = [
            'username'    => 'admin',
            'password'  => $hash,
            'password_salt' => $salt,
            'email' => 'admin@example.com',
            'active' => 1,
            'admin' => 1
        ];

        $table = $this->table('users');
        $table->insert($singleRow);
        $table->saveData();

    }

    public function down()
    {

    }
}
