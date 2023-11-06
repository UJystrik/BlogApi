<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UserCRUD $model */

$this->title = 'Create User Crud';
$this->params['breadcrumbs'][] = ['label' => 'User Cruds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-crud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
