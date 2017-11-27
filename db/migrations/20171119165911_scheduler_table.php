<?php

use Phinx\Migration\AbstractMigration;

class SchedulerTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('calendar')) {
            $this->dropTable('calendar');
        }

        $vehicles = $this->table('calendar');
        $vehicles->addColumn('route_id', 'integer')
            ->addColumn('vehicle_id', 'integer')
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('datetime', 'datetime')
            ->addForeignKey('vehicle_id', 'vehicle', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('route_id', 'route', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();

        if ($this->hasTable('schedule')) {
            $this->dropTable('schedule');
        }

        $vehicles = $this->table('schedule');
        $vehicles->addColumn('route_id', 'integer')
            ->addColumn('vehicle_id', 'integer')
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('min', 'integer', ['limit' => 59])
            ->addColumn('hour', 'integer', ['limit' => 23])
            ->addColumn('day', 'integer', ['limit' => 31])
            ->addColumn('month', 'integer', ['limit' => 12])
            ->addColumn('day_of_week', 'integer', ['limit' => 7])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('description', 'text', ['null' => true])
            ->addForeignKey('vehicle_id', 'vehicle', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('route_id', 'route', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();
    }

    public function down()
    {

    }
}
