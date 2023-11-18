<?php

namespace frontend\controllers;
use frontend\models\CreatePublicationForm;
use frontend\models\PublicationsList;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
/**
 * Site controller
 */
class PublicationsController extends Controller
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
                    'view-all' => ['GET'],
                    'view-my' => ['GET'],
                    'create' => ['POST'],
                ],
            ],
        ];
    }

    public function actionViewAll()
    {
        $model = new PublicationsList();
        $model->attributes = Yii::$app->request->post();
        $model->findPublications();
        return $model->serializeResponse();
    }

    public function actionViewMy()
    {
        $model = new PublicationsList(['scenario' => PublicationsList::SCENARIO_VIEW_MY]);
        $model->attributes = Yii::$app->request->post();
        if(!$model->validate()){
            return $model->errorResponse();
        }
        $model->findMyPublications();
        return $model->serializeResponse();
    }

    /**
     * Displays publication.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CreatePublicationForm();
        $model->attributes = Yii::$app->request->post();
        if(!$model->validate()){
            return $model->errorResponse();
        }
        $model->createPublication();
        return $model->serializeResponse();
    }

}
