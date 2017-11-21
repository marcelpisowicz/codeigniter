<?php

use Phinx\Migration\AbstractMigration;

class RoutesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('route')) {
            $this->dropTable('route');
        }

        $routes = $this->table('route');
        $routes->addColumn('name', 'string', ['limit' => 64])
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => true])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addIndex(['name'], ['unique' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();

        if ($this->hasTable('route_point')) {
            $this->dropTable('route_point');
        }

        $routes = $this->table('route_point');
        $routes->addColumn('route_id', 'integer')
            ->addColumn('order', 'integer')
            ->addColumn('latitude', 'decimal', ['precision' => 15, 'scale' => 12, 'signed' => false])
            ->addColumn('longitude', 'decimal', ['precision' => 15, 'scale' => 12, 'signed' => false])
            ->addForeignKey('route_id', 'routes', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->save();

    }

    public function down()
    {

    }
}
