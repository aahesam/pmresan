<?php
/*
کانال نیک سورس مرجع تخصصی سورس های تلگرامی
کانال ما:
t.me/Nic-Source
*/
error_reporting(0);

set_time_limit(0);

flush();


$API_KEY = 'توکن';
##------------------------------##
define('API_KEY', $API_KEY);
/*فانکشن برای هر سورسی الزامی است و ادیت کردن این بخش به هیچ وج توصیه نمیشود*/
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

function sendmessage($chat_id, $text)
{
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => "MarkDown"
    ]);
}

function deletemessage($chat_id, $message_id)
{
    bot('deletemessage', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
    ]);
}

function sendaction($chat_id, $action)
{
    bot('sendchataction', [
        'chat_id' => $chat_id,
        'action' => $action
    ]);
}

function Forward($KojaShe, $AzKoja, $KodomMSG)
{
    bot('ForwardMessage', [
        'chat_id' => $KojaShe,
        'from_chat_id' => $AzKoja,
        'message_id' => $KodomMSG
    ]);
}

 function sendvideo($chat_id, $video, $caption){
 bot('sendvideo',[
 'chat_id'=>$chat_id,
 'video'=>$video,
 'caption'=>$caption,
 ]);
 }

 function sendphoto($chat_id, $photo, $caption){
 bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
    ]);
}
function getChatstats($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatAdministrators?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->ok;
  return $result;
}
 function top_sea($number){ 
 $saveusers = array(); 
  $usersscan = scandir("databot"); 
  unset($usersscan[0]); 
  unset($usersscan[1]); 
  foreach($usersscan as $savetojs){ 
$savedis = file_get_contents("databot/$savetojs/membrs.txt"); 
$saveusers[$savetojs] = $savedis; 
  } 
  $rating = $saveusers; 
    arsort($rating,SORT_NUMERIC);  
    $rate = array();  
    foreach($rating as $key=>$value){  
      $rate[] = $key;  
    }  
    return $rate[$number];  
}  

function NewMember($file,$count){
 $exusr = explode("\n",$file);
 $c = count($exusr)-1;
$msg = "";
for($i = $c-$count;$i <= $c;$i++){
if($exusr[$i] != null){
if(is_numeric($exusr[$i])){
$msg = "$msg\n$exusr[$i]";}else{
$msg = "$msg\n$exusr[$i]";}
}
}
return $msg;
}

function objectToArrays($object)
{
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    if (is_object($object)) {
        $object = get_object_vars($object);
    }
    return array_map("objectToArrays", $object);
}
function save2($filename,$TXTdata)
  {
  $myfile = fopen($filename, "a") or die("Unable to open file!");
  fwrite($myfile, "$TXTdata");
  fclose($myfile);
  }
/*اتمام فانکشن ها*/
//====================Nic_Source======================//
/*متغییر برای سورس ها اجباری نمیباشد ولی استفاده از انها توصیه میشود و هرکسی توان ادیت این قسمت را ندارد*/
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$username = $update->message->from->username;
$from_id = $message->from->id;
$file_id=$message->photo[2]->file_id;
$mosak = file_get_contents("databot/$chat_id/membrs.txt");
$text = $message->text;
$lock = file_get_contents('lock.txt');
$mehdi = file_get_contents("databot/$chat_id/rasol.txt");
$dataa=$update->callback_query->data;
$chatidd = $update->callback_query->from->id;
$ADMIN = ادمین; 
$chatid = $update->callback_query->message->chat->id;
$databot = $update->callback_query->databot;
$message_id2 = $update->callback_query->message->message_id;
$check1 = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@Nic_Source&user_id=$from_id"))->result->status;
$check2 = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@Nic_Source&user_id=$from_id"))->result->status;
$timee = json_decode(file_get_contents("http://api-bot-telegram.cf/api/time.php?token=توکن"));
$time2 = objectToArrays($timee);
$time = $time2["FAtime"];
$date = $time2["FAdate"];
$chistan = file_get_contents("http://api-bot-telegram.cf/api/chistan.php?token=توکن");
$textmaschannel = "🔒 ربات قفل است.

⚠️ برای فعالیت در ربات لطفا در کانال های ( کانال نیک سورس , Nic_Source )  عضو شوید

کانال نیک سورس :@Nic_Source

Nic_Source :@Nic_Source

♻️ پس از عضویت لطفا روی دکمه ی ( عضو شدم🛰  ) کلیک کنید.";
///
$homebaks = json_encode(['keyboard'=>[
[['text'=>'↩️برگشت']],
],'resize_keyboard'=>true]);
$codefa = json_encode(['keyboard'=>[
[['text'=>'🚸مدیریت کانال']],
[['text'=>'✅اضافه کردن کانال'],['text'=>'📊کانال های من']],
[['text'=>'راهنما']],
],'resize_keyboard'=>true]);
$modere = json_encode([
                'keyboard' => [
                   
                    [
                        ['text' => '➰ارسال متن به کانال' ]
                    ],
                    [
                        ['text' => '🔝ارسال پست اتچ به کانال' ]
                    ],
                    [
		               	['text' => '➕افزودن ادمین🛡' ],['text' => '➖حذف ادمین']
                    ],
                    [
                        ['text' => '▪️ادمین های کانال' ]
                    ],
                    [
                        ['text' => '✖️حذف عکس کانال' ],['text' => '➰تغییر نام کانال' ]
                    ],
                    [
                        ['text' => '➰تغییر توضیحات کانال' ],['text' => '➕دریافت لینک خصوصی کانال' ]
                    ],
                    [
                        ['text' => '✖️حذف شخصی از کانال' ]
                    ],
                    [
                        ['text' => '✔️ارسال لایک به کانال♡' ]
                    ],

[
                        ['text' => '↩️برگشت' ]
                ],
],'resize_keyboard'=>true]);
//====================Nic_Source======================//
if ($text == "/start") {
        $user = file_get_contents('databot/users.txt');
        $members = explode("\n", $user);
        if (!in_array($from_id, $members)) {
        mkdir("databot/$chat_id");
            $add_user = file_get_contents('databot/users.txt');
            $add_user .= $from_id . "\n";
            file_put_contents('databot/users.txt', $add_user);
            file_put_contents("databot/$chat_id/membrs.txt","2");
        }
        file_put_contents("databot/$chat_id/rasol.txt","no");
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "سلام دوست عزیز به ربات مدیریت کانال خوش آمدید",
            'reply_markup' => $codefa
        ]);
    } elseif (strpos($text, '/start') !== false && $forward_chat_username == null) {
        $newid = str_replace("/start ", "", $text);
        if ($from_id == $newid) {
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "سلام دوست عزیز به ربات مدیریت کانال خوش آمدید",
            'reply_markup' => $codefa
        ]);
        } elseif (strpos($list, "$from_id") !== false) {
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "سلام دوست عزیز به ربات مدیریت کانال خوش آمدید",
            'reply_markup' => $codefa
        ]);
        } else {
            sendAction($chat_id, 'typing');
            @$mehdiastan = file_get_contents("databot/$newid/membrs.txt");
            $getrasolastan = $mehdiastan + 1;
            file_put_contents("databot/$newid/membrs.txt", $getrasolastan);
            $user = file_get_contents('databot/users.txt');
            $members = explode("\n", $user);
            if (!in_array($from_id, $members)) {
mkdir("databot/$chat_id");
                $add_user = file_get_contents('databot/users.txt');
                $add_user .= $from_id . "\n";
                file_put_contents('databot/users.txt', $add_user);
            file_put_contents("databot/$chat_id/membrs.txt","2");
            }
            file_put_contents("databot/$chat_id/rasol.txt","No");
 $mosak11 = file_get_contents("databot/$newid/membrs.txt");
 $getsh = 8 - $mosak11;
            SendMessage($ADMIN, "زیرمجموعه جدید
چت آیدی : [$chat_id](tg://user?id=$chat_id) 😊

توسط کاربر [$newid](tg://user?id=$newid)
واقعا به رباتت علاقه داره ادمین جون😍❤️");
            bot('sendmessage', [
                'chat_id' => $chat_id,
            'text' => "سلام دوست عزیز به ربات مدیریت کانال خوش آمدید",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $codefa
        ]);
            SendMessage($newid, "ایول 😃💥🎉🎉🎉🎉🎉
شخص : [$chat_id](tg://user?id=$chat_id)  توسط لینک شما عضو ربات شد 🎉
افرین کار تو خوب داری انجام میدی👍
1 موشک🚀 پاداش گرفتی
تعداد موشک های شما : $mosak11");
}
} elseif($databot=="join"){
$check11 = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@Nic_Source&user_id=$chatid"))->result->status;
$check22 = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@Nic_Source&user_id=$chatid"))->result->status;
if($check11 != "member" && $check11 != "creator" && $check11 != "administrator" or $check22 != "member" && $check22 != "creator" && $check22 != "administrator"){
     $chack =   bot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $message_id2,
        'text'=>"شما هنوز عضو کانال ها نشده اید!!!!!!!!!!!!!!

⚠️ برای فعالیت در ربات لطفا در کانال های ( کانال نیک سورس , Nic_Source )  عضو شوید

کانال نیک سورس :@Nic_Source

Nic_Source :@Nic_Source

♻️ پس از عضویت لطفا روی دکمه ی ( عضو شدم🛰  ) کلیک کنید.", 
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"کانال نیک سورس",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
                [ 
                    ['text'=>"Nic_Source",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
    [
  ['text'=>"عضو شدم🛰",'callback_data'=>'join']
  ]
            ] 
        ]) 
 ]); 
}else{
            bot('sendmessage', [
                'chat_id' => $chatid,
            'text' => "سلام دوست عزیز به ربات مدیریت کانال خوش آمدید",
            'reply_markup' => $codefa
        ]);
}
//////////////////////////////////////////////////////////////////////منو اصلی/////////////////////////////////////////////////////////////////////////////////
    }elseif ($text == "↩️برگشت") {
if($check1 != "member" && $check1 != "creator" && $check1 != "administrator" or $check2 != "member" && $check2 != "creator" && $check2 != "administrator"){
 bot('sendMessage',[
            'chat_id' => $chat_id,
        'text'=>"$textmaschannel", 
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"کانال نیک سورس",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
                [ 
                    ['text'=>"Nic_Source",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
    [
  ['text'=>"عضو شدم🛰",'callback_data'=>'join']
  ]
            ] 
        ]) 
 ]); 
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "لطفا مطالعه کنید",
'reply_markup'=>json_encode(['Remove_keyboard'=>[
],'remove_keyboard'=>true])]);
}else{
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","no");
 bot('sendMessage',[
            'chat_id' => $chat_id,
            'text' => "سلام دوست عزیز به ربات مدیریت کانال خوش آمدید",
            'reply_markup' => $codefa
        ]);
}
      }elseif ($text == "🚸مدیریت کانال") {
if($check1 != "member" && $check1 != "creator" && $check1 != "administrator" or $check2 != "member" && $check2 != "creator" && $check2 != "administrator"){
 bot('sendMessage',[
            'chat_id' => $chat_id,
        'text'=>"$textmaschannel", 
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"کانال نیک سورس",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
                [ 
                    ['text'=>"Nic_Source",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
		[
	['text'=>"عضو شدم🛰",'callback_data'=>'join']
	]
            ] 
        ]) 
 ]); 
         bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "لطفا مطالعه کنید",
'reply_markup'=>json_encode(['Remove_keyboard'=>[
],'remove_keyboard'=>true])]);
}else{
            sendAction($chat_id, 'typing');
            file_put_contents("databot/$chat_id/rasol.txt","ثبت کرده");
 bot('sendMessage',[
            'chat_id' => $chat_id,
            'text' => "🔻جهت مدیریت کانال لطفا ایدی کانال را ارسال کنید:
به بزرگی و کوچکی حروف دقت کنید",
         'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
}
    }elseif ($mehdi == "ثبت کرده") {
            sendAction($chat_id, 'typing');
            $channel = file_get_contents("databot/$chat_id/channel.txt");
            $channelsabt = explode("\n", $channel);
            if (!in_array($text, $channelsabt)) {
 bot('sendMessage',[
            'chat_id' => $chat_id,
            'text' => "⚠️
یا ایدی درست",
            'reply_markup' => $homebaks
        ]);
			}else{
            sendAction($chat_id, 'typing');
$admin = getChatstats(@$text,"توکن");
if($admin != true){
          bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "⚠️
یا ایدی درست",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
}else{
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt", "no");
$Wcan = json_decode(file_get_contents("http://api.wecan-co.in/info/?peer=@$text"));
$wcann = objectToArrays($Wcan);
$name = $wcann['title'];
$bio = $wcann['description'];
$member = $wcann['members'];
file_put_contents("databot/$chat_id/idfla.txt", "$text");
$memberfor = file_get_contents("databot/$chat_id/idfla.txt");
 bot('sendMessage',[
            'chat_id' => $chat_id,
            'text' => "اکانال $name را توسط کیبرد زیر مدیریت کنید

🆔ایدی کانال شما: @$text

Ⓜ️ نام کانال شما : $name

🌐 بیوگرافی کانال شما : $bio 

👤 تعداد ممبر کانال شما : $member",
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"♻️بروزرسانی",'callback_data'=>"update"] 
                ],
            ] 
        ]) 
 ]);  
 bot('sendMessage',[
            'chat_id' => $chat_id,
            'text' => "تنظیمات کانال $name
کانال $name را توسط کیبرد زیر مدیریت کنید👇🏻",
            'reply_markup' => $modere
        ]); 
	}
			}
	}elseif ($dataa == "update"){
$id = file_get_contents("databot/$chatid/idfla.txt");
$Wcan = json_decode(file_get_contents("http://api.wecan-co.in/info/?peer=@$id"));
$wcann = objectToArrays($Wcan);
$name = $wcann['title'];
$bio = $wcann['description'];
$member = $wcann['members'];
     bot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $message_id2,
        'text'=>"♻️ update %20", 
 ]); 
sleep(2);
     bot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $message_id2,
        'text'=>"♻️ update %40", 
 ]); 
sleep(2);
      bot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $message_id2,
        'text'=>"♻️ update %60", 
 ]); 
sleep(2);
      bot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $message_id2,
        'text'=>"♻️ update %80", 
 ]); 
sleep(2);
      bot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $message_id2,
                    'text' => "کانال $name را توسط کیبرد زیر مدیریت کنید

🆔ایدی کانال شما: @$text

Ⓜ️ نام کانال شما : $name

🌐 بیوگرافی کانال شما : $bio 

👤 تعداد ممبر کانال شما : $member",
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"♻️بروزرسانی",'callback_data'=>"update"] 
                ],
            ] 
        ]) 
 ]);  
 bot('sendMessage',[
            'chat_id' => $chatid,
            'text' => "تنظیمات کانال $name
کانال $name را توسط کیبرد زیر مدیریت کنید👇🏻",
            'reply_markup' => $modere
        ]); 
} elseif ($text == "✔️ارسال لایک به کانال♡") {
      file_put_contents("databot/$chat_id/rasol.txt","lickerpost");
  bot('sendmessage',[
  'chat_id'=>$chat_id,
    'text'=>"حالا متنی که میخوایی زیرش لایک بزارم رو بفرست😁",
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "lickerpost") {
$rand = rand(1,99999999);
file_put_contents("databot/like/$rand.txt","");
file_put_contents("databot/like/$rand-lick.txt","0");
$licke = file_get_contents("databot/like/$rand-lick.txt");
$id = file_get_contents("databot/$chat_id/idfla.txt");
      file_put_contents("databot/$chat_id/rasol.txt","no");
  bot('sendmessage',[
  'chat_id'=>"@".$id,
    'text'=>"$text",
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"❤️ [$licke]",'callback_data'=>"like-$rand"] 
                ],
            ] 
        ]) 
 ]); 
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "لایک شما با موفقیت در چنل قرار گرفت😘",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $modere
        ]);
    } 
if(strpos($dataa,'like-') !== false) {
$lik = str_replace("like-","",$dataa);
            $mas = file_get_contents("databot/like/$lik.txt");
if(strpos($mas,"$chatidd") !== false) { 
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "شما قبلا روی ❤️ کلیک کرده بودید😕",
            'show_alert' => false
        ]);
      }else{
$textt = $update->callback_query->message->text;
$licke = file_get_contents("databot/like/$lik-lick.txt");
$likeee = $licke + 1;
file_put_contents("databot/like/$lik-lick.txt",$likeee);
$lickeem = file_get_contents("databot/like/$lik-lick.txt");
            $mas = file_get_contents("databot/like/$lik.txt");
            $mass = explode("\n", $mas);
                $add_user = file_get_contents("databot/like/$lik.txt");
                $add_user .= $chatidd . "\n";
                file_put_contents("databot/like/$lik.txt", $add_user);
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "لایک شما با موفقیت اضافه شد😉",
            'show_alert' => false
        ]);
            bot('editmessagetext', [
                'chat_id'=>$update->callback_query->message->chat->id ,
         'message_id'=>$update->callback_query->message->message_id , 
                'text' => $textt,
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
      ['text'=>"❤️ [$lickeem]",'callback_data'=>"like-$lik"] 
                ],
            ] 
        ]) 
 ]); 
      }
				}elseif($text=="🔝ارسال پست اتچ به کانال"){
				file_put_contents("databot/$chat_id/rasol.txt","pjontoo");
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"لطفا متن خود را که میخواهید اتچ شود را ارسال نمایید🤞",
            'reply_markup' => $homebaks
        ]); 
			}elseif($mehdi=="pjontoo"){
				file_put_contents("databot/$chat_id/rasol.txt","phrto");
	        file_put_contents("databot/$chat_id/text.txt",$text);
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"خوب حالا عکس خود را بفرستید",
            'reply_markup' => $homebaks
        ]); 
				}elseif($mehdi=="phrto"){
				if(isset($message->photo)){
					file_put_contents("databot/$chat_id/rasol.txt","no");
					$url = json_decode(file_get_contents('https://api.telegram.org/botتوکن/getFile?file_id='.$file_id),true);
				$path=$url['result']['file_path'];
           $file = 'https://api.telegram.org/file/botتوکن/'.$path;
					file_put_contents("databot/$chat_id/$file_id.jpg",file_get_contents($file));
					$text=file_get_contents("databot/$chat_id/text.txt");
$id = file_get_contents("databot/$chat_id/idfla.txt");
					$kar=strlen($text);
						bot('sendmessage',[
						'chat_id'=>"@".$id,
						'text'=>''.$text.'    ‌‌‌  ‌‌<a href="https://bot-sazan-good.tk/channel/databot/'.$chat_id.'/'.$file_id.'.jpg"> ‌ </a>',
'parse_mode'=>"html",
						]);
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "با موفقیت اتچ شما در کانال قرار گرفت💀",
            'reply_markup' => $modere
        ]); 
					}else{
					bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"این یک عکس نیست لطفا عکس خود را بفرستید",
'parse_mode'=>"html",
            'reply_markup' => $homebaks
        ]); 
}
    } elseif ($text == "➕دریافت لینک خصوصی کانال") {
            sendAction($chat_id, 'typing');
$id = file_get_contents("databot/$chat_id/idfla.txt");
$getlink = file_get_contents("https://api.telegram.org/botتوکن/exportChatInviteLink?chat_id=@".$id);
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
bot('sendmessage',[
   'chat_id'=>$chat_id,
   'text'=>"لینک خصوصی چنل شما :🔮
$getlinkde",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
    } elseif ($text == "▪️ادمین های کانال") {
            sendAction($chat_id, 'typing');
$id = file_get_contents("databot/$chat_id/idfla.txt");
  $up = json_decode(file_get_contents("https://api.telegram.org/botتوکن/getChatAdministrators?chat_id=@".$id),true);
  $result = $up['result'];
  foreach($result as $key=>$value){
    $found = $result[$key]['status'];
    if($found == "creator"){
      $owner = $result[$key]['user']['id'];
	  $owner2 = $result[$key]['user']['username'];
    }
if($found == "administrator"){
if($result[$key]['user']['first_name'] == true){
$innames = str_replace(['[',']'],'',$result[$key]['user']['first_name']);
$msg = $msg."\n"."📍"."[{$innames}](tg://user?id={$result[$key]['user']['id']})";
}
  }
		 }
        bot('sendmessage', [
            'chat_id' => $chat_id,
'text'=>"سازنده کانال⚗️ : $owner
👮ادمین های فرعی کانال :
$msg",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $modere
        ]); 
    } elseif ($text == "🚀ارسال بنر شما در کانال برای کسب موشک🚀") {
            sendAction($chat_id, 'typing');
$id = file_get_contents("databot/$chat_id/idfla.txt");
 bot('sendphoto',[
 'chat_id' =>"@".$id,
 'photo'=>"link",
 'caption'=>"سلام من ربات مدیریت کانال هستم😊
با من میتونی کانالت و هر روز دنبال کنی و  با زدن فقط یک دکمه بتوانید نام کانال و... خود را تغییر دهید🙀
t.me/Management_Channel_robot/?start=$chat_id",
 ]); 
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "بنر شما برای دریافت موشک با موفقیت در کانال قرار گرفت😍",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $modere
        ]); 
    } elseif ($text == "💣پاک کردن پست های داخل کانال⚖️") {
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","ریم مسیج");
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "چه تعداد از مسیج های کانال رو میخوایی پاک کنی؟😝
عدد باید بین 1 تا 300 باشه😁",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "ریم مسیج") {
$id = file_get_contents("databot/$chat_id/idfla.txt");
if ($text <= 300 && $text >= 1){
for($i=$message_id; $i>=$message_id-$text; $i--){
bot('deletemessage',[
 'chat_id' =>"@".$id,
 'message_id' =>$i,
              ]);
}
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "پیام ها با موفقیت در حال حذف شدنن..💥",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
}else{
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "عددی که وارد کردید بین 1 تا 300 نمیباشد😕",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
}
    } elseif ($text == "🌙ارسال شب بخیر در کانال🌙") {
            sendAction($chat_id, 'typing');
$id = file_get_contents("databot/$chat_id/idfla.txt");
 bot('sendphoto',[
 'chat_id' =>"@".$id,
 'photo'=>"link",
 'caption'=>"آرامش آسمان شب⛄️
سهم قلبتان باشد❤️
و نور ستاره ها⭐️
روشنى ِ بى خاموش ِ تمام لحظه هايتان
شبتون مهتابی🌹

$time $date",
 ]);
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "متن شب بخیر در کانال شما ارسال گردید🌚",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $modere
        ]); 
    } elseif ($text == "🏁ارسال صبح بخیر در کانال🕞") {
            sendAction($chat_id, 'typing');
$id = file_get_contents("databot/$chat_id/idfla.txt");
 bot('sendphoto',[
 'chat_id' =>"@".$id,
 'photo'=>"https://bot-sazan-good.tk/channel/databot/welcome.jpg",
 'caption'=>"هر طلوعی تولدی دوباره است🌕
و هر تولدی شروعی دوباره!♻️
صبحتون بخیر🕞
لبتون خندون☺️
دلتون بی غم✌️
زندگیتون پر از عشق و امید🌷

$time $date",
 ]);
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "متن صبح بخیر در کانال شما ارسال گردید⛓",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $modere
        ]); 
//=========Nic_Source=========//
    } elseif ($text == "✖️حذف شخصی از کانال") {
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","ریمو ممبر");
 bot('sendmessage',[
     'chat_id'=>$chat_id,
     'text'=>"ایدی عددی بدبخت و بفرست😐😂",
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "ریمو ممبر") {
$id = file_get_contents("databot/$chat_id/idfla.txt");
                 $KickChatMember = bot('KickChatMember',[
        'chat_id'=>"@".$id,
        'user_id'=>$text
     ]);
				if($KickChatMember->ok =='true'){
 bot('sendmessage',[
     'chat_id'=>$chat_id,
     'text'=>"بدبخت از کانال ریمو شد😢😂",
            'reply_markup' => $modere
        ]); 
		}else{
            sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"یه خطایی رخ داد 😕
💯خطا های ممکن :
1️⃣ _ ربات دسترسی لازم را ندارد 
2️⃣ _ شخص ادمین کانال میباشد 
3️⃣ _ شخص عضو کاانل نمیباشد",
            'reply_markup' => $homebaks
        ]);
}
//=========Nic_Source=========//
    } elseif ($text == "➰تغییر توضیحات کانال") {
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","تغییر بیو کانال");
 bot('sendmessage',[
     'chat_id'=>$chat_id,
     'text'=>"متن بیو جدید رو بفرستید جایگزین قبلی کنم💟",
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "تغییر بیو کانال") {
$id = file_get_contents("databot/$chat_id/idfla.txt");
                 $setChatDescription = bot('setChatDescription',[
        'chat_id'=>"@".$id,
        'description'=>$text
     ]);
				if($setChatDescription->ok =='true'){
 bot('sendmessage',[
     'chat_id'=>$chat_id,
     'text'=>"بیو کانال شما با موفقیت تغییر کرد📸",
            'reply_markup' => $modere
        ]); 
		}else{
            sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"یه خطایی رخ داد 😕
💯خطا های ممکن :
1️⃣ _ ربات دسترسی لازم را ندارد",
            'reply_markup' => $homebaks
        ]);
}
//=========Nic_Source=========//
    } elseif ($text == "➰تغییر نام کانال") {
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","تغییر نام کانال");
 bot('sendmessage',[
     'chat_id'=>$chat_id,
     'text'=>"لطفا نام جدیدی که میخواهید بر روی کانال تان قرار دهید را وارد نمایید🎙",
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "تغییر نام کانال") {
$id = file_get_contents("databot/$chat_id/idfla.txt");
                 $setChatTitle= bot('setChatTitle',[
        'chat_id'=>"@".$id,
        'title'=>$text
     ]);
				if($setChatTitle->ok =='true'){
 bot('sendmessage',[
     'chat_id'=>$chat_id,
     'text'=>"نام کانال شما با موفقیت عضو شد⚙️",
            'reply_markup' => $modere
        ]); 
		}else{
            sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"یه خطایی رخ داد 😕
💯خطا های ممکن :
1️⃣ _ ربات دسترسی لازم را ندارد",
            'reply_markup' => $homebaks
        ]);
}
//=========Nic_Source=========//
    } elseif ($text == "✖️حذف عکس کانال") {
            sendAction($chat_id, 'typing');
$id = file_get_contents("databot/$chat_id/idfla.txt");
                 $deleteChatPhoto= bot('deleteChatPhoto',[
        'chat_id'=>"@".$id,
     ]);
				if($deleteChatPhoto->ok =='true'){
 bot('sendmessage',[
     'chat_id'=>$chat_id,
     'text'=>"عکس کانال شما با موفقیت حذف شد📍",
            'reply_markup' => $modere
        ]); 
		}else{
            sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"یه خطایی رخ داد 😕
💯خطا های ممکن :
1️⃣ _ ربات دسترسی لازم را ندارد",
            'reply_markup' => $homebaks
        ]);
}
//=========Nic_Source=========//
    } elseif ($text == "➕افزودن ادمین🛡") {
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","فوروارددد");
$id = file_get_contents("databot/$chat_id/idfla.txt");
$namefor = file_get_contents("databot/$chat_id/name_$id.txt");
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"ایدی عددی کسی که میخوایی در کانال ( $namefor ) ادمین کنی را بفرست😊
توجه داشته باشید باید ربات ادمین شده در کانال به تمامی دسترسی ها دسترسی داشته باشد‼️
شخصی که میخوایید ادمین کنید حداقل باید یک بار در این ربات استارت کرده باشد‼️",
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "فوروارددد") {
            sendAction($chat_id, 'typing');
        $user = file_get_contents('databot/users.txt');
        $members = explode("\n", $user);
        if (!in_array($text, $members)) {
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"این ایدی عددی که شما ارسال کرده اید در ربات عضو نمیباشد😕",
            'reply_markup' => $homebaks
        ]);
		}else{
if ($chat_id == $text){
            sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"چرا ایدی عددی خودتو زدی ؟😕
شما نمیتوانید از ایدی خود برای عذل و ادمین کردن استفاده نمایید😕",
            'reply_markup' => $homebaks
        ]);
}else{
            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt", "no");
$id = file_get_contents("databot/$chat_id/idfla.txt");
$namefor = file_get_contents("databot/$chat_id/name_$id.txt");
$textt = file_get_contents("databot/$chat_id/text.txt");
$c_id = $message->forward_from_chat->id;
                $promoteChatMember=bot('promoteChatMember',[
        'chat_id'=>"@".$id,
                'user_id'=>$text,
        'can_post_messages'=>true,
		'can_invite_users'=>true,
        'can_edit_messages'=>true,
        'can_delete_messages'=>true,
                ]);
        if($promoteChatMember->ok =='true'){
            sendAction($chat_id, 'typing');
bot('sendmessage',[
                'chat_id'=>$textt,
                'text'=> "یکی شما را در کانال ( $namefor ) با ایدی :  @$id ادمین کرد😁"
                ]);
bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "این شخص با موفقیت در کانال ادمین شد🙂",
            'reply_markup' => $modere
        ]); 
}else{ 
            sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"یه خطایی رخ داد 😕
💯خطا های ممکن :
1️⃣ _ ربات دسترسی لازم را ندارد",
            'reply_markup' => $homebaks
        ]);
}
		}
		}
//=========Nic_Source=========//
    } elseif ($text == "➖حذف ادمین") {
	            sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","فورواردد");
$id = file_get_contents("databot/$chat_id/idfla.txt");
$token = file_get_contents("databot/$chat_id/token_$id.txt");
$namefor = file_get_contents("databot/$chat_id/name_$id.txt");
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"ایدی عددی کسی که میخوایی در کانال ( $namefor ) عذل کنی را بفرست😊
توجه داشته باشید باید ربات ادمین شده در کانال به تمامی دسترسی ها دسترسی داشته باشد‼️
شخصی که میخوایید عذل کنید حداقل باید یک بار در این ربات استارت کرده باشد‼️",
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "فورواردد") {
sendAction($chat_id, 'typing');
        $user = file_get_contents('databot/users.txt');
        $members = explode("\n", $user);
        if (!in_array($text, $members)) {
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"این ایدی عددی که شما ارسال کرده اید در ربات عضو نمیباشد😕",
            'reply_markup' => $homebaks
        ]);
		}else{
if ($chat_id == $text){
sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"چرا ایدی عددی خودتو زدی ؟😕
شما نمیتوانید از ایدی خود برای عذل و ادمین کردن استفاده نمایید😕",
            'reply_markup' => $homebaks
        ]);
}else{
        file_put_contents("databot/$chat_id/rasol.txt", "no");
$id = file_get_contents("databot/$chat_id/idfla.txt");
$token = file_get_contents("databot/$chat_id/token_$id.txt");
$textt = file_get_contents("databot/$chat_id/text.txt");
$c_id = $message->forward_from_chat->id;
$namefor = file_get_contents("databot/$chat_id/name_$id.txt");
                $promoteChatMember=bot('promoteChatMember',[
				'chat_id'=>"@".$id,
                'user_id'=>$text,
				'can_change_info'=>false,
				'can_post_messages'=>false,
				'can_edit_messages'=>false,
				'can_delete_messages'=>false,
				'can_invite_users'=>false,
				'can_restrict_members'=>false,
				'can_pin_messages'=>false,
				'can_promote_members'=>false,	
                ]);
				if($promoteChatMember->ok =='true'){
bot('sendmessage',[
                'chat_id'=>$text,
                'text'=> "یکی شما را در کانال ( $namefor ) با ایدی :  @$id عذل کرد 😔"
                ]);
bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> "این شخص با موفقیت از کانال عذل شد🙂",
            'reply_markup' => $modere
        ]); 
}else{ 
sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"یه خطایی رخ داد 😕
💯خطا های ممکن :
1️⃣ _ ربات دسترسی لازم را ندارد
2️⃣ _ ربات ان شخص را ادمین نکرده است که بتواند عذلش کنید
3️⃣ _ این شخص در کانال ادمین نمیباشد",
            'reply_markup' => $homebaks
        ]);
}
		}
		}
//=========Nic_Source=========//
} elseif ($text == "➰ارسال متن به کانال") {
sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt","فوروارد");
$id = file_get_contents("databot/$chat_id/idfla.txt");
$token = file_get_contents("databot/$chat_id/token_$id.txt");
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"خب متنی که میخوایی داخل کانال ارسال کنم را بفرستید 🤠
راهنمای MarkDown :🤓
با گذاشتن <cd> پشت کلمه اول و گذاشتن </cd> در اخر کلمه پست شما کد میشود 🙃
مانند :  `سلام`
روش استفاده : 
<cd> سلام خوبی عزیزم  </cd>
🔳
با گذاشتن <bd> پشت کلمه اول و گذاشتن <bd/> در اخر کلمه پست شما ضخیم میشود😎
 مانند : *salam*
روش استفاده : 
<bd>hi boy</bd>
🔳🔳
با گذاشتن <il> پشت کلمه اول و گذاشتن <il/> در اخر کلمه پست شما کج میشود🤗
 مانند : _salam_
روش استفاده : 
<il>hi boy</il>
🔳🔳🔳
برای ساختن هایپر لینک اول متن خود را وارد نمایید <mt> پشت جمله تون </mt> در انتها جمله تون قرار بدید  , برای ثبت کردن لینک <lk> را پشت لینک </lk> انتها لینک قرار دهید🎃
مانند : [hi](t.me/Nic_Source)
روش استفاده :  
<mt>hi</mt><lk>link</lk>
🔳🔳🔳🔳🔳
با گذاشتن <time> در هرجا متن ساعت نمایش و با گذاشتن <date> در هرجا سورس تاریخ نمایش داده میشود😊
روش استفاده : 
time <time> and date <date>
🔳🔳🔳🔳🔳🔳
با گذاشتن <hn> در هرجا متن چیستان نمایش داده میشود🙀
روش استفاده : 
chistan :  <hn>
🔳🔳🔳🔳🔳🔳🔳
با گذاشتن <ic> در هرجا متن ایدی کانال تان با @ نمایش داده میشود⚖️
روش استفاده : 
id channel :  <ic>
🔳🔳🔳🔳🔳🔳🔳🔳",
                'parse_mode' => "MarkDown",
            'reply_markup' => $homebaks
        ]);
    } elseif ($mehdi == "فوروارد") {
        file_put_contents("databot/$chat_id/rasol.txt", "no");
$id = file_get_contents("databot/$chat_id/idfla.txt");
$token = file_get_contents("databot/$chat_id/token_$id.txt");
$textt = file_get_contents("databot/$chat_id/text.txt");
$c_id = $message->forward_from_chat->id;
$e = str_replace("<cd>","`",$text);
$e = str_replace("</cd>","`",$e);
$e = str_replace("<bd>","*",$e);
$e = str_replace("</bd>","*",$e);
$e = str_replace("<il>","_",$e);
$e = str_replace("</il>","_",$e);
$e = str_replace("<mt>","[",$e);
$e = str_replace("</mt>","]",$e);
$e = str_replace("<lk>","(",$e);
$e = str_replace("</lk>",")",$e);
$e = str_replace("<time>","$time",$e);
$e = str_replace("<date>","$date",$e);
$e = str_replace("<hn>","$chistan",$e);
$e = str_replace("<ic>","@$id",$e);
 bot('sendMessage',[

            'chat_id' => "@".$id,
            'text' => "$e",
                'parse_mode' => "MarkDown",
        ]);
sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"متن با موفقیت در چنل ارسال شد✅",
            'reply_markup' => $modere
        ]); 
//=========Nic_Source=========//
    } elseif ($text == "✅اضافه کردن کانال") {
if($check1 != "member" && $check1 != "creator" && $check1 != "administrator" or $check2 != "member" && $check2 != "creator" && $check2 != "administrator"){
 bot('sendMessage',[
            'chat_id' => $chat_id,
        'text'=>"$textmaschannel", 
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"کانال نیک سورس",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
                [ 
                    ['text'=>"Nic_Source",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
    [
  ['text'=>"عضو شدم🛰",'callback_data'=>'join']
  ]
            ] 
        ]) 
 ]); 
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "👆",
'reply_markup'=>json_encode(['Remove_keyboard'=>[
],'remove_keyboard'=>true])]);
}else{
		sendAction($chat_id, 'typing');
 $mosak11 = file_get_contents("databot/$chat_id/membrs.txt");
if ($mosak11 >= "0"){
file_put_contents("databot/$chat_id/rasol.txt","توکن");
 bot('sendMessage',[
            'chat_id' => $chat_id,
 'text'=>"لطفا ایدی کانال خود را بدون @ وارد کنید🤑
توجه : باید این ربات حتما در کانال تان ادمین باشد🤗",
            'reply_markup' => $homebaks
        ]);
}
}
} elseif ($mehdi == "توکن") {
            $channell = file_get_contents("databot/channel.txt");
            $channelsabtt = explode("\n", $channell);
            if (strpos($channell, $text)){
    sendAction($chat_id, 'typing');
 bot('sendMessage',[
            'chat_id' => $chat_id,
            'text' => "این کانال قبلا توسط شما یا یک شخص دیگر ثبت شده است😕",
            'reply_markup' => $homebaks
        ]);
      }else{
    sendAction($chat_id, 'typing');
  $url = 'https://api.telegram.org/botتوکن/getChatAdministrators?chat_id=@'.$text;
$admin = getChatstats(@$text,"توکن");
if($admin != true){
          bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "خطا‼️ یا این ایدی کانال نیست یا ربات ادمین کانال نمیباشد☹️
لطفا ربات را در کانال خود ادمین کنید😊 سپس دوباره ایدی را وارد کنید😘",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
}else{
$Wcan = json_decode(file_get_contents("http://api.wecan-co.in/info/?peer=@$text"));
$me = file_get_contents("databot/$chat_id/membrs.txt");
$get = $me - "2";
file_put_contents("databot/$chat_id/membrs.txt", "$get");
$wcann = objectToArrays($Wcan);
$name = $wcann['title'];
$bio = $wcann['description'];
$member = $wcann['members'];
file_put_contents("databot/$chat_id/name_$text.txt", "$name");
file_put_contents("databot/$chat_id/bio_$text.txt", "$bio");
file_put_contents("databot/$chat_id/member_$text.txt", "$member");
file_put_contents("databot/$chat_id/rasol.txt","no");
file_put_contents("databot/$chat_id/id_$text.txt", "$id");
            $add_user = file_get_contents("databot/$chat_id/channel.txt");
            $add_user .= $text . "\n";
            file_put_contents("databot/$chat_id/channel.txt", $add_user);
            $add_use = file_get_contents("databot/channel.txt");
            $add_use .= $text . "\n";
            file_put_contents("databot/channel.txt", $add_use);
      sendAction($chat_id, 'typing');
         bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "کانال شما در لیست تان ثبت شد☺️
میتوانید هر وقت خواستید با رفتن به قسمت 🚸مدیریت کانال اقدام به تماشا اخرین اپدیت های چنلتان کنید😊",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
}
}
//=========Nic_Source=========//
    } elseif ($text == "📊کانال های من") {
if($check1 != "member" && $check1 != "creator" && $check1 != "administrator" or $check2 != "member" && $check2 != "creator" && $check2 != "administrator"){
 bot('sendMessage',[
            'chat_id' => $chat_id,
        'text'=>"$textmaschannel", 
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"کانال نیک سورس",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
                [ 
                    ['text'=>"Nic_Source",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
    [
  ['text'=>"عضو شدم🛰",'callback_data'=>'join']
  ]
            ] 
        ]) 
 ]); 
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "👆",
'reply_markup'=>json_encode(['Remove_keyboard'=>[
],'remove_keyboard'=>true])]);
}else{
        file_put_contents("databot/$chat_id/rasol.txt", "no");
$add_user = file_get_contents("databot/$chat_id/channel.txt");
	            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅کانال های ثبت شده شما :",
				    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
		     	[['text'=>"$add_user",'callback_data'=>"ch"]],
		        [['text'=>"↩️برگشت",'callback_data'=>"back"]],
            ],
            ])
                ]);
}
//=========Nic_Source=========//
    }elseif ($text == "راهنما") {
if($check1 != "member" && $check1 != "creator" && $check1 != "administrator" or $check2 != "member" && $check2 != "creator" && $check2 != "administrator"){
 bot('sendMessage',[
            'chat_id' => $chat_id,
        'text'=>"$textmaschannel", 
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"کانال نیک سورس",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
                [ 
                    ['text'=>"Nic_Source",'url'=>"https://telegram.me/Nic_Source"] 
                ] ,
    [
  ['text'=>"عضو شدم🛰",'callback_data'=>'join']
  ]
            ] 
        ]) 
 ]); 
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "👆",
'reply_markup'=>json_encode(['Remove_keyboard'=>[
],'remove_keyboard'=>true])]);
}else{
		sendAction($chat_id, 'typing');
        file_put_contents("databot/$chat_id/rasol.txt", "no");
 $mosak = file_get_contents("databot/$chat_id/membrs.txt");
$user = file_get_contents("databot/$chat_id/user.txt");
 bot('sendphoto',[
 'chat_id' => $chat_id,
 'photo'=>"link",
 'caption'=>"سلام من ربات مدیریت کانال هستم😊
با من میتونی کانالت و هر روز دنبال کنی و  با زدن فقط یک دکمه بتوانید نام کانال و... خود را تغییر دهید🙀
t.me/NIC_SOURCE/?start=$chat_id",
 ]);
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "با پخش کردن لینک بالا و عضو شدن کسی توسط لینک شما , شما 1 موشک هدیه میگیرید 💪
موشک های شما :  $mosak 🚀",
                'parse_mode'=>'MarkDown',
            'reply_markup' => $homebaks
        ]);
}
} elseif(isset($update->inline_query)){  
bot("answerInlineQuery",[
    "inline_query_id"=>$update->inline_query->id,
    "results"=>json_encode([[
      "type"=>"article",
      "id"=>base64_encode(rand(5,555)),
      "title"=>"سازنده ربات 🤖",
      "input_message_content"=>["parse_mode"=>"html","message_text"=>"کانال نیک سورس t.me/php3"],
      "thumb_url"=>"",
     "reply_markup"=>["inline_keyboard"=>[[["text"=>"کانال نیک سورس","url"=>"http://telegram.me/nic-source"],["text"=>"Nic_Source","url"=>"http://telegram.me/Nic_Source"]],
[["text"=>"nic_source","url"=>"http://telegram.me/php3"]],
[["text"=>"نیک سورس","url"=>"http://telegram.me/php3"]],
[["text"=>"🔍اشتراک برای دیگران🚀","switch_inline_query"=>"سازنده ربات 🤖"]]]]
    ]])
  ]);
	}