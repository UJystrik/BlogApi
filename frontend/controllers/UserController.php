<?php

namespace frontend\controllers;

use common\models\AccessToken;
use common\models\User;
use frontend\models\LoginForm;
use frontend\models\SignupForm;
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
        $model = new SignupForm();
        $model->attributes = Yii::$app->request->post();
        if($model->validate()){
            $accessToken = $model->signupUserWidthRole(User::ROLE_USER);
        } else {
            return [
                'errors' => $model->getFirstErrors()
            ];
        }

        return [
            'accessToken' => $accessToken,
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->attributes = Yii::$app->request->post();
        if($model->validate()){
            $accessToken = $model->loginUser();
            if(!$accessToken){
                return [
                    'errors' => $model->getFirstErrors()
                ];
            }
        } else {
            return [
                'errors' => $model->getFirstErrors()
            ];
        }

        return [
            'accessToken' => $accessToken,
        ];
    }

}