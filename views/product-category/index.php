<?php

use app\models\ProductCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product--category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel , 'dataProvider' => $dataProvider]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'idProduct',
                'value' => function ($model) {
                    return $model->product->name;
                },
            ],
            [
                'attribute' => 'Price',
                'value' => function ($model) {
                    return $model->product->price;
                },
            ],
            [
                'attribute' => 'idCategory_Family',
                'value' => function ($model) {
                    return $model->categoryFamily->name;
                },
            ],
            [
                'attribute' => 'idCategory_Group',
                'value' => function ($model) {
                    return $model->categoryGroup->name;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProductCategory $model, $key, $index, $column) {
                    return Url::toRoute(['product/'. $action, 'id' => $model->idProduct]);
                }
            ],
        ],
    ]); ?>


</div>