<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\CreatePublicationForm $model */

use common\models\User;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Новая публикация';
$this->params['breadcrumbs'][] = $this->title;
echo Yii::$app->user->identity->accessToken->getAccessToken();
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-create-publication']); ?>

            <?= $form->field($model, 'text')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'create-publication-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
