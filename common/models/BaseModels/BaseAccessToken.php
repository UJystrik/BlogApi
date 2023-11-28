<?php

namespace common\models\BaseModels;

use common\models\BackendModels\User;

/**
 * This is the model class for table "access_token".
 *
 * @property int $id
 * @property int $userId
 * @property string $accessToken
 *
 * @property User $user
 */
class BaseAccessToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'access_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'accessToken'], 'required'],
            [['userId'], 'integer'],
            [['accessToken'], 'string', 'max' => 255],
            [['userId'], 'unique'],
            [['accessToken'], 'unique'],
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
            'accessToken' => 'Access Token',
        ];
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
