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
        $limit = Yii::$app->request->post('limit');
        $offset = Yii::$app->request->post('offset');
        $publicationsList = Publication::findPublications($limit, $offset);
        return $publicationsList;
    }

    public function actionViewMy()
    {
        $accessToken = Yii::$app->request->post('accessToken');
        $limit = Yii::$app->request->post('limit');
        $offset = Yii::$app->request->post('offset');
        $publicationsList = Publication::findMyPublications($accessToken, $limit, $offset);
        return $publicationsList;
    }

    /**
     * Displays publication.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $newPublication = new Publication();
        $newPublication->attributes = Yii::$app->request->post();
        $accessToken = Yii::$app->request->post('accessToken');
        $newPublication->userId = User::findByAccessToken($accessToken)->id;
        $newPublication->save();
    }

}
