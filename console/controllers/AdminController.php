<?php

namespace console\controllers;

use common\models\AccessToken;
use common\models\User;
use Yii;
use yii\console\Controller;
use yii\db\Exception;

class AdminController extends Controller
{
    private const _USERNAME = "admin";
    private const _EMAIL = "admin@example.com";
    private const _PASSWORD = "12345678";


    #php yii admin/init
    public function actionInit()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            //createUser
            $newUser = new User();
            $newUser->username = AdminController::_USERNAME;
            $newUser->email = AdminController::_EMAIL;
            $newUser->setPassword(AdminController::_PASSWORD);
            $newUser->generateAuthKey();
            if(!$newUser->save()){
                throw new Exception('The user is not saved');
            }
            //setAccessToken
            $accessToken = new AccessToken();
            $accessToken->setAccessToken();
            $accessToken->userId = $newUser->getId();
            if(!$accessToken->save()){
                throw new Exception('The token has not been saved');
            }
            //addRole
            $this->setUserRole($newUser, User::ROLE_ADMIN);

            $transaction->commit();
        } catch (\Exception $exception){
            $transaction->rollBack();
            throw $exception;
        }
    }

    private function setUserRole($user, $role)
    {
        $userRole = Yii::$app->authManager->getRole($role);
        return Yii::$app->authManager->assign($userRole, $user->id);
    }
}