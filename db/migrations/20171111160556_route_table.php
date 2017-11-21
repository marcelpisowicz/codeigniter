<?php

use Phinx\Migration\AbstractMigration;

class RouteTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('route')) {
            $this->dropTable('route');
        }

        $routes = $this->table('route');
        $routes->addColumn('name', 'string', ['limit' => 64])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addIndex(['name'], ['unique' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->save();

    }

    public function down()
    {

    }
}
