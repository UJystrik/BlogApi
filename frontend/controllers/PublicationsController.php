<?php

namespace frontend\controllers;
use common\models\Publication;
use common\models\User;
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
        $attributes = Yii::$app->request->post();
        $publicationsList = Publication::findPublications($attributes);
        return [
            'publications' => $publicationsList
        ];
    }

    public function actionViewMy()
    {
        $attributes = Yii::$app->request->post();
        $publicationsList = Publication::findMyPublications($attributes);
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
        $attributes = Yii::$app->request->post();
        Publication::createPublication($attributes);
    }

}
