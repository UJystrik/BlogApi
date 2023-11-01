<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publication}}`.
 */
class m231024_105200_create_publication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publication}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-publication-user_id',
            'publication',
            'user_id'
        );

        $this->addForeignKey(
            'fk-publication-user_id',
            'publication',
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
            'idx-publication-user_id',
            'publication'
        );

        $this->dropForeignKey(
            'fk-publication-user_id',
            'publication'
        );

        $this->dropTable('{{%publication}}');
    }
}
