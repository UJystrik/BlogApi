<?php

namespace frontend\models;

use common\models\Publication;
use common\models\User;
use yii\base\Model;
use yii\db\Exception;

class PublicationsList extends Model
{
    public $accessToken;
    public $limit;
    public $offset;
    const SCENARIO_VIEW_MY = 'view-my';

    public function rules()
    {
        return [
            ['limit', 'integer'],
            ['offset', 'integer'],
            ['accessToken', 'required', 'on' => self::SCENARIO_VIEW_MY, 'message' => 'Unauthorized'],
            ['accessToken', 'exist',
                'on' => self::SCENARIO_VIEW_MY,
                'targetClass' => '\common\models\AccessToken',
                'message' => 'User not found'
            ],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_VIEW_MY] = ['accessToken', 'limit', 'offset'];
        return $scenarios;
    }

    public function findMyPublications()
    {
        $userId = User::findByAccessToken($this->accessToken)->id;
        return Publication::find()
            ->where('userId = :id', [':id' => $userId])
            ->limit($this->limit)
            ->offset($this->offset)
            ->all();
    }

    public function findPublications()
    {
        return Publication::find()
            ->limit($this->limit)
            ->offset($this->offset)
            ->all();
    }
}