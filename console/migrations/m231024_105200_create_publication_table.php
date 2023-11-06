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
            'userId' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-publication-userId',
            'publication',
            'userId'
        );

        $this->addForeignKey(
            'fk-publication-userId',
            'publication',
            'userId',
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
            'idx-publication-userId',
            'publication'
        );

        $this->dropForeignKey(
            'fk-publication-userId',
            'publication'
        );

        $this->dropTable('{{%publication}}');
    }
}
