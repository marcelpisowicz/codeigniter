<?php

use Phinx\Migration\AbstractMigration;

class VehiclesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('vehicle')) {
            $this->dropTable('vehicle');
        }

        $vehicles = $this->table('vehicle');
        $vehicles->addColumn('name', 'string', ['limit' => 32])
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
