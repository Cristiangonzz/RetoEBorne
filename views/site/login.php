<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;


$this->title = 'Login';

?>
<div class="site-login">




    <div class="row justify-content-center" style="margin-top: 60px;">

        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>
            <h1><?= Html::encode($this->title) ?></h1>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="bts">
                <a href="<?=Url::toRoute(['usuario/create'])?>"><span>Registrarse</span></a>
            </div>

            <div class="form-group">
                <div class="form-group text-center">
                    <?= Html::submitButton('Login', [
                        'class' => 'btn btn-primary btn-lg',
                        'style' => 'width: 200px;',
                        'name' => 'login-button',
                    ]) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>



        </div>
    </div>
</div>