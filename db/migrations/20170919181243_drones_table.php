<?php

use Phinx\Migration\AbstractMigration;

class DronesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('drones')) {
            $this->dropTable('drones');
        }

        $drones = $this->table('drones');
        $drones->addColumn('id_code', 'string', ['limit' => 32])
            ->addColumn('model', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('stream_source', 'string', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => true])
            ->addColumn('type', 'integer')
            ->addIndex(['id_code'], ['unique' => true])
            ->save();
    }

    public function down()
    {

    }
}
