<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SmsListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sms Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sms-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sms List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sms_id',
            'sms_stamp',
            //'sms_direction',
            'sms_from',
            'sms_to',
            'sms_text',
            //'response_id',
            'response_stamp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); 


echo date('Y-m-d').'<br>';
echo date('Y-m-d');

$stop_date = new DateTime(date('Y-m-d'));
$stop_date->modify('-1 day');
echo 'date after adding 1 day: ' . $stop_date->format('Y-m-d');

?></div>
