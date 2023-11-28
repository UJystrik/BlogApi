<?php

namespace common\models\BackendModels;

use common\models\BaseModels\BasePublicationComment;
use yii\behaviors\TimestampBehavior;

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

    public function serializeForArrayFull()
    {
        $data = $this->serializeForArrayShort();

        $data['publicationId'] = $this->publicationId;
        $data['userId'] = $this->userId;
        $data['createdAt'] = $this->createdAt;
        $data['updatedAt'] = $this->updatedAt;

        return $data;
    }

}