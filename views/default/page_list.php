<?php

use common\modules\models\PagesCategory;
use common\modules\PageHelper;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/**
 * @var common\models\Analytics[] $models
 * @var array|mixed $pages
 */

$this->title                   = Yii::t('fx', $category_name);
$this->params['breadcrumbs'][] = $this->title;

if ($category_name == PagesCategory::NEWS_LABEL) {
    $this->params['brandingImageClass'] = 'b3';
}
?>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="news-list row">
            <div class="col-xs-12">
                <?php foreach ($models as $model) : ?>
                    <div class="news-item-new">
                        <div class="news-item__title">
                            <span class="news-item__date"><?= Yii::$app->formatter->asDatetime($model->date_published_in, 'php:d.m.Y H:i'); ?></span>
                            <a href="<?php echo Url::to([$category_name . '/' . $model->alias]); ?>">
                                <?php echo $model->title; ?>
                            </a>
                        </div>
                        <div class="news-item__teaser">
                            <p><?php echo PageHelper::makePreviewSnippet($model->text); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    </div>
</div>