<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Access Token model
 *
 * @property integer $id
 * @property integer $userId
 * @property string $accessToken
 */

class AccessToken extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%access_token}}';
    }

    public function setAccessToken()
    {
        $authKey = Yii::$app->security->generateRandomString();
        while(static::findOne(['accessToken' => $authKey])) {
            $authKey = Yii::$app->security->generateRandomString();
        }
        $this->accessToken = $authKey;
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public static function findByAccessToken($accessToken){
        return static::findOne(['accessToken' => $accessToken]);
    }

    public function serializeForArrayShort(){
        $data = [];

        $data['token'] = $this->accessToken;

        return $data;
    }

    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}