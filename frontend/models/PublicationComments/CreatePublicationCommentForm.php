<?php

namespace frontend\models\PublicationComments;

use common\models\BackendModels\PublicationComment;
use common\models\BackendModels\User;
use yii\base\Model;
use yii\db\Exception;

class CreatePublicationCommentForm extends Model
{
    public $accessToken;
    public $publicationId;
    public $text;

    private $_newComment;
    public function rules()
    {
        return [
            ['accessToken', 'required', 'message' => 'Unauthorized'],
            ['accessToken', 'exist',
                'targetClass' => '\common\models\BackendModels\AccessToken',
                'targetAttribute' => 'accessToken',
                'message' => 'User not found'
            ],

            ['publicationId', 'required'],
            ['publicationId', 'exist',
                'targetClass' => '\common\models\BackendModels\Publication',
                'targetAttribute' => 'id',
                'message' => 'Publication not found'
            ],

            ['text', 'required'],
            ['text', 'string', 'max' => \Yii::$app->params['publication.maxLength']],
        ];
    }

    public function createComment(){
        $this->_newComment = new PublicationComment();

        $this->_newComment->publicationId = $this->publicationId;
        $this->_newComment->userId = User::findByAccessToken($this->accessToken)->id;
        $this->_newComment->text = $this->text;
        if(!$this->_newComment->save()){
            throw new Exception('The comment is not saved');
        }
    }

    public function serializeShortResponse()
    {
        return [
            'comment' => $this->_newComment->serializeForArrayShort()
        ];
    }

    public function serializeFullResponse()
    {
        return [
            'comment' => $this->_newComment->serializeForArrayFull()
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }
}