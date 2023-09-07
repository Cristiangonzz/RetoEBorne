<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductCategory;

/**
 * ProductCategorySearch represents the model behind the search form of `app\models\ProductCategory`.
 */
class ProductCategorySearch extends ProductCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProduct', 'idCategory_Family', 'idCategory_Group'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ProductCategory::find()
            ->where(['productcategory.available' => 1]);



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->idProduct)) {
            $query->joinWith(['product']);
            $query->andFilterWhere(['like', 'product.name', $params['ProductCategorySearch']['idProduct']]);
        }

        if (!empty($this->idCategory_Group)) {
            $query->joinWith(['categoryGroup']);
            $query->andWhere(['category.id' => $this->idCategory_Group]);
        }

        if (!empty($this->idCategory_Family)) {
            $query->joinWith(['categoryFamily']);
            $query->andFilterWhere(['category.id' => $this->idCategory_Family]);
        }


        return $dataProvider;
    }
}
