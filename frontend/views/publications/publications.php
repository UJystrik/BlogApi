<?php
/** @var yii\web\View $this */
/** @var \frontend\models\Publications $text */
/** @var \frontend\models\Publications $userName */
/** @var \frontend\models\Publications $publicationsList */

use yii\bootstrap5\Html;

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php foreach ($publicationsList as $publication):?>
<div>
    <h1 class="display-4"><?= 'UJystrik';?></h1>
    <div class="p-5 mb-4 bg-transparent rounded-3" >
        <p class="fs-5 fw-light"><?= $publication->text; ?></p>
    </div>
</div>
<? endforeach;?>
