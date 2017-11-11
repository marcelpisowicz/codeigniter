<?php

use Phinx\Migration\AbstractMigration;

class RoutesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('routes')) {
            $this->dropTable('routes');
        }

        $routes = $this->table('routes');
        $routes->addColumn('name', 'string', ['limit' => 64])
            ->addColumn('creator_user_id', 'integer')
            ->addColumn('active', 'boolean', ['default' => true])
            ->addColumn('description', 'text', ['null' => true])
//            ->addIndex(['name'], ['unique' => true])
            ->addForeignKey('creator_user_id', 'users', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->save();

        if ($this->hasTable('routes_points')) {
            $this->dropTable('routes_points');
        }

        $routes = $this->table('routes_points');
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
