<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SmsList */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sms Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sms_id',
            'sms_stamp',
            'sms_direction',
            'sms_from',
            'sms_to',
            'sms_text',
            'response_id',
        ],
    ]) ?>

</div>
