<?php

use yii\db\Migration;

/**
 * Class m240324_223648_subscriptions
 */
class m240324_223648_subscriptions extends Migration
{

    public function up()
    {
        $this->createTable('{{%subscription}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-subscriptions-user_id}}',
            '{{%subscription}}',
            'user_id'
        );

        $this->createIndex(
            '{{%idx-subscriptions-author_id}}',
            '{{%subscription}}',
            'author_id'
        );

        $this->addForeignKey(
            '{{%fk-subscriptions-author_id}}',
            '{{%subscription}}',
            'author_id',
            '{{%author}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey(
            '{{%fk-subscriptions-author_id}}',
            '{{%subscription}}'
        );

        $this->dropTable('{{%subscription}}');
    }
}
