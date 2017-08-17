<?php
include('application'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'passwords_helper.php');
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
        $salt = randomSalt();
        $hash = passwordHash($password, $salt);

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
