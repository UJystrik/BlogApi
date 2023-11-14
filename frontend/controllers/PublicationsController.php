<?php

namespace frontend\controllers;
use common\models\Publication;
use common\models\User;
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
        $publicationsList = $model->findPublications();
        return [
            'publications' => $publicationsList
        ];
    }

    public function actionViewMy()
    {
        $model = new PublicationsList(['scenario' => PublicationsList::SCENARIO_VIEW_MY]);
        $model->attributes = Yii::$app->request->post();
        if($model->validate()){
            $publicationsList = $model->findMyPublications();
        } else {
            return [
                'errors' => $model->getFirstErrors()
            ];
        }

        return [
            'publications' => $publicationsList
        ];
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
        if($model->validate()){
            $model->createPublication();
        } else {
            return [
              'errors' => $model->getFirstErrors()
            ];
        }

    }

}
