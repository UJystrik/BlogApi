<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Publication model
 *
 * @property integer $id
 * @property integer $publicationId
 * @property integer $userId
 * @property string $text
 * @property integer $createdAt
 * @property integer $updatedAt
 */

class PublicationComment extends BasePublicationComment
{
    const MAX_LENGTH_COMMENT_TEXT = 200;
    public function rules()
    {
        return [
            [['publicationId', 'userId', 'text'], 'required'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findByPublicationId($publicationId)
    {
        return static::findAll(['publicationId' => $publicationId]);
    }

    public static function findByUserId($user_id)
    {
        return static::findAll(['userId' => $user_id]);
    }

    public function serializeForArrayShort()
    {
        $data = [];

        $data['id'] = $this->id;
        $data['text'] = $this->text;

        return $data;
    }
}