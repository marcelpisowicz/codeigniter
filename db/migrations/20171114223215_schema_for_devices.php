<?php

use Phinx\Migration\AbstractMigration;

class SchemaForDevices extends AbstractMigration
{
    public function up()
    {
        $this->execute("CREATE SCHEMA IF NOT EXISTS details");
    }

    public function down()
    {
        $this->execute("DROP SCHEMA IF EXISTS details");
    }
}
