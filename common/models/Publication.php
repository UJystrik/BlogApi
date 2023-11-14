<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * Publication model
 *
 * @property integer $id
 * @property integer $userId
 * @property string $text
 * @property integer $createdAt
 * @property integer $updatedAt
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
            [['userId', 'text'], 'required'],
            [['accessToken', 'text'], 'required', 'on' => self::SCENARIO_CREATE],
            [['accessToken'], 'required', 'on' => self::SCENARIO_VIEW_MY]
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['accessToken', 'text'];
        $scenarios[self::SCENARIO_VIEW_ALL] = ['limit', 'offset'];
        $scenarios[self::SCENARIO_VIEW_MY] = ['accessToken', 'limit', 'offset'];
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
        return static::findOne(['userId' => $user_id]);
    }

    public static function findAllPublications()
    {
        return static::find()
            ->indexBy('id')
            ->all();
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
        return $this->hasOne(User::class, ['id' => 'userId']);
    }

}