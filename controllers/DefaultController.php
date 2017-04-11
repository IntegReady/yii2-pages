<?php

namespace common\modules\controllers;

use common\modules\models\Pages;
use common\modules\models\PagesCategory;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `pages` module
 */
class DefaultController extends Controller
{
    /**
     * @param null $category
     * @param null $alias
     *
     * @return string
     * @throws NotFoundHttpException
     */

    public function actionIndex($category = 'static', $alias = 'contest_traders')
    {
        // Try to find id category by category name
        $category = PagesCategory::findOne(['name' => $category]);
        if (!empty($category)) {
            // Try to find page by alias and category_id
            $page = Pages::findOne(['alias' => $alias, 'category_id' => $category->id, 'language' => Yii::$app->language]);
            if (!empty($page)) {
                return $this->render('view', ['model' => $page]);
            } else {
                $query      = Pages::getAllByCategoryQuery($category->id);
                $countQuery = clone $query;
                $pages      = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => Pages::DEFAULT_PAGE_SIZE]);
                $models     = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();

                return $this->render('list', [
                    'models' => $models,
                    'pages'  => $pages,
                ]);
            }
        } else {
            throw new NotFoundHttpException(Yii::t('fx-exception', 'fx-page-not-found'));
        }
    }
}
