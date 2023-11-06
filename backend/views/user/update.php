<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UserCRUD $model */

$this->title = 'Update User Crud: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Cruds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-crud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
