<?php

namespace frontend\controllers;

use common\models\AccessToken;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'login'  => ['POST'],
                    'signup' => ['POST'],
                ],
            ],
        ];
    }

    public function actionSignup()
    {
        $attributes = Yii::$app->request->post();
        $accessToken = User::signupUserWidthRole(Yii::$app->request->post(), User::ROLE_USER);
        return [
            'accessToken' => $accessToken,
        ];
    }

    public function actionLogin()
    {
        $attributes = Yii::$app->request->post();
        $accessToken = User::loginUser($attributes);;
        return [
            'accessToken' => $accessToken,
        ];
    }

}