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

    <!--    --><? //= $form->field($model, 'user_id')->hiddenInput() ?>

    <?= $form->field($model, 'name_f')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_i')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_o')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'place_reg')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'place_live')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'snils')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-client-parent_id">
        <label class="control-label" for="ClientParentFio">Пришёл от</label>
        <input id="ClientParentId" type="hidden" name="Client[parent_id]" value="<?= $model->parent_id ?>"/>
        <input id="ClientParentFio" type="text" class="form-control" readonly value="<?= $model->getParent()->fioSnils ?>" data-toggle="modal"
               data-target="#SelectParentModal"/>
        <div class="help-block">
            <?php if ($parent_error): ?>
                <div class="alert alert-danger"><?= $parent_error ?></div>
            <?php endif; ?>
        </div>
    </div>

    <?= $form->field($model, 'on_delete')->checkbox() ?>

    <?= $form->field($model, 'region_id')->dropdownList(
        Region::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выберите регион...']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Модаль -->
<div class="modal fade" id="SelectParentModal" data-self-id="<?= $model->id ?>" data-parent-id="<?= $model->parent_id ?>" tabindex="-1" role="dialog" aria-labelledby="SelectParentModalLabel">

</div>

