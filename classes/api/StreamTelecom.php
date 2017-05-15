<?php

namespace app\classes\api;

use yii\httpclient\Client;
use app\classes\base\WebApi;
use app\models\SmsList;

class StreamTelecom
{

    public $smsgate;
    public $stamp_from;
    public $stamp_to;
 
    function __construct($smsgate, $stamp_from, $stamp_to)
    {
          $this->smsgate = $smsgate;
          $this->stamp_from = $stamp_from;
          $this->stamp_to = $stamp_to;
    }

    /*
    * Получить список СМС
    * Вернет массив СМС с шлюза
    */
    public function smsList()
    {
        $client = new Client();
        $response = $client->createRequest()
        ->setMethod('post')
        ->setUrl('https://xxxxxxxxx.xxx/api/sms')
        ->setData(['username' => 'ИмяПользователя',
        'password' => 'Пароль',
        'api_key' => 'КлючAPI',
        'action' => 'smslist',
        'filter[smsgate]' => $this->smsgate,
        'filter[stamp_from]' => $this->stamp_from,
        'filter[stamp_to]' => $this->stamp_to
        ])
        ->send();
        
        if ($response->isOk) {
            return $response->data;
        } else {
            return [];
        }
    }
}
