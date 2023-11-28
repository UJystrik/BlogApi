<?php

namespace console\controllers;

use Exception;
use Yii;
use yii\console\Controller;

/**
* Инициализатор RBAC выполняется в консоли php yii my-rbac/init
*/
class MyRbacController extends Controller {

    #php yii my-rbac/init
    /**
     * @throws Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $admin = $auth->createRole(\Yii::$app->params['user.roleAdmin']);
        $editor = $auth->createRole(\Yii::$app->params['user.roleUser']);

        // запишем их в БД
        $auth->add($admin);
        $auth->add($editor);
    }
}