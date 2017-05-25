<?php

namespace integready\pages\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $category_id
 * @property string $text
 * @property string $language
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_published_in
 * @property string $date_published_out
 * @property integer $sitemap
 *
 * @property PagesCategory $category
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('pgs', 'ID'),
            'name'        => Yii::t('pgs', 'Name'),
            'description' => Yii::t('pgs', 'Description'),
        ];
    }
}
