<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($modelProductCategory, 'idCategory_Family')->dropDownList(
        \yii\helpers\ArrayHelper::map($modelCategoryFamily, 'id', 'name'),
        ['prompt' => 'Seleccione una categoría de familia']
    ) ?>

    <?= $form->field($modelProductCategory, 'idCategory_Group')->dropDownList(
        \yii\helpers\ArrayHelper::map($modelCategoryGroup, 'id', 'name'),
        ['prompt' =>'Seleccione una categoría de grupo']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success'])  ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>