<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \common\models\BaseModels\BaseUser $model */

$this->title = 'Create Base User';
$this->params['breadcrumbs'][] = ['label' => 'Base Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
