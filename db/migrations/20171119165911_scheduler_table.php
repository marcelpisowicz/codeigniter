<?php

use Phinx\Migration\AbstractMigration;

class SchedulerTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('calendar')) {
            $this->dropTable('calendar');
        }

        $drones = $this->table('calendar');
        $drones->addColumn('route_id', 'integer')
            ->addColumn('drone_id', 'integer')
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('datetime', 'datetime')
            ->addForeignKey('drone_id', 'drone', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('route_id', 'route', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();

        if ($this->hasTable('schedule')) {
            $this->dropTable('schedule');
        }

        $drones = $this->table('schedule');
        $drones->addColumn('route_id', 'integer')
            ->addColumn('drone_id', 'integer')
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('min', 'integer', ['limit' => 59, 'null' => true])
            ->addColumn('hour', 'integer', ['limit' => 23, 'null' => true])
            ->addColumn('day', 'integer', ['limit' => 31, 'null' => true])
            ->addColumn('month', 'integer', ['limit' => 12, 'null' => true])
            ->addColumn('day_of_week', 'integer', ['limit' => 7, 'null' => true])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('description', 'text', ['null' => true])
            ->addForeignKey('drone_id', 'drone', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('route_id', 'route', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }

    public function down()
    {

    }
}
