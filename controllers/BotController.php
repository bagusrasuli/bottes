<?php

namespace app\controllers;

use app\components\Helper;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TUser;
use Exception;
use yii\helpers\Url;

class BotController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;

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
     * Displays homepage.
     *
     * @return string
     */

    public function actionWebhook()
    {

        header("Access-Control-Allow-Origin: *");
        date_default_timezone_set('Asia/Jakarta');
        $this->enableCsrfValidation = false;

        $jsonnya = $_POST['jsonnya'];
        $idnya = $_POST['idnya'];


        $update = json_decode($jsonnya, TRUE);
        // Helper::debugExternal($jsonnya);


        $TOKEN = Yii::$app->params['TOKEN'];; //'5617979755:AAFIIPhKo1tQc8cElsP4Q4SPTbvqty0QokM';
        $apiURL = Yii::$app->params['apiURL'];; //"https://api.telegram.org/bot$TOKEN";


        // CALLBACK QUERY
        if (isset($update['callback_query'])) {
            // $view = strtoupper(str_replace("_", " ", $update['callback_query']['data']));
            // $view = "Halaman ";// . @(explode('-', $update['callback_query']['data'])[1]) + 1;
            $view = null;   //strtoupper(str_replace("_", " ", $update['callback_query']['data']));
            $add = "";
            $chat_id_ = $update['callback_query']['message']['chat']['id'];

            if (strpos($update['callback_query']['data'], "list_menu") !== false) {
                $text = $update['callback_query']['data'];
                $ke_page = @explode("-", $text)[1];
                //UBAH MENU LIST
                $is_login = Helper::cekStatusLogin($chat_id_);
                Helper::showListMenuCallBack($update, $apiURL, $add, $ke_page, $is_login);
                // file_get_contents($apiURL . "/editMessageText?message_id=" . $update['callback_query']['message']['message_id'] . "&chat_id=" . $update['callback_query']['message']['chat']['id'] . "&text=" . $text); // . "&parse_mode=HTML" . $add);
            }
            file_get_contents($apiURL . "/answerCallbackQuery?callback_query_id=" . $update['callback_query']['id'] . "&text=" . $view . "&parse_mode=HTML" . $add);
            // Helper::debugExternal('callback query:' . $update['callback_query']['data']);  exit;
        }
        // CALLBACK QUERY END

        $chatID = $update["message"]["chat"]["id"];
        $userNAME = $update["message"]["chat"]["username"]; //__________________
        $messageID = $update["message"]["message_id"];
        $message_in = $update["message"]["text"];
        $fullname = $update["message"]['from']['first_name'] . " " . @$update["message"]['from']['last_name'];
        // Helper::debugExternal($jsonnya);  exit;

        $linkFull = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

        // Helper::debugExternal($idnya);

        $n = "\n";
        $add = "";
        if ($update["message"]['chat']['type'] !== 'private' || $idnya !== $TOKEN) {
            exit();
        }

        @self::insertUser($userNAME, $fullname, $chatID);
        $getUser = Helper::getUser($chatID);
        if($getUser){
            $fullname = @$getUser['nama'];
        }

        if ($message_in == "/start") {
            $message_out = "Selamat datang " . $fullname . "";
                // . "\n"
                // . "<i>Untuk petunjuk klik --></i> /help";
            $message_out = urlencode($message_out);
            $data = file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=" . $message_out . "&parse_mode=HTML" . $add);
            // DEFAULT
            // $is_login = Helper::cekStatusLogin($chatID);
            Helper::showListMenu($chatID, $apiURL, $add, $getUser);
            exit();
        }


        if ($message_in == "/tes") {
            $message_out = "Tus, ";
            $message_out = urlencode($message_out);
            $data = file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=" . $message_out . "&parse_mode=HTML" . $add);
            exit();
        }

        // DEFAULT
        // $is_login = Helper::cekStatusLogin($chatID);
        Helper::showListMenu($chatID, $apiURL, $add, $getUser);
        if ($getUser) {
        } else {
        }



        exit;

        $tes = TUser::find()->one();

        echo "<pre>";
        print_r($tes);
        exit;
    }

    static function insertUser($userNAME, $nama, $chat_id)
    {
        try{
            $tuser = TUser::find()
                ->where(['chat_id' => $chat_id])
                ->one();
            if ($tuser) {
                $tuser->username = $userNAME;
            } else {
                $tuser = new TUser();
                $tuser->nama = $nama;
                $tuser->username = $userNAME;
                $tuser->chat_id = $chat_id;
            }
            $out = $tuser->save(false);
            return $out;
        } catch (Exception $err) {
            Helper::debugExternal(($err));
        }
       
    }


    static function curlUrl($urlnya, $post = [])
    {
        //TELEGRAM
        // $send = str_replace('<br>', PHP_EOL, $hasil);
        $send = ("");
        // @file_get_contents('https://api.telegram.org/'.$tokenapi.'/sendMessage?chat_id='.$chatidapi.'&text='.$send."&parse_mode=HTML");
        // exit;

        // set post fields
        // $post = [
        //     // 'text' => $send
        // ];

        $ch = curl_init($urlnya);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);
        //TELEGRAM
        return $response;
    }

    function writeResponse($condition, $msg = null, $data = null)
    {
        $_res = new \stdClass();
        $_res->con = $condition == true ? true : false;
        $_res->msg = $msg;
        $_res->results = $data;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // $response = new \Phalcon\Http\Response();
        // return $response->setContent(json_encode($_res));
        return $_res;
    }
}
