<?php

use Phinx\Migration\AbstractMigration;

class RoutePointTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('route_point')) {
            $this->dropTable('route_point');
        }

        $routes = $this->table('route_point');
        $routes->addColumn('route_id', 'integer')
            ->addColumn('order', 'integer')
            ->addColumn('latitude', 'decimal', ['precision' => 15, 'scale' => 12, 'signed' => false])
            ->addColumn('longitude', 'decimal', ['precision' => 15, 'scale' => 12, 'signed' => false])
            ->addForeignKey('route_id', 'route', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->save();
    }

    public function down()
    {

    }
}
