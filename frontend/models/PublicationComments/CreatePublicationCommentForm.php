<?php

namespace frontend\models\PublicationComments;

use common\models\PublicationComment;
use common\models\User;
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
                'targetClass' => '\common\models\AccessToken',
                'targetAttribute' => 'accessToken',
                'message' => 'User not found'
            ],

            ['publicationId', 'required'],
            ['publicationId', 'exist',
                'targetClass' => '\common\models\Publication',
                'targetAttribute' => 'id',
                'message' => 'Publication not found'
            ],

            ['text', 'required'],
            ['text', 'string', 'max' => PublicationComment::MAX_LENGTH_COMMENT_TEXT],
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

    public function serializeResponse()
    {
        return [
            'comment' => $this->_newComment->serializeForArrayShort()
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }
}