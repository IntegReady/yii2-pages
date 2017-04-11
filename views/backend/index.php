<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\models\PagesSearch */
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

            'id',
            'title',
            'alias',
            'category_id',
            'text:ntext',
            'language',
            'date_created',
            // 'date_updated',
            // 'date_published_in',
            // 'date_published_out',
            'sitemap',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
