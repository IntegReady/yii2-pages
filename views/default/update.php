<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model integready\pages\models\Pages */

$this->title                   = Yii::t('pgs', 'Update page') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('pgs', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('pgs', 'Update');
?>
<div class="pages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
