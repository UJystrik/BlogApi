<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\web\BadRequestHttpException;

class LoginForm extends Model
{
    public $username;
    public $password;

    private $_accessToken;
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }
    public function loginUser(){
        $user = User::findByUsername($this->username);
        if(!$user){
            $this->addError('username','Invalid login');
            return false;
        }
        if(!$user->validatePassword($this->password)){
            $this->addError('password','Invalid password');
            return false;
        }
        $this->_accessToken = $user->accessToken;
        if(!$this->_accessToken){
            return false;
        }
        return true;
    }

    public function serializeResponse()
    {
        return [
            'accessToken' => $this->_accessToken->serializeForArrayShort()
        ];
    }

    public function errorResponse(){
        return [
            'errors' => $this->getFirstErrors()
        ];
    }

}