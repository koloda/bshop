<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form about `app\models\Category`.
 */
class CategorySearch extends Category
{
    public function attributes()
    {
        return ['title', 'parentTitle'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'parentTitle'], 'safe'],
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
        $query = Category::find();

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

        $query->joinWith(['parent' => function($query) {
            $query->from(['parent' => parent::tableName()]);
        }]);

        // grid filtering conditions
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'parent.title', $this->parentTitle]);


        $dataProvider->sort->attributes['parentTitle'] = [
            'asc' => ['parent.title' => SORT_ASC],
            'desc' => ['parent.title' => SORT_DESC],
        ];

        return $dataProvider;
    }
}
