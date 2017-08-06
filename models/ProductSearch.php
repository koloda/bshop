<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    public $categoryTitle;
    public $brandTitle;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'available', 'active', 'brand_id', 'gallery_id', 'updated_at', 'created_at'], 'integer'],
            [['title', 'description', 'sku', 'picture', 'slug', 'categoryTitle', 'brandTitle'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();
        $query->joinWith('category');
        $query->joinWith('brand');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //grid sorting
        $dataProvider->sort->attributes['categoryTitle'] = [
            'asc'   => ['{{%category}}.title' => SORT_ASC],
            'desc'  => ['{{%category}}.title' => SORT_DESC]
        ];
        $dataProvider->sort->attributes['brandTitle'] = [
            'asc'   => ['{{%brand}}.title' => SORT_ASC],
            'desc'  => ['{{%brand}}.title' => SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'available' => $this->available,
            'active' => $this->active,
            'brand_id' => $this->brand_id,
            'gallery_id' => $this->gallery_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', '{{%category}}.title', $this->categoryTitle])
            ->andFilterWhere(['like', '{{%brand}}.title', $this->brandTitle]);

        return $dataProvider;
    }

    /**
     * Find model by slug or id
     *
     * @param  mixed $identifier Product slug or id
     * @return Product
     */
    public static function identify($identifier)
    {
        if (is_numeric($identifier)) {
            $model = Product::findOne($identifier);
        } else {
            $model = Product::findOne(['slug' => $identifier]);
        }

        return $model;
    }
}
