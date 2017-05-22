<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model muravshchyk\pages\models\Categories */

$this->title                   = Yii::t('pgs', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['categories']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
