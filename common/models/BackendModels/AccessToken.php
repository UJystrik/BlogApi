<?php

namespace common\models\BackendModels;

use common\models\BaseModels\BaseAccessToken;
use Yii;

/**
 * Access Token model
 *
 * @property integer $id
 * @property integer $userId
 * @property string $accessToken
 */

class AccessToken extends BaseAccessToken
{
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

    public static function findByAccessToken($accessToken)
    {
        return static::findOne(['accessToken' => $accessToken]);
    }

    public function serializeForArrayShort()
    {
        $data = [];

        $data['token'] = $this->accessToken;

        return $data;
    }
}