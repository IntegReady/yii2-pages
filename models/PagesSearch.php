<?php

namespace integready\pages\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PagesSearch represents the model behind the search form about `integready\pages\models\Pages`.
 */
class PagesSearch extends Pages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'sitemap'], 'integer'],
            [['title', 'alias', 'text', 'language', 'date_created', 'date_updated', 'date_published_in', 'date_published_out'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pages::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'                 => $this->id,
            'category_id'        => $this->category_id,
            'date_created'       => $this->date_created,
            'date_updated'       => $this->date_updated,
            'date_published_in'  => $this->date_published_in,
            'date_published_out' => $this->date_published_out,
            'sitemap'            => $this->sitemap,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
