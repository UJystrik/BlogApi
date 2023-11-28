<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $authKey
 * @property string $passwordHash
 * @property string|null $passwordResetToken
 * @property string $email
 * @property int $status
 * @property int $createdAt
 * @property int $updatedAt
 * @property string|null $verificationToken
 *
 * @property AccessToken $accessToken
 * @property CommentPublication[] $commentPublications
 * @property Publication[] $publications
 */
class BaseUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'authKey', 'passwordHash', 'email', 'createdAt', 'updatedAt'], 'required'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            [['username', 'passwordHash', 'passwordResetToken', 'email', 'verificationToken'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['passwordResetToken'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'authKey' => 'Auth Key',
            'passwordHash' => 'Password Hash',
            'passwordResetToken' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'verificationToken' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[AccessToken]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccessToken()
    {
        return $this->hasOne(AccessToken::class, ['userId' => 'id']);
    }

    /**
     * Gets query for [[CommentPublications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentPublications()
    {
        return $this->hasMany(CommentPublication::class, ['userId' => 'id']);
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::class, ['userId' => 'id']);
    }
}
