<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model muravshchyk\pages\models\Categories */

$this->title                   = Yii::t('pgs', 'Update Category: ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('c__form', [
        'model' => $model,
    ]) ?>

</div>
