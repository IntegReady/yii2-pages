<?php

namespace integready\pages\components;

use Yii;
use integready\pages\models\Pages;
use integready\pages\models\PagesCategory;
use yii\db\Query;

/**
 * Dispatcher of the Pages Module
 */
class PageDispatcher
{
    /**
     * Get Text of page by Category name, Alias, and Language
     * @param $category
     * @param $alias
     * @param null $lang
     *
     * @return null|Pages
     */
    public static function getPageHTML($category, $alias, $lang = null)
    {
        $result = null;
        // Если язык не задан - принимаем текущий язык по умолчанию
        $language  = $lang ? $lang : Yii::$app->language;
        $model_cat = PagesCategory::findOne(['name' => $category]);
        if (!empty($model_cat)) {
            $page = Pages::find()->where(['alias' => $alias, 'category_id' => $model_cat->id, 'language' => Yii::$app->language])
                ->andWhere('date_published_in < now() and (date_published_out > now() or date_published_out is null)')
                ->one();
            if (!empty($page)) {
                $result = $page;
            }
        }

        return $result;
    }

    /**
     * Get all pages query by Category name and Language
     * @param $category
     * @param null $lang
     *
     * @return Query
     */
    public static function getPagesOfCategoryQuery($category, $lang = null)
    {
        $result = null;
        // Если язык не задан - принимаем текущий язык по умолчанию
        $language  = $lang ? $lang : Yii::$app->language;
        $model_cat = PagesCategory::findOne(['name' => $category]);
        if (!empty($model_cat)) {
            $query = Pages::getAllByCategoryQuery($model_cat->id, $language);
            $data = $query->all();
            if(!empty($data)){
                $result = $query;
            }
        }

        return $result;
    }

    /**
     * Get sql query string for yii\caching\DbDependency
     * @return string
     */
    public static function getCategoryDbDependencySQL($category)
    {
        $model_cat = PagesCategory::findOne(['name' => $category]);
        return 'SELECT crc32(date_updated) FROM ' . Pages::tableName() . ' WHERE `category_id` = ' . $model_cat->id . ' ORDER BY date_updated DESC LIMIT 1';
    }

    /**
     * Get sql query for LastModified
     * @param $category
     * @param $alias
     * @param $lang
     *
     * @return mixed
     */
    public static function getLastModifiedQuery($category = null, $alias = null, $lang = null)
    {
        $language  = $lang ? $lang : Yii::$app->language;
        $q     = new Query();

        $params = ['language' => $language];
        if(!empty($category)){
            $model_cat = PagesCategory::findOne(['name' => $category]);
            $params['category_id'] = $model_cat->id;
        }
        if(!empty($alias)){
            $params['alias'] = $alias;
        }
        return $q->from(Pages::tableName())->where($params)->max('UNIX_TIMESTAMP(date_updated)');
    }
}