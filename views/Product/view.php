<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product-category/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this Product?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'price',
        ],
    ]) ?>
<h3>Categoria de  Familia</h3>
    <?= DetailView::widget([
        'model' => $modelCategoryFamily,
        'attributes' => [
            'name',
            'type',
        ],
    ]) ?>
<h3>Categoria de Grupo</h3>
<?= DetailView::widget([
        'model' => $modelCategoryGroup,
        'attributes' => [
            'name',
            'type',
        ],
    ]) ?>



</div>
