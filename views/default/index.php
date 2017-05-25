<?php

use integready\pages\models\Pages;
use integready\pages\models\PagesCategory;
use integready\pages\PageHelper;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel integready\pages\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('pgs', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pages', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Edit Categories', \yii\helpers\Url::toRoute('categories/index'), ['class' => 'btn btn-warning']) ?>
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
                'filter'    => Html::activeDropDownList($searchModel, 'category_id', PagesCategory::getCategoryList(), ['class' => 'form-control', 'prompt' => Yii::t('pgs', 'Select-a-category')]),
            ],
            // 'text:ntext',
            [
                'attribute' => 'language',
                'value'     => 'language',
                'filter'    => Html::activeDropDownList($searchModel, 'language', PageHelper::getLanguagesList(), ['class' => 'form-control', 'prompt' => Yii::t('pgs', 'Trans-lang-choice')]),
            ],
            //'date_created',
            // 'date_updated',
            // 'date_published_in',
            // 'date_published_out',
            [
                'attribute' => 'sitemap',
                'value'     => function ($data) {
                    return Pages::getSitemapStatusById($data->sitemap);
                },
                'filter'    => Html::activeDropDownList($searchModel, 'sitemap', Pages::getSitemapStatusList(), ['class' => 'form-control', 'prompt' => Yii::t('pgs', 'Choose status')]),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
