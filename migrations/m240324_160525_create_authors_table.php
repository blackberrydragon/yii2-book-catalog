<?php

use yii\db\Migration;

class m240324_160525_create_authors_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
    }
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
