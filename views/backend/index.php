<?php

use muravshchyk\pages\models\Pages;
use muravshchyk\pages\models\PagesCategory;
use muravshchyk\pages\PageHelper;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel muravshchyk\pages\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pages', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'alias',
            [
                'attribute' => 'category_id',
                'value'     => function ($data) {
                    return PagesCategory::getCategoryById($data->category_id);
                },
                'filter'    => Html::activeDropDownList($searchModel, 'category_id', PagesCategory::getCategoryList(), ['class' => 'form-control', 'prompt' => Yii::t('fx', '--Выберите категорию--')]),
            ],
            // 'text:ntext',
            [
                'attribute' => 'language',
                'value'     => 'language',
                'filter'    => Html::activeDropDownList($searchModel, 'language', PageHelper::getLanguagesList(), ['class' => 'form-control', 'prompt' => Yii::t('fx', 'trans-lang-choice')]),
            ],
            'date_created',
            // 'date_updated',
            // 'date_published_in',
            // 'date_published_out',
            [
                'attribute' => 'sitemap',
                'value'     => function ($data) {
                    return Pages::getSitemapStatusById($data->sitemap);
                },
                'filter'    => Html::activeDropDownList($searchModel, 'sitemap', Pages::getSitemapStatusList(), ['class' => 'form-control', 'prompt' => Yii::t('fx', '--Выберите статус--')]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
