<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;
use yii\helpers\Console;


class CreatePublicationForm extends ActiveRecord
{
    public $accessToken;
    public $text;

    public function rules()
    {
        return [
            ['text', 'required'],
            ['text', 'string', 'max' => 400],
        ];
    }
}