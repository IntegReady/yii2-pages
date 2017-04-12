<?php

namespace common\modules\models;

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

    const STATICS_LABEL  = 'static';
    const NEWS_LABEL     = 'news';
    const ANALYTIC_LABEL = 'analytics';

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
            self::STATICS  => Yii::t('fx', self::STATICS_LABEL),
            self::NEWS     => Yii::t('fx', self::NEWS_LABEL),
            self::ANALYTIC => Yii::t('fx', self::ANALYTIC_LABEL),
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
            'id'          => Yii::t('fx', 'ID'),
            'name'        => Yii::t('fx', 'Category name'),
            'description' => Yii::t('fx', 'Category description'),
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
