<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Region;
use app\models\Client;

/* @var $this yii\web\View */
/* @var $model Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput() ?>

    <?= $form->field($model, 'name_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_i')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_o')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'place_reg')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'place_live')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'snils')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropdownList(
        Client::find()->select(['name_f', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Выберите клиента...']
    ); ?>

    <?= $form->field($model, 'on_delete')->checkbox() ?>

    <?= $form->field($model, 'region_id')->dropdownList(
        Region::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Выберите регион...']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
