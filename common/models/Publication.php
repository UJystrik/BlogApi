<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Publication model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 */

class Publication extends ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_VIEW_ALL = 'view-all';
    const SCENARIO_VIEW_MY = 'view-my';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%publication}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'text'], 'required'],
            [['access_token', 'text'], 'required', 'on' => self::SCENARIO_CREATE],
            [['access_token'], 'required', 'on' => self::SCENARIO_VIEW_MY]
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['access_token', 'text'];
        $scenarios['view-all'] = ['limit', 'offset'];
        $scenarios['view-my'] = ['access_token', 'limit', 'offset'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
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

    public static function findByUserId($user_id)
    {
        return static::findOne(['user_id' => $user_id]);
    }

    public static function findAllPublications()
    {
        return static::find()->indexBy('id')->all();
    }

    public static function findPublications($limit, $offset)
    {
        return static::find()->limit($limit)->offset($offset)->all();
    }

    public static function findMyPublications($accessToken,$limit, $offset)
    {
        $user_id = User::findByAccessToken($accessToken)->id;
        return static::find()->where('user_id = :id', [':id' => $user_id])->limit($limit)->offset($offset)->all();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Связь с таблицей User
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}