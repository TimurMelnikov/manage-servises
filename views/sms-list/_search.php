<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SmsListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sms-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sms_id') ?>

    <?= $form->field($model, 'sms_stamp') ?>

    <?= $form->field($model, 'sms_direction') ?>

    <?= $form->field($model, 'sms_from') ?>

    <?php // echo $form->field($model, 'sms_to') ?>

    <?php // echo $form->field($model, 'sms_text') ?>

    <?php // echo $form->field($model, 'response_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
