<?php

namespace frontend\controllers;

use integready\pages\components\PageDispatcher;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class PagesController extends Controller
{

    /**
     * Вывод статических страниц
     * @return mixed
     */
    public function actionIndex($param1 = null, $param2 = null)
    {
        // Категория по умолчанию
        $defaultCategory = 'static';
        $cat             = '';
        // Если передан только первый параметр
        if (!empty($param1) && empty($param2)) {
            // Ищем страницу в категории по умолчанию
            $cat   = $defaultCategory;
            $alias = $param1;
            $page  = PageDispatcher::getPageHTML($cat, $alias);
            if (empty($page)) {
                // Если таковой страницы нет
                // Ищем категорию с таким названием
                $cat        = $param1;
                $pagesQuery = PageDispatcher::getPagesOfCategoryQuery($cat);
            }
        }
        // Если переданы оба параметра
        if (!empty($param1) && !empty($param2)) {
            // Ищем страницу в соответвующей категории
            $cat   = $param1;
            $alias = $param2;
            $page  = PageDispatcher::getPageHTML($cat, $alias);
        }

        // Если нашли хоть какую-то страницу
        // Выводим её
        if (!empty($page)) {
            return $this->render('view', [
                'model'         => $page,
                'category_name' => $cat,
            ]);
        }

        // Если нашли категорию (отличающуюся от категории по умолчанию)
        // Выводим её
        if (!empty($pagesQuery) && $cat != $defaultCategory) {
            $pagesDataProvider = new ActiveDataProvider([
                'query'      => $pagesQuery,
                'pagination' => [
                    'pageSize' => 2,
                ],
            ]);

            return $this->render('list', [
                    'dataProvider'  => $pagesDataProvider,
                    'category_name' => $cat,
                ]
            );
        }

        // Если не нашли ничего
        // Отдаём 404
        throw new NotFoundHttpException(Yii::t('pgs', 'fx-page-not-found'));
    }
}
