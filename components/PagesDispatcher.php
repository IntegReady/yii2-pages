<?php

namespace muravshchyk\pages\components;

use Yii;
use muravshchyk\pages\models\Pages;
use muravshchyk\pages\models\PagesCategory;

/**
 * Dispatcher of the Pages Module
 */
class PageDispatcher
{
    /**
     * Get Text of page by Category name, Alias, and Language
     *
     * @param $category
     * @param $alias
     * @param null $lang
     *
     * @return string
     */
    public static function getPageHTML($category, $alias, $lang = null)
    {
        $result = '';
        // Если язык не задан - принимаем текущий язык по умолчанию
        $language  = $lang ? $lang : Yii::$app->language;
        $model_cat = PagesCategory::findOne(['name' => $category]);
        if (!empty($model_cat)) {
            $page = Pages::findOne(['alias' => $alias, 'category_id' => $model_cat->id, 'language' => $language]);
            if (!empty($page)) {
                $result = $page->text;
            }
        }

        return $result;
    }

    /**
     * Get all pages by Category name and Language
     * @param $category
     * @param null $lang
     *
     * @return null|static[]
     */
    public static function getPagesOfCategory($category, $lang = null)
    {
        $result = null;
        // Если язык не задан - принимаем текущий язык по умолчанию
        $language  = $lang ? $lang : Yii::$app->language;
        $model_cat = PagesCategory::findOne(['name' => $category]);
        if (!empty($model_cat)) {
            $result = Pages::findAll(['category_id' => $model_cat->id, 'language' => $language]);
        }

        return $result;
    }
}