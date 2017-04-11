<?php

use common\H\News as NewsHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/**
 * @var common\models\StaticPages[] $models
 * @var array|mixed $pages
 */

$this->title = Yii::t('fx', 'fx-static-pages-view-title');
?>
<div class="grid-container">
    <?php foreach ($models as $model) : ?>
        <div>
            <h2><?php echo $model->title; ?></h2>
            <p><?php echo NewsHelper::makePreviewSnippet($model->text); ?></p>
            <a href="<?php echo Url::to(['/' . $model->alias]); ?>"><?= Yii::t('fx-main', 'fx-read-more') ?>...</a>
        </div>
    <?php endforeach; ?>

    <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>
