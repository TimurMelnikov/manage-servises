<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sms_list}}".
 *
 * @property integer $id
 * @property integer $sms_id
 * @property string $sms_stamp
 * @property string $sms_direction
 * @property string $sms_from
 * @property string $sms_to
 * @property string $sms_text
 * @property integer $response_id
 */
class SmsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%p_bf_sms_action}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sms_id'], 'required'],
            [['sms_id', 'response_id'], 'integer'],
            //[['sms_stamp', 'response_stamp'], 'safe'],
            [['sms_direction'], 'string', 'max' => 10],
            [['sms_from', 'sms_to'], 'string', 'max' => 15],
            [['sms_text'], 'string', 'max' => 1000],
            [['sms_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sms_id' => 'ID в CRM',
            'sms_stamp' => 'Дата',
            'sms_direction' => 'Тип',
            'sms_from' => 'Отправитель',
            'sms_to' => 'Получатель',
            'sms_text' => 'Текст СМС',
            'response_id' => 'ID ответной СМС',
            'response_stamp'=>'Дата ответа'
        ];
    }
}
