<?php

use Phinx\Migration\AbstractMigration;

class DronesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('drone')) {
            $this->dropTable('drone');
        }

        $drones = $this->table('drone');
        $drones->addColumn('name', 'string', ['limit' => 32])
            ->addColumn('serial_number', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('model', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('stream_source', 'string', ['null' => true])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => true])
            ->addColumn('type', 'integer')
            ->addIndex(['serial_number'], ['unique' => true])
            ->addIndex(['name'], ['unique' => true])
            ->save();
    }

    public function down()
    {

    }
}
