<?php
/*

//-------[ about ]-------//

Developer : DanialMalekzadeh
Tel ID : @JanPHP

//-------[ about ]-------//

*/
set_time_limit(0);
ob_start();
error_reporting(0);
flush();
//-------[ Your Config ]-------//
$admin = "698038310";
$channel = "-1001188370083";
$token = '681497805:AAEtZ3bLias74vdxxr9j6UyUMCUzzCq05sY';
//-------[ newbot ]-------//
define('API_KEY',$token);
//-------[ function ]-------//
function Danial($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//-------[ API_REQ ]-------//
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return exec_curl_request($handle);
}
//-------[ Robot building ]-------//
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$username = $update->message->from->username;
$textmessage = isset($update->message->text)?$update->message->text:'';
$text = $message->text;
@$step = file_get_contents("data/$from_id/step.txt");
$forward = $update->message->forward_from;
//-------[ function send ]-------//
function SendMessage($ChatId, $TextMsg, $mode)
{
 Danial('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>$mode,
]);
}
//-------[ function data ]-------//
function save($filename,$TXTdata)
	{
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
//-------[ start ]-------//
if($textmessage == '/start')
{
if (!file_exists("data/$from_id/step.txt")) {
mkdir("data/$from_id");
save("data/$from_id/step.txt","none");
$myfile2 = fopen("data/users.txt", "a") or die("Unable to open file!");	
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
}
var_dump(Danial('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"سلام به ربات ارسال متن به کانال $channel خوش آمدید.",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                ['text'=>"ارسال متن"]
                ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}
//-------[ back ]-------//
if ($textmessage =="انصراف"){
save("data/$from_id/step.txt","none");
var_dump(Danial('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"به منوی اصلی برگشتیم :",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                ['text'=>"ارسال متن"]
                ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}
//-------[ send ]-------//
if ($textmessage =="ارسال متن"){
if (!file_exists("New$from_id")){
save("data/$from_id/step.txt","sendcha");
var_dump(Danial('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"خب کاربر گرامی پیام خود را ارسال کنید تا با نام شما به کانال بفرستم",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                ['text'=>"انصراف"]
                ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}else{
sendmessage($chat_id,"شما یک پیام در انتظار تایید دارید");
}
}
if ($step =="sendcha" && $textmessage !="انصراف" && $textmessage !="/start"){
save("New$from_id.txt","$textmessage");
save("News$from_id.txt","$username");
save("data/$from_id/step.txt","none");
sendmessage($chat_id,"پیامت پس از تایید شدن به کانال ارسال می شود");
sendmessage($admin,"پیام جدید از سوی $from_id با یوزر نیم $username :

$textmessage

برای تایید کردن و ارسال به کانال از دستور :
/T$from_id
برای رد کردن از دستور :
/G$from_id

استفاده نمایید.
");
}
//-------[ send cha ]-------//
if(strpos($textmessage,"/T") !== false){
$new = str_replace("/T","",$textmessage);
$pm = file_get_contents("New$new.txt");
$id = file_get_contents("News$new.txt");
sendmessage($channel,"پیام از سوی کاربران :
----------
$pm
----------
ارسال شده توسط : 
@$id
کانال ما :
 $channel");
sendmessage($admin,"حله پیام به کانال ارسال شد");
sendmessage($new,"پیام شما تایید شد و به کانال ارسال شد");
unlink("New$new.txt");
unlink("News$new.txt");
}
//-------[ rad ]-------//
if (strpos($textmessage,"/G") !== false){
$new = str_replace("/G","",$textmessage);
sendmessage($admin,"پیام رد شد با موفقیت");
sendmessage($new,"پیام شما توسط ادمین رد شد");
unlink("New$new.txt");
unlink("News$new.txt");
}
//------[ panel ]-------//
if ($textmessage =="/panel" && $chat_id == $admin){
save("data/$from_id/step.txt","none");
var_dump(Danial('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"سلام ادمین گرامی :",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                ['text'=>"آمار"],['text'=>"پیام همگانی"]
                ],
                [
                ['text'=>"انصراف"]
                ]
            	],
            	'resize_keyboard'=>true
       		])
    		]));
}
//-------[ amar ]-------//
if ($textmessage == 'آمار' && $from_id == $admin) {
        $s = scandir("data");
        $c = count($s);
        sendmessage($chat_id,"آمار کاربران:$c");
        }
//-------[ send all ]-------//
if ($textmessage == 'پیام همگانی' && $from_id == $admin) {
         save("data/$from_id/step.txt","sendd");
  sendmessage($chat_id,"پیامتون رو وارد کنید.");
  }

  if($step == 'sendd' and $from_id == $admin){
  save("data/$from_id/step.txt","none");
  SendMessage($chat_id,"پیام شما در صف ارسال قرار گرفت.");
  $all = fopen( "data/users.txt", 'r');
    while( !feof( $all)) {
       $users = fgets( $all);
         sendmessage($users,"$textmessage");
      }
    }
//-------[ end ]-------//
?>
