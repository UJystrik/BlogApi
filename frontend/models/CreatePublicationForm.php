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
        $newPublication = new Publication();

        $newPublication->userId = User::findByAccessToken($this->accessToken)->id;
        $newPublication->text = $this->text;
        if(!$newPublication->save()){
            throw new Exception('The publication is not saved');
        }
    }
}