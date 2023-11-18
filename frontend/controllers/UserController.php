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
        if(!$model->validate()){
            return $model->errorResponse();
        }
        $model->signupUserWidthRole(User::ROLE_USER);

        return $model->serializeResponse();
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->attributes = Yii::$app->request->post();
        if(!$model->validate()){
            return $model->errorResponse();
        }
        if(!$model->loginUser()){
            return $model->errorResponse();
        }
        return $model->serializeResponse();
    }

}