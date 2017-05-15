<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SmsList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sms_id')->textInput() ?>

    <?= $form->field($model, 'sms_stamp')->textInput() ?>

    <?= $form->field($model, 'sms_direction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sms_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sms_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sms_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'response_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
