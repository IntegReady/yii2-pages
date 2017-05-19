<?php

namespace muravshchyk\pages\components;

use Yii;
use muravshchyk\pages\models\Pages;
use muravshchyk\pages\models\PagesCategory;
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
            $page = Pages::findOne(['alias' => $alias, 'category_id' => $model_cat->id, 'language' => $language]);
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
}