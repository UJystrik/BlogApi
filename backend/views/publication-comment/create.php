<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PublicationCommentCRUD $model */

$this->title = 'Create Publication Comment Crud';
$this->params['breadcrumbs'][] = ['label' => 'Publication Comment Cruds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-comment-crud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
