<?php

namespace frontend\models;

use common\models\AccessToken;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\db\Exception;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    private $_accessToken;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signupUserWidthRole($role){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            //createUser
            $newUser = new User();
            $newUser->attributes = $this->attributes;
            $newUser->setPassword($this->password);
            $newUser->generateAuthKey();
            if(!$newUser->save()){
                throw new Exception('The user is not saved');
            }
            //setAccessToken
            $this->_accessToken = new AccessToken();
            $this->_accessToken->setAccessToken();
            $this->_accessToken->userId = $newUser->getId();
            if(!$this->_accessToken->save()){
                throw new Exception('The token has not been saved');
            }
            //addRole
            $this->setUserRole($newUser, $role);

            $transaction->commit();
        } catch (\Exception $exception){
            $transaction->rollBack();
            $this->_accessToken = null;
            throw $exception;
        }
    }

    public function setUserRole($user, $role){
        $userRole = Yii::$app->authManager->getRole($role);
        return Yii::$app->authManager->assign($userRole, $user->id);
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
