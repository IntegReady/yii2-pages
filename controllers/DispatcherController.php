<?php

namespace muravshchyk\pages\controllers;

use muravshchyk\pages\models\Pages;
use muravshchyk\pages\models\PagesCategory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `pages` module
 */
class DispatcherController extends Controller
{
    /**
     * @param null $category
     * @param null $alias
     *
     * @return string
     * @throws NotFoundHttpException
     */

    public function actionIndex($category = null, $alias = null)
    {
        $model_cat = PagesCategory::findOne(['name' => $category]);
        if (!empty($model_cat) && !empty($alias)) {
            $page = Pages::findOne(['alias' => $alias, 'category_id' => $model_cat->id, 'language' => Yii::$app->language]);
            if (!empty($page)) {
                return $this->render('page_view', ['model' => $page, 'category_name' => $model_cat->name, 'category_name' => $model_cat->name]);
            }
        } elseif (!empty($model_cat) && empty($alias)) {
            $query      = Pages::getAllByCategoryQuery($model_cat->id);
            $countQuery = clone $query;
            $pages      = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => Pages::DEFAULT_PAGE_SIZE]);
            $models     = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('page_list', [
                'models'        => $models,
                'pages'         => $pages,
                'category_name' => $model_cat->name,
            ]);
        } elseif (empty($model_cat) && empty($alias)) {
            $query      = PagesCategory::find();
            $countQuery = clone $query;
            $pages      = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => Pages::DEFAULT_PAGE_SIZE]);
            $models     = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index', [
                'models' => $models,
                'pages'  => $pages,
            ]);
        } else {
            throw new NotFoundHttpException(Yii::t('fx-exception', 'fx-page-not-found'));
        }
    }
}
