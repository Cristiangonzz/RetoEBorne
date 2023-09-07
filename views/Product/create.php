<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product-category/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCreate', [
        'model' => $model,
        'modelCategoryGroup' => $modelCategoryGroup,
        'modelCategoryFamily' => $modelCategoryFamily,
        'modelProductCategory' => $modelProductCategory,
    ]) ?>

</div>