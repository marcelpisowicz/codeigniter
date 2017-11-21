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

        if ($this->hasTable('calendar_schedule')) {
            $this->dropTable('calendar_schedule');
        }

        $drones = $this->table('calendar_schedule');
        $drones->addColumn('route_id', 'integer')
            ->addColumn('drone_id', 'integer')
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('min', 'integer', ['limit' => 59])
            ->addColumn('hour', 'integer', ['limit' => 23])
            ->addColumn('day', 'integer', ['limit' => 31])
            ->addColumn('month', 'integer', ['limit' => 12])
            ->addColumn('day_of_week', 'integer', ['limit' => 7])
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
