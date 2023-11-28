<?php

namespace frontend\controllers;

use common\models\BackendModels\User;
use frontend\models\Authorization\LoginForm;
use frontend\models\Authorization\SignupForm;
use Yii;
use yii\base\Controller;

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

        return $model->serializeShortResponse();
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
        return $model->serializeShortResponse();
    }

}