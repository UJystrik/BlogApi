<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \common\models\BaseModels\BasePublication $model */
/** @var \common\models\BaseModels\BasePublicationComment $modelComment */
/** @var app\models\PublicationCommentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Base Publications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="base-publication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userId',
            'text',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

    <h2>Комментарии</h2>

    <p>
        <?= Html::a('Create Publication Comment Crud', ['publication-comment/create', 'publicationId' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'publicationId',
            'userId',
            'text',
            'createdAt',
            //'updatedAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $modelComment, $key, $index, $column) {
                    if ($action === 'view') {
                        $url ='/admin/publication-comment/view?&id='.$modelComment->id;
                        return $url;
                    }
                    if ($action === 'update') {
                        $url ='/admin/publication-comment/update?&id='.$modelComment->id;
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url ='/admin/publication-comment/delete?&id='.$modelComment->id;
                        return $url;
                    }
                }
            ],
        ],
    ]); ?>

</div>
