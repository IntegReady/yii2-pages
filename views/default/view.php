<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use integready\pages\models\Pages;
use integready\pages\models\PagesCategory;

/* @var $this yii\web\View */
/* @var $model integready\pages\models\Pages */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pgs', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => Yii::t('pgs', 'Confirm-delete-page'),
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'title',
            'alias',
            [
                'attribute' => 'category_id',
                'value'     => function ($data) {
                    return PagesCategory::getCategoryById($data->category_id);
                },
            ],
            'text:ntext',
            'language',
            'date_created',
            'date_updated',
            'date_published_in',
            'date_published_out',
            [
                'attribute' => 'sitemap',
                'value'     => function ($data) {
                    return Pages::getSitemapStatusById($data->sitemap);
                },
            ],
        ],
    ]) ?>

</div>
