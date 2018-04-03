<?php

namespace integready\pages\models;

use Yii;
use yii\helpers\ArrayHelper;

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
        $category = self::find()->all();

        return ArrayHelper::map($category, 'id', 'name');
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
