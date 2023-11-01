<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Access Token model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $access_token
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
        while(static::findOne(['access_token' => $authKey])) {
            $authKey = Yii::$app->security->generateRandomString();
        }
        $this->access_token = $authKey;
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public static function findByAccessToken($accessToken){
        return static::findOne(['access_token' => $accessToken]);
    }

    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}