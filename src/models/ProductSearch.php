<?php

namespace nullref\product\models;

use nullref\core\behaviors\HasOneRelation;
use nullref\core\behaviors\HasRelation;
use nullref\core\behaviors\ManyHasOneRelation;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form about `nullref\product\models\Product`.
 */

/** A little bit of magic */
if (class_exists('\app\models\Product')) {
    class ParentProductSearch extends \app\models\Product
    {
    }
} elseif (class_exists('\app\modules\product\models\Product')) {
    class ParentProductSearch extends \app\modules\product\models\Product
    {
    }
} else {
    class ParentProductSearch extends Product
    {
    }
}

class ProductSearch extends ParentProductSearch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $fields = [];
        foreach ($this->behaviors as $behavior) {
            if ($behavior instanceof HasRelation) {
                $fields[] = $behavior->getAttributeName();
            }
        }
        return array_merge([
            [['id', 'status', 'createdAt', 'updatedAt'], 'integer'],
            [['title', 'image', 'description'], 'safe'],
            [['price'], 'number'],
        ], [[$fields, 'safe']]);
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
    public function search($params = [])
    {
        $query = ParentProductSearch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        foreach ($this->behaviors as $behavior) {
            if ($behavior instanceof ManyHasOneRelation) {
                $query->andFilterWhere([$behavior->getAttributeName() => $this->{$behavior->getAttributeName()}]);
            }
        }

        $query->andWhere(['deleted' => null]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
