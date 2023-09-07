<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProductCategoryoldSearcho $model */
/** @var yii\widgets\ActiveForm $form */
?>



<div class="productcategory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="container-fluid">
    <div class="row d-flex align-items-center">
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'idProduct') ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'idCategory_Family')->dropDownList(
                \yii\helpers\ArrayHelper::map($dataProvider->models, 'idCategory_Family', function ($modelC) {
                    return $modelC->categoryFamily->name;
                }),
                ['prompt' => 'Seleccione una categoría de familia']
            ) ?>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'idCategory_Group')->dropDownList(
                \yii\helpers\ArrayHelper::map($dataProvider->models, 'idCategory_Group', function ($modelC) {
                    return $modelC->categoryGroup->name;
                }),
                ['prompt' => 'Seleccione una categoría de grupo']
            ) ?>
        </div>
    </div>
</div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>