<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SmsList */

$this->title = 'Create Sms List';
$this->params['breadcrumbs'][] = ['label' => 'Sms Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
