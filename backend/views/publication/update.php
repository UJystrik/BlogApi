<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BasePublication $model */

$this->title = 'Update Base Publication: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Base Publications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="base-publication-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
