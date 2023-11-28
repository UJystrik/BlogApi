<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \common\models\BaseModels\BasePublication $model */

$this->title = 'Create Base Publication';
$this->params['breadcrumbs'][] = ['label' => 'Base Publications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-publication-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
