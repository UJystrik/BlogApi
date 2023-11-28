<?php

namespace frontend\models\PublicationComments;

use common\models\BackendModels\PublicationComment;
use yii\base\Model;

class PublicationCommentListForm extends Model
{
    public $publicationId;
    public $limit;
    public $offset;

    private $_comments;

    public function rules()
    {
        return [
            ['publicationId', 'required'],
            ['publicationId', 'exist',
                'targetClass' => '\common\models\BackendModels\Publication',
                'targetAttribute' => 'id',
                'message' => 'Publication not found'
            ],
            ['limit', 'integer'],
            ['offset', 'integer'],
        ];
    }

    public function findPublicationComments()
    {
        $this->_comments = PublicationComment::find()
            ->limit($this->limit)
            ->offset($this->offset)
            ->all();
    }

    public function serializeResponse()
    {
        $result = [];

        foreach ($this->_comments as $comment) {
            array_push( $result, $comment->serializeForArrayShort());
        }

        return [
            'comments' => $result
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }

}