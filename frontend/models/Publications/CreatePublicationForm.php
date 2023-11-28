<?php

namespace frontend\models\Publications;

use common\models\BackendModels\Publication;
use common\models\BackendModels\User;
use yii\base\Model;
use yii\db\Exception;

class CreatePublicationForm extends Model
{
    public $accessToken;
    public $text;
    private $_newPublication;

    public function rules()
    {
        return [
            ['accessToken', 'required', 'message' => 'Unauthorized'],
            ['accessToken', 'exist',
                'targetClass' => '\common\models\BackendModels\AccessToken',
                'message' => 'User not found'
            ],
            ['text', 'required'],
            ['text', 'string', 'max' => \Yii::$app->params['publication.maxLength']],
        ];
    }

    public function createPublication(){
        $this->_newPublication = new Publication();

        $this->_newPublication->userId = User::findByAccessToken($this->accessToken)->id;
        $this->_newPublication->text = $this->text;
        if(!$this->_newPublication->save()){
            throw new Exception('The publication is not saved');
        }
    }

    public function serializeShortResponse()
    {
        return [
            'publication' => $this->_newPublication->serializeForArrayShort()
        ];
    }

    public function serializeFullResponse()
    {
        return [
            'publication' => $this->_newPublication->serializeForArrayFull()
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }
}