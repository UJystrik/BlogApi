<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\PublicationCRUD $model */

$this->title = 'Create Publication Crud';
$this->params['breadcrumbs'][] = ['label' => 'Publication Cruds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-crud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
