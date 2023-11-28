<?php

namespace frontend\models\PublicationComments;

use common\models\BackendModels\PublicationComment;
use common\models\BackendModels\User;
use yii\base\Model;
use yii\db\Exception;

class DeletePublicationCommentForm extends Model
{
    public $accessToken;
    public $commentId;

    private $_comment;
    public function rules()
    {
        return [
            ['accessToken', 'required', 'message' => 'Unauthorized'],
            ['accessToken', 'exist',
                'targetClass' => '\common\models\BackendModels\AccessToken',
                'targetAttribute' => 'accessToken',
                'message' => 'User not found'
            ],

            ['commentId', 'required'],
        ];
    }

    private function checkAccess(){
        return $this->_comment->userId === User::findByAccessToken($this->accessToken)->id;
    }
    public function deleteComment(){
        $this->_comment = PublicationComment::findIdentity($this->commentId);
        if(!$this->_comment){
            $this->addError('comment', 'Comment not found');
            return false;
        }
        if(!$this->checkAccess()){
            $this->addError('access', 'No access');
            return false;
        }
        if(!$this->_comment->delete()){
            throw new Exception('The comment is not deleted');
        };
        return true;
    }

    public function serializeResponse()
    {
        return [
            'comment' => $this->_comment->serializeForArrayShort()
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }
}