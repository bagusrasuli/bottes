<?php
// defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
// debugExternal("supp");
// exit;
// include "configDB.php";

date_default_timezone_set('Asia/Jakarta');

$jsonnya = file_get_contents("php://input");

curlUrl("https://webini.com/hr/web/bot/webhook", ['jsonnya' => $jsonnya, 'idnya' => $_GET['id']]);
exit;


function curlUrl($urlnya, $post = [])
{
    //TELEGRAM

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