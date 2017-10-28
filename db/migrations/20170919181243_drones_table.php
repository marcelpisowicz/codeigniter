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
        $drones->addColumn('id_code', 'string', ['limit' => 32])
            ->addColumn('model', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('stream_source', 'string', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => true])
            ->addIndex(['id_code'], ['unique' => true])
            ->save();

        $rows = [
            [
                'id_code' => 'TEST0001',
                'model' => 'Testowe urządzenie',
                'stream_source' => 'https://nasa-i.akamaihd.net/hls/live/253565/NASA-NTV1-Public/master.m3u8'
            ],
            [
                'id_code' => 'TEST0002',
                'model' => 'Testowe urządzenie',
                'stream_source' => 'https://stream.novascotiawebcams.com/live-origin/whitepointbeach/playlist.m3u8?DVR'
            ],
            [
                'id_code' => 'TEST0003',
                'model' => 'Testowe urządzenie',
                'stream_source' => 'http://qthttp.apple.com.edgesuite.net/1010qwoeiuryfg/sl.m3u8'
            ],
            [
                'id_code' => 'TEST0004',
                'model' => 'Testowe urządzenie II',
                'stream_source' => null
            ],
            [
                'id_code' => 'TEST0005',
                'model' => 'Testowe urządzenie II',
                'stream_source' => 'hhttp://content.jwplatform.com/manifests/vM7nH0Kl.m3u8'
            ],
            [
                'id_code' => 'TEST0006',
                'model' => 'Testowe urządzenie III',
                'stream_source' => 'http://wms.shared.streamshow.it/carinatv/carinatv/playlist.m3u8'
            ]
        ];

        $this->insert('drones', $rows);
    }

    public function down()
    {

    }
}
