<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Productcategory $model */

$this->title = 'Update Productcategory: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Productcategorys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productcategory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
