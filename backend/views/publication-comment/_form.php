<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PublicationCommentCRUD $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="publication-comment-crud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publicationId')->textInput() ?>

    <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
