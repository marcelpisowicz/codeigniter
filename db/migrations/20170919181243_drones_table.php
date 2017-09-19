<?php

use Phinx\Migration\AbstractMigration;

class DronesTable extends AbstractMigration
{
    public function up()
    {
        if ($this->hasTable('drones')) {
            $this->dropTable('drones');
        }

        $drones = $this->table('drones');
        $drones->addColumn('id_code', 'string', ['limit' => 24])
            ->addColumn('model', 'string', ['limit' => 48])
            ->addColumn('active', 'boolean', ['default' => true])
            ->addIndex(['id_code'], ['unique' => true])
            ->save();

        $rows = [
            [
                'id_code' => 'TEST0001',
                'model' => 'Testowe urządzenie'
            ],
            [
                'id_code' => 'TEST0002',
                'model' => 'Testowe urządzenie'
            ],
            [
                'id_code' => 'TEST0003',
                'model' => 'Testowe urządzenie'
            ],
            [
                'id_code' => 'TEST0004',
                'model' => 'Testowe urządzenie II'
            ],
            [
                'id_code' => 'TEST0005',
                'model' => 'Testowe urządzenie II'
            ],
            [
                'id_code' => 'TEST0006',
                'model' => 'Testowe urządzenie III'
            ]
        ];

        $this->insert('drones', $rows);
    }

    public function down()
    {

    }
}
