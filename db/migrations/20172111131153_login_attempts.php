<?php

use Phinx\Migration\AbstractMigration;

class LoginAttempts extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('login_attempts')) {
            $this->dropTable('login_attempts');
        }

        $login_attempts = $this->table('login_attempts');
        $login_attempts->addColumn('ip_address', 'string', ['limit' => 16])
            ->addColumn('login', 'string', ['limit' => 32])
            ->addColumn('time', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['id'], ['unique' => true])
            ->save();
    }

    public function down()
    {

    }
}
