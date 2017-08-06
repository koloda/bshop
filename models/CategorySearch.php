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
        return ['title', 'parentTitle', 'active', 'slug'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'slug', 'title', 'parentTitle'], 'safe'],
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

        $query->joinWith(['parent' => function($query) {
            $query->from(['parent' => parent::tableName()]);
        }]);

        $dataProvider->sort->attributes['parentTitle'] = [
            'asc' => [parent::tableName().'.title' => SORT_ASC],
            'desc' => [parent::tableName().'.title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', '{{%category}}.slug', $this->slug]);
        $query->andFilterWhere(['like', 'parent.title', $this->parentTitle]);

        return $dataProvider;
    }

    /**
     * Find model by slug or id
     *
     * @param  mixed $identifier Category slug or id
     * @return Category
     */
    public static function identify($identifier)
    {
        if (is_numeric($identifier)) {
            $model = Category::findOne($identifier);
        } else {
            $model = Category::findOne(['slug' => $identifier]);
        }

        return $model;
    }
}
