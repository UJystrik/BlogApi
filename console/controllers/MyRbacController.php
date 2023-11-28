<?php

namespace console\controllers;

use common\models\BackendModels\User;
use Yii;
use yii\console\Controller;

/**
* Инициализатор RBAC выполняется в консоли php yii my-rbac/init
*/
class MyRbacController extends Controller {

    #php yii my-rbac/init
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole(User::ROLE_ADMIN);
        $editor = $auth->createRole(User::ROLE_USER);

        // запишем их в БД
        $auth->add($admin);
        $auth->add($editor);
    }
}