<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

//use yii\httpclient\Client;
use app\models\SmsList;

use app\classes\api\SoftLine;
use app\classes\api\StreamTelecom;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


    public function actionGetSms()
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
            $sms = new SoftLine($value['sms_from'], 'Вітаємо!Ви стали учасником розіграшу 1000л пального. Деталі на vuso.ua');
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
