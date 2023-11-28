<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\BaseModels\BasePublicationComment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="base-publication-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publicationId')->textInput() ?>

    <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <?= $form->field($model, 'updatedAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
