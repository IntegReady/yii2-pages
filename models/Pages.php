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

    const SITEMAP_TRUE  = 1;
    const SITEMAP_FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @param $category_id
     *
     * @return $this
     */
    public static function getAllByCategoryQuery($category_id)
    {
        return static::find()
            ->where(['language' => Yii::$app->language])
            ->where(['category_id' => $category_id])
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
            'id'                 => Yii::t('fx', 'ID'),
            'title'              => Yii::t('fx', 'Title'),
            'alias'              => Yii::t('fx', 'Alias'),
            'category_id'        => Yii::t('fx', 'Category ID'),
            'text'               => Yii::t('fx', 'Text'),
            'language'           => Yii::t('fx', 'Language'),
            'date_created'       => Yii::t('fx', 'Date Created'),
            'date_updated'       => Yii::t('fx', 'Date Updated'),
            'date_published_in'  => Yii::t('fx', 'Date Published In'),
            'date_published_out' => Yii::t('fx', 'Date Published Out'),
            'sitemap'            => Yii::t('fx', 'Sitemap'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PagesCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @param $id
     *
     * @return mixed|string
     */
    public function getSitemapStatusById($id)
    {
        return isset(self::getSitemapStatusList()[$id]) ? self::getSitemapStatusList()[$id] : '';
    }

    /**
     * @return array
     */
    public static function getSitemapStatusList()
    {
        return [
            self::SITEMAP_FALSE => Yii::t('fx', 'not-in-sitemap'),
            self::SITEMAP_TRUE  => Yii::t('fx', 'in-sitemap'),
        ];
    }
}
