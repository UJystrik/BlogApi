<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment_publication".
 *
 * @property int $id
 * @property int $publicationId
 * @property int $userId
 * @property string $text
 * @property int $createdAt
 * @property int|null $updatedAt
 *
 * @property Publication $publication
 * @property User $user
 */
class BasePublicationComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment_publication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publicationId', 'userId', 'text', 'createdAt'], 'required'],
            [['publicationId', 'userId', 'createdAt', 'updatedAt'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['publicationId'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::class, 'targetAttribute' => ['publicationId' => 'id']],
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
            'publicationId' => 'Publication ID',
            'userId' => 'User ID',
            'text' => 'Text',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Publication]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublication()
    {
        return $this->hasOne(Publication::class, ['id' => 'publicationId']);
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
