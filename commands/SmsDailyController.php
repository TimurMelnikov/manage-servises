<?php

namespace app\commands;

use yii\console\Controller;
use app\models\SmsList;
use app\classes\api\SoftLine;
use app\classes\api\StreamTelecom;

class SmsDailyController extends Controller
{


    public function actionIndex()
    {
        //Будем забирать все, что есть на рервере за последние 2 дня
        $stamp_from = new \DateTime(date('Y-m-d'));
        $stamp_from->modify('-2 day');

        $sms_list = new StreamTelecom('1357', $stamp_from->format('Y-m-d'), date('Y-m-d'));
        $data = $sms_list->smsList();
        
        echo 'Poluchaem spisok SMS ot StreamTelecom'. "\n";
        foreach ($data['smslist'] as $value) {
            //Пишем в базу
            if ($value['direction']=='in' && /**/ preg_match('/^\+380\d{9}$/', $value['from'])) {
                $sms_list = new SmsList;
                $sms_list->sms_id = $value['id'];
                $sms_list->sms_stamp = $value['stamp'];
                $sms_list->sms_direction = $value['direction'];
                $sms_list->sms_from = $value['from'];
                $sms_list->sms_to = $value['to'];
                $sms_list->sms_text = $value['text'];
                $sms_list->save();
                echo $value['id'].' '
                . $value['from'].' '
                .$value['text']
                . "\n";
            }
            //Пишем в базу (конец)
        }

//Отправляем СМС тем, у которых не отмечена Дата ответа
        $rows = (new \yii\db\Query())
        ->select(['id', 'sms_from'])
        ->from('{{%p_bf_sms_action}}')
        ->where(['response_stamp' => null])
        ->all();

        echo 'Otpravluaem SMS uchastnikam akcii'. "\n";
        foreach ($rows as $value) {
                echo  $value['id'].' '
                . $value['sms_from'] . "\n";
            
            //Отправка СМС
            $sms = new SoftLine($value['sms_from'], 'Текст СМС сообщения');
            if ($sms->sendSms()) {
                $sms_list = SmsList::findOne($value['id']);
                $sms_list->response_stamp = date('Y-m-d h:i:s');
                $sms_list->update();
                echo 'SMS otpravleno!'. "\n";
            } else {
                echo 'Neudacha...'. "\n";
            }
            unset($sms);
            /**/
        }
//Отправляем СМС тем, у которых не отмечена Дата ответа (конец)
    }
}
