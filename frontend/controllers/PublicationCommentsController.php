<?php

namespace frontend\controllers;

use frontend\models\PublicationComments\CreatePublicationCommentForm;
use frontend\models\PublicationComments\DeletePublicationCommentForm;
use frontend\models\PublicationComments\PublicationCommentListForm;
use Yii;
use yii\base\Controller;
use yii\filters\VerbFilter;

class PublicationCommentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new CreatePublicationCommentForm();
        $model->attributes = Yii::$app->request->post();
        if(!$model->validate()){
            return $model->errorResponse();
        }
        $model->createComment();
        return $model->serializeResponse();
    }

    public function actionDelete(){
        $model = new DeletePublicationCommentForm();
        $model->attributes = Yii::$app->request->post();
        if(!$model->validate()){
            return $model->errorResponse();
        }
        if(!$model->deleteComment()){
            return $model->errorResponse();
        }
        return $model->serializeResponse();
    }

    public function actionView()
    {
        $model = new PublicationCommentListForm();
        $model->attributes = Yii::$app->request->post();
        if(!$model->validate()){
            return $model->errorResponse();
        }
        $model->findPublicationComments();
        return $model->serializeResponse();
    }

}