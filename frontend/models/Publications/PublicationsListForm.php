<?php

namespace frontend\models\Publications;

use common\models\BackendModels\Publication;
use common\models\BackendModels\User;
use yii\base\Model;

class PublicationsListForm extends Model
{
    public $accessToken;
    public $limit;
    public $offset;

    private $_publications;
    const SCENARIO_VIEW_MY = 'view-my';

    public function rules()
    {
        return [
            ['limit', 'integer'],
            ['offset', 'integer'],
            ['limit', 'default', 'value' => \Yii::$app->params['publication.limit']],
            ['offset', 'default', 'value' => \Yii::$app->params['publication.offset']],
            ['accessToken', 'required', 'on' => self::SCENARIO_VIEW_MY, 'message' => 'Unauthorized'],
            ['accessToken', 'exist',
                'on' => self::SCENARIO_VIEW_MY,
                'targetClass' => '\common\models\BackendModels\AccessToken',
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
        $this->_publications = Publication::find()
            ->where('userId = :id', [':id' => $userId])
            ->limit($this->limit)
            ->offset($this->offset);
    }

    public function findPublications()
    {
        $this->_publications = Publication::find()
            ->limit($this->limit)
            ->offset($this->offset);
    }

    public function serializeShortResponse()
    {
        $result = [];

        foreach ($this->_publications->each() as $publication) {
            $result[] = $publication->serializeForArrayShort();
        }

        return [
            'publications' => $result
        ];
    }

    public function serializeFullResponse()
    {
        $result = [];

        foreach ($this->_publications->each() as $publication) {
            $result[] = $publication->serializeForArrayFull();
        }

        return [
            'publications' => $result
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }
}