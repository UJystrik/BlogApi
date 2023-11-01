<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%access_token}}`.
 */
class m231024_112214_create_access_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%access_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unique()->notNull(),
            'access_token' => $this->string()->unique()->notNull(),
        ]);

        $this->createIndex(
            'idx-access_token-user_id',
            'access_token',
            'user_id'
        );

        $this->addForeignKey(
            'fk-access_token-user_id',
            'access_token',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-access_token-user_id',
            'access_token'
        );

        $this->dropForeignKey(
            'fk-access_token-user_id',
            'access_token'
        );

        $this->dropTable('{{%access_token}}');
    }
}
