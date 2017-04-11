<?php

namespace common\modules\models;

use Yii;

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
class Pages extends \yii\db\ActiveRecord
{
    const STATICS  = 1;
    const NEWS     = 2;
    const ANALYTIC = 3;

    const DEFAULT_PAGE_SIZE = 20;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @param int $category
     *
     * Returns query
     * @return \yii\db\ActiveQuery
     */
    public static function getAllByCategoryQuery($category_id = self::STATICS)
    {
        return static::find()
            ->where(['language' => Yii::$app->language])
            //->where(['category_id' => $category_id])
            ->andWhere('date_published_in < now() and (date_published_out > now() or date_published_out is null)')
            ->orderBy('date_published_in DESC');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['category_id', 'sitemap'], 'integer'],
            [['text'], 'string'],
            [['date_created', 'date_updated', 'date_published_in', 'date_published_out'], 'safe'],
            [['title'], 'string', 'max' => 2048],
            [['alias'], 'string', 'max' => 64],
            [['language'], 'string', 'max' => 32],
            [['alias', 'language'], 'unique', 'targetAttribute' => ['alias', 'language'], 'message' => 'The combination of Alias and Language has already been taken.'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PagesCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                 => 'ID',
            'title'              => 'Title',
            'alias'              => 'Alias',
            'category_id'        => 'Category ID',
            'text'               => 'Text',
            'language'           => 'Language',
            'date_created'       => 'Date Created',
            'date_updated'       => 'Date Updated',
            'date_published_in'  => 'Date Published In',
            'date_published_out' => 'Date Published Out',
            'sitemap'            => 'Sitemap',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PagesCategory::className(), ['id' => 'category_id']);
    }
}
