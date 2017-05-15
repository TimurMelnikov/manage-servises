<?php

namespace app\classes\api;

use app\classes\base\WebApi;

class SoftLine
{
    public $phone_number;
    public $message_text;
 
    function __construct($phone_number, $message_text)
    {
          $this->phone_number = $phone_number;
          $this->message_text = $message_text;
    }

    public function sendSms()
    {
        $result =  file_get_contents('http://XXX.XXX.XXX.XX:XXXX/method?Login=Логин&From=НазваниеКомпании&To='
        .$this->phone_number
        .'&Text='
        .urlencode($this->message_text));

        if (substr($result, 0, 12)  == 'Status: sent') {
            return true;
        } else {
            return false;
        }
    }
}
