<?php

use integready\pages\PageHelper;
use yii\grid\GridView;
use yii\helpers\Url;

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var string $category_name
 */

$this->title                   = Yii::t('pgs', $category_name);
$this->params['breadcrumbs'][] = $this->title;
$this->params['category']      = $category_name;
?>

<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="row news-list">
            <div class="col-xs-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => ''],
                    'summary'      => false,
                    'columns'      => [
                        [
                            'format' => 'raw',
                            'value'  => function ($data) {
                                $html = '<div class="news-item-new">';
                                $html = '<div class="news-item__title">';
                                $html .= ' <span class="news-item__date">';
                                $html .= Yii::$app->formatter->asDatetime($data->date_published_in, 'php:d.m.Y H:i');
                                $html .= '</span>';
                                $html .= '<a href="' . Url::to([$this->params['category'] . '/' . $data->alias]) . '">';
                                $html .= $data->title;
                                $html .= '</a>';
                                $html .= '</div>';
                                $html .= '<div class="news-item__teaser">';
                                $html .= '<p>' . PageHelper::makePreviewSnippet($data->text) . '</p>';
                                $html .= '</div>';
                                $html .= '</div>';

                                return $html;
                            },
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
