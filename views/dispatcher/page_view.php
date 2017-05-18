<?php

use yii\widgets\Breadcrumbs;

$this->title = $model->title;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('fx', $category_name),
    'url'   => '/pages/' . $category_name,
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="news-full">
            <span class="news-full__date"><?= Yii::$app->formatter->asDatetime($model->date_published_in, 'php:d.m.Y H:i'); ?></span>
            <p><?php echo $model->text; ?></p>
        </div>
    </div>
</div>