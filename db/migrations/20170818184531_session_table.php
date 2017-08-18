<?php

use Phinx\Migration\AbstractMigration;

class SessionTable extends AbstractMigration
{
    public function up()
    {
        if (!$this->hasTable('ci_sessions')) {

            $users = $this->table('ci_sessions');
            $users->addColumn('ip_address', 'string', ['limit' => 16])
                ->addColumn('timestamp', 'integer', ['default' => 0,'signed' => false, 'limit' => 10])
                ->addColumn('data', 'blob')
                ->addIndex(['timestamp'], ['name' => 'ci_sessions_timestamp'])
                ->save();
        }

    }

    public function down()
    {

    }
}
