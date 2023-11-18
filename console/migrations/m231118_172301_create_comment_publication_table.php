<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment_publication}}`.
 */
class m231118_172301_create_comment_publication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment_publication}}', [
            'id' => $this->primaryKey(),
            'publicationId' => $this->integer()->notNull(),
            'userId' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-comment_publication-publicationId',
            'comment_publication',
            'publicationId'
        );

        $this->createIndex(
            'idx-comment_publication-userId',
            'comment_publication',
            'userId'
        );

        $this->addForeignKey(
            'fk-comment_publication-publicationId',
            'comment_publication',
            'publicationId',
            'publication',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment_publication-userId',
            'comment_publication',
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
            'idx-comment_publication-publicationId',
            'comment_publication'
        );

        $this->dropIndex(
            'idx-comment_publication-userId',
            'comment_publication'
        );

        $this->dropForeignKey(
            'fk-comment_publication-publicationId',
            'publication'
        );

        $this->dropForeignKey(
            'fk-comment_publication-userId',
            'publication'
        );

        $this->dropTable('{{%comment_publication}}');
    }
}
