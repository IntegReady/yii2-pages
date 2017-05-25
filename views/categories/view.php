<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use integready\pages\models\Pages;
use integready\pages\models\PagesCategory;

/* @var $this yii\web\View */
/* @var $model integready\pages\models\Categories */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pgs', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Вы уверены что хотите удалить эту станицу?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'name',
            'description',
        ],
    ]) ?>

</div>
