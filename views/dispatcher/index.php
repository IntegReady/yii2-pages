<?php

use muravshchyk\pages\PageHelper;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/**
 * @var common\models\Analytics[] $models
 * @var array|mixed $pages
 */

$this->title                   = Yii::t('fx', 'Страницы');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="news-list row">
            <div class="col-xs-12">
                <?php foreach ($models as $model) : ?>
                    <div class="news-item-new">
                        <div class="news-item__title">
                            <a href="<?php echo Url::to([$model->name . '/']); ?>">
                                <?php echo Yii::t('fx', $model->name); ?>
                            </a>
                        </div>
                        <div class="news-item__teaser">
                            <p><?php echo PageHelper::makePreviewSnippet($model->description); ?></p>
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