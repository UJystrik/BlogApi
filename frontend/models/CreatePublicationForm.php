<?php

namespace frontend\models;

use common\models\Publication;
use Yii;
use yii\base\Model;
use common\models\User;
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
                'targetClass' => '\common\models\AccessToken',
                'message' => 'User not found'
            ],
            ['text', 'required'],
            ['text', 'string', 'max' => 400],
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

    public function serializeResponse()
    {
        return [
            'publication' => $this->_newPublication->serializeForArrayShort()
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }
}