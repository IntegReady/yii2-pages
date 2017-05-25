<?php

use integready\pages\models\Pages;
use integready\pages\models\PagesCategory;
use integready\pages\PageHelper;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel integready\pages\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('pgs', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Edit Pages', \yii\helpers\Url::toRoute('default/index'), ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
