<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property int $id
 * @property int $userId
 * @property string $text
 * @property int $createdAt
 * @property int|null $updatedAt
 *
 * @property CommentPublication[] $commentPublications
 * @property User $user
 */
class BasePublication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'text', 'createdAt'], 'required'],
            [['userId', 'createdAt', 'updatedAt'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'text' => 'Text',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CommentPublications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentPublications()
    {
        return $this->hasMany(CommentPublication::class, ['publicationId' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
