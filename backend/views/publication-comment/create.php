<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BasePublicationComment $model */

$this->title = 'Create Base Publication Comment';
$this->params['breadcrumbs'][] = ['label' => 'Base Publication Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-publication-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
