<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model integready\pages\models\Categories */

$this->title                   = Yii::t('pgs', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('pgs', 'Create Category'), 'url' => ['categories']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
