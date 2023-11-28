<?php

namespace frontend\controllers;
use frontend\models\Publications\CreatePublicationForm;
use frontend\models\Publications\PublicationsListForm;
use Yii;
use yii\base\Controller;
use yii\filters\VerbFilter;

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
        $model = new PublicationsListForm();
        $model->attributes = Yii::$app->request->post();
        $model->findPublications();
        return $model->serializeShortResponse();
    }

    public function actionViewMy()
    {
        $model = new PublicationsListForm(['scenario' => PublicationsListForm::SCENARIO_VIEW_MY]);
        $model->attributes = Yii::$app->request->post();
        if(!$model->validate()){
            return $model->errorResponse();
        }
        $model->findMyPublications();
        return $model->serializeShortResponse();
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
        return $model->serializeShortResponse();
    }

}
