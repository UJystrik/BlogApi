<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PublicationCommentCRUD $model */

$this->title = 'Update Publication Comment Crud: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Publication Comment Cruds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publication-comment-crud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
