<?php

use Phinx\Migration\AbstractMigration;

class SchedulerTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('scheduler')) {
            $this->dropTable('scheduler');
        }

        $drones = $this->table('scheduler');
        $drones->addColumn('route_id', 'integer')
            ->addColumn('drone_id', 'integer')
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('datetime', 'datetime')
            ->addForeignKey('drone_id', 'drones', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('route_id', 'routes', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }

    public function down()
    {

    }
}
