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
        $newUser = new User();
        $accessToken = new AccessToken();
        $newUser->attributes = Yii::$app->request->post();
        $newUser->setPassword(Yii::$app->request->post('password'));
        $newUser->generateAuthKey();
        if(!$newUser->save()){
            throw new BadRequestHttpException('Failed to save user');
        }
        $accessToken->setAccessToken();
        $accessToken->user_id = $newUser->getId();
        if(!$accessToken->save()){
            $newUser->delete();
            throw new BadRequestHttpException('Failed to save token');
        }
        $userRole = Yii::$app->authManager->getRole('user');
        Yii::$app->authManager->assign($userRole, $newUser->id);
        return [
            'access_token' => $accessToken->access_token,
        ];
    }

    public function actionLogin()
    {
        $newUser = new User();
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $user = User::findByUsername($username);
        if(!$user){
            throw new BadRequestHttpException('Invalid login');
        }
        if(!$user->validatePassword($password)){
            throw new BadRequestHttpException('Invalid password');
        }
        $accessToken = $user->accessToken->getAccessToken();
        return [
            'access_token' => $accessToken,
        ];
    }

}