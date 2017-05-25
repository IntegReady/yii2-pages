<?php

namespace integready\pages\models;

use Yii;

/**
 * This is the model class for table "pages_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Pages[] $pages
 */
class PagesCategory extends \yii\db\ActiveRecord
{
    const STATICS  = 1;
    const NEWS     = 2;
    const ANALYTIC = 3;

    const STATICS_LABEL  = 'Static';
    const NEWS_LABEL     = 'News';
    const ANALYTIC_LABEL = 'Analytics';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages_category';
    }

    /**
     * @param $id
     *
     * @return mixed|string
     */
    public static function getCategoryById($id)
    {
        return isset(self::getCategoryList()[$id]) ? self::getCategoryList()[$id] : '';
    }

    /**
     * @return array
     */
    public static function getCategoryList()
    {
        return [
            self::STATICS  => Yii::t('pgs', self::STATICS_LABEL),
            self::NEWS     => Yii::t('pgs', self::NEWS_LABEL),
            self::ANALYTIC => Yii::t('pgs', self::ANALYTIC_LABEL),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('pgs', 'ID'),
            'name'        => Yii::t('pgs', 'Category name'),
            'description' => Yii::t('pgs', 'Category description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['category_id' => 'id']);
    }
}
