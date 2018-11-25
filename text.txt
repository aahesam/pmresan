<?php
/*
channel source and bot sazi : 
*/
ob_start();
define('API_KEY','753042653:AAGyXyjZe8jafagIz754mS3z66bHItNu3z4');
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function get_file_size($url) {      
    $file = $url;
 
    $ch = curl_init($file);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 
    $data = curl_exec($ch);
    curl_close($ch);
 
    if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
        
        $fileSize = (int)$matches[1];
 
        return $fileSize;
    }
}
$update = json_decode(file_get_contents('php://input'));
$inline = $update->inline_query->query;
$message = $update->message;
$chat = $update->message->chat;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->message->from->id;
$messageid = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$text = $update->message->text;
$message_id = $update->message->message_id;
$playlistcode = file_get_contents('user/'.$chatid."/playlistcode.txt");
$playlistname = file_get_contents('user/'.$chatid."/playlistname.txt");
if($text == '/start'){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"سلام 😎
به ربات جستجو گر  خوش آمدید.
✅ متن خود را ارسال کنید
◀️ ‌مثال: 
سامان

ساخته شد توسط: @boomspam",
 'parse_mode'=>"html",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[
['text'=>"دسته بندی شده 🎶️",'callback_data'=>"newing"]
],
[
['text'=>"پلی لیست من 🎵",'callback_data'=>"playing"]
],
]
])
 ]);
}
$inch = file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getChatMember?chat_id=@boomspam_channel&user_id=" . $chatid);
if (strpos($inch, '"status":"left"') == true) {
            bot('sendmessage', [
      'chat_id' => $chatid,
                'text' => "❌خطا
شما در کانال ربات عضو نیستید🚫
برای استفاده از ربات باید در کانال ربات عضو باشید✅

🆔: @boomspam
",
                'parse_mode' => "html",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [

          
[
                                                                ['text' => "✅عضویت✅", 'url' => "https://t.me/joinchat/AAAAAEsq1i6GiazcslPQ6w"]
                    ],
                    ]
                ])
            ]);
return false;
}
$inch = file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getChatMember?chat_id=@boomspam_channel&user_id=" . $chat_id);
if (strpos($inch, '"status":"left"') == true) {
            bot('sendmessage', [
      'chat_id' => $chat_id,
                'text' => "❌خطا
شما در کانال ربات عضو نیستید🚫
برای استفاده از ربات باید در کانال ربات عضو باشید✅

🆔: @boomspam
",
                'parse_mode' => "html",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [

          
[
                                                                ['text' => "✅عضویت✅", 'url' => "https://t.me/joinchat/AAAAAEsq1i6GiazcslPQ6w"]
                    ],
                    ]
                ])
            ]);
return false;
}
elseif($data == 'start'){
bot('editmessagetext',[
 'chat_id'=>$chatid,
           'message_id' => $messageid,
 'text'=>"👇👇👇👇👇👇👇👇👇👇",
 'parse_mode'=>"html",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[
['text'=>"دسته بندی شده 🎶️",'callback_data'=>"newing"]
],
[
['text'=>"پلی لیست من 🎵",'callback_data'=>"playing"]
],
]
])
 ]);
}
elseif(strpos($text,'/start ') !== false) {
  $id = str_replace("/start ","",$text);
  $idd = str_replace("/start ","",$text);
  $id = str_replace("a","1",$id);
  $id = str_replace("b","2",$id);
  $id = str_replace("c","3",$id);
  $id = str_replace("d","4",$id);
  $id = str_replace("f","5",$id);
  $id = str_replace("g","6",$id);
  $id = str_replace("h","7",$id);
  $id = str_replace("i","8",$id);
  $id = str_replace("m","9",$id);
  $id = str_replace("l","0",$id);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$artistfa = $api->result->singleinfo->artistfa;
$trackfa = $api->result->singleinfo->trackfa;
$artisten = $api->result->singleinfo->artisten;
$tracken = $api->result->singleinfo->tracken;
$likecount = $api->result->singleinfo->likecount;
$postimage = $api->result->singleinfo->postimage;
       if (strpos($playlistcode, "$id") !== false) {
$keyboard = [];
$keyboard[] = [['text'=>"❌ حذف از پلی لیست",'callback_data'=>"delplay|$id"],['text'=>"آهنگ و آلبوم های مربوط به این $posttype 📃",'callback_data'=>"relatedpost|$id"]];
 $keyboard[] = [['text'=>"کاور 📜",'callback_data'=>"kv|$id"]];
$count1 = $api->result->link_download;
$count = count($count1);
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$keyboard[] = [['text'=>"$link_title[$i]",'callback_data'=>"dlok|$id|$i"]];
}}
$keyboard[] = [['text'=>"📎 اشتراک گذاری",'switch_inline_query'=>"dl $idd"]];
bot('sendPhoto',[
 'chat_id'=>"$chat_id",
 'photo'=>"$postimage",
 'caption'=> "
🗣 $artisten
📃 $tracken
👍 $likecount",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
]);
}else{
$keyboard = [];
$keyboard[] = [['text'=>"اضافه به پلی لیست ➕",'callback_data'=>"addplay|$id"],['text'=>"آهنگ و آلبوم های مربوط به این $posttype 📃",'callback_data'=>"relatedpost|$id"]];
 $keyboard[] = [['text'=>"کاور 📜",'callback_data'=>"kv|$id"]];
$count1 = $api->result->link_download;
$count = count($count1);
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$keyboard[] = [['text'=>"$link_title[$i]",'callback_data'=>"dlok|$id|$i"]];
}}
$keyboard[] = [['text'=>"📎 اشتراک گذاری",'switch_inline_query'=>"dl $idd"]];
bot('sendPhoto',[
 'chat_id'=>"$chat_id",
 'photo'=>"$postimage",
 'caption'=> "
🗣 $artisten
📃 $tracken
👍 $likecount
",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
]);
}}
elseif($data == 'playing'){
$e = count($playlistcode);
  if($playlistcode == null){
bot('editmessagetext',[
 'chat_id'=>$chatid,
           'message_id' => $messageid,
                'text' => " پلی لیست شما خالی می باشد",
                'parse_mode' => "html",
                'reply_markup' => json_encode([
                    'inline_keyboard' =>[
[
['text'=>"بازگشت 🔙",'callback_data'=>"start"]
],
]
                ])
            ]);
}else{
  $exp = explode("\n",$playlistname);
$expp = explode("\n",$playlistcode);
 $mm = count($expp);
$keyboard = [];
for($i=0;$i<$mm;$i++){
$keyboard[] = [['text'=>"$exp[$i]",'callback_data'=>"dl|$expp[$i]"]];
}
bot('editmessagetext',[
 'chat_id'=>$chatid,
           'message_id' => $messageid,
                'text' => "👇👇👇👇👇👇👇👇👇👇",
                'parse_mode' => "html",
                'reply_markup' => json_encode([
                    'inline_keyboard' =>$keyboard,
                ])
            ]);
}}
elseif($data == 'newing'){
bot('editmessagetext',[
 'chat_id'=>$chatid,
           'message_id' => $messageid,
 'text'=>"👇👇👇👇👇👇👇👇👇👇",
                'parse_mode' => "html",
                'reply_markup' => json_encode([
                    'inline_keyboard' =>[
[['text'=>"ویژه 💡",'callback_data'=>"news|topall|+|0"]],
[['text'=>"ویژه ماه 📅",'callback_data'=>"news|topmonth|+|0"],['text'=>"ویژه هفته 🗓",'callback_data'=>"news|topweek|+|0"]],
[['text'=>"موزیک 🎵",'callback_data'=>"news|mp3|+|0"],['text'=>"آلبوم 📜",'callback_data'=>"news|album|+|0"],['text'=>"موزیک ویدیو 🎥",'callback_data'=>"news|video|+|0"]],
[['text'=>"بازگشت 🔙",'callback_data'=>"start"]],
]
                ])
            ]);
}
elseif(strpos($data,'news') !== false) {
$ex = explode("|",$data);
$type = $ex[1];
$ria = $ex[2];
$id = $ex[3];
if($ria == '+'){$id = 1+$id;}else{$id = 1-$id;}
$id = str_replace("-","",$id);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/more.php?apikey=1&type=".$type."&page=$id"));
$keyboard = [];
$keyboard[] = [['text'=>"صفحه : $id",'callback_data'=>"scanteam"]];
if($id == '1'){$keyboard[] = [['text'=>"بعدی ➡️",'callback_data'=>"news|$type|+|$id"]];}else{$keyboard[] = [['text'=>"قبلی ⬅️️",'callback_data'=>"news|$type|-|$id"],['text'=>"بعدی ➡️",'callback_data'=>"news|$type|+|$id"]];}
$count1 = $api->result;
$count = count($count1);
for($i=0;$i<$count;$i++){
$artistfa[$i] = $api->result[$i]->artistfa;
$trackfa[$i] = $api->result[$i]->trackfa;
$posttype[$i] = $api->result[$i]->posttype;
$postid[$i] = $api->result[$i]->postid;
$posttype[$i] = str_replace("mp3","آهنگ",$posttype[$i]);
$posttype[$i] = str_replace("album","آلبوم",$posttype[$i]);
$posttype[$i] = str_replace("video","موزیک ویدیو",$posttype[$i]);
if($postid[$i] != ''){
$keyboard[] = [['text'=>"دانلود $posttype[$i] $artistfa[$i] به نام $trackfa[$i]",'callback_data'=>"dl|$postid[$i]"]];
}
}
bot('editmessagetext',[
 'chat_id'=>$chatid,
           'message_id' => $messageid,
 'text'=>"👇👇👇👇👇👇👇👇👇👇",
 'parse_mode'=>"html",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
 ]);
}
elseif($text){
if($text == '/start'){
}else{
  $text = str_replace(" ","+",$text);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/search.php?apikey=1&q=$text"));

$n =  $api->result->music->subject->music->out[1]->artistfa;
if($n == ''){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"❌نتیجه ای یافت نشد
 لطفا دوباره تلاش کنید🔄",
 'parse_mode'=>"html",
 ]);
}else{
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"👇👇👇👇👇".$text."👇👇👇👇👇",
 'parse_mode'=>"html",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
[
['text'=>"موزیک 🎵",'callback_data'=>"serhok|music|$text|0|+"]
],
[
['text'=>"آلبوم 📜",'callback_data'=>"serhok|album|$text|0|+"]
],
[
['text'=>"موزیک ویدیو 🎥",'callback_data'=>"serhok|musicvideo|$text|0|+"]
],
]
])
 ]);
}}}
elseif(strpos($data,'serhok') !== false) {
$ex = explode("|",$data);
$type = $ex[1];
$text = $ex[2];
$posttype = $ex[1];
$cn = $ex[3];
$cnmee = $ex[3];
$ria = $ex[4];
if($ria == '+'){$cnme = 1+$cnmee;}else{$cnme = 1-$cnmee;}
if($ria == '+'){$cn = 1+$cn;}else{$cn = 1-$cn;}
$cn = str_replace("-","",$cn);
$cnme  = str_replace("-","",$cnme);
if($cn == '1'){$ch2 = 50; $cabolfazl = 0;}
if($cn == '2'){$ch2 = 100; $cabolfazl = 50;}
if($cn == '3'){$ch2 = 150; $cabolfazl = 100;}
if($cn == '4'){$ch2 = 200; $cabolfazl = 150;}
if($cn == '5'){$ch2 = 250; $cabolfazl = 200;}
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/search.php?apikey=1&q=$text"));
$nn =  $api->result->music->subject->$type->out[$cabolfazl]->artistfa;
if($nn == ''){
$posttype = str_replace("musicvideo","موزیک ویدیو",$posttype);
$posttype = str_replace("music","آهنگ",$posttype);
$posttype = str_replace("album","آلبوم",$posttype);
bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
 'text'=>"هیچ ".$posttype."ی یافت نشد ",
             'show_alert' => true
]);
}else{
$keyboard = [];
$keyboard[] = [['text'=>"صفحه : $cnme",'callback_data'=>"scanteam"]];
if($cn == '1'){$keyboard[] = [['text'=>"بعدی ➡️",'callback_data'=>"serhok|".$type."|".$text."|".$cnme."|+"]];}else{$keyboard[] = [['text'=>"قبلی ⬅️️",'callback_data'=>"serhok|".$type."|".$text."|".$cnme."|-"],['text'=>"بعدی ➡️",'callback_data'=>"serhok|".$type."|".$text."|".$cnme."|+"]];}
for($i=$cabolfazl;$i<$ch2;$i++){
$artistfa[$i] = $api->result->music->subject->$type->out[$i]->artistfa;
$trackfa[$i] = $api->result->music->subject->$type->out[$i]->trackfa;
$postid[$i] = $api->result->music->subject->$type->out[$i]->postid;
$posttype = str_replace("musicvideo","موزیک ویدیو",$posttype);
$posttype = str_replace("music","آهنگ",$posttype);
$posttype = str_replace("album","آلبوم",$posttype);
if($postid[$i] != ''){
$keyboard[] = [['text'=>"دانلود $posttype $artistfa[$i] به نام $trackfa[$i]",'callback_data'=>"dl|$postid[$i]"]];
}}
bot('editmessagetext',[
 'chat_id'=>$chatid,
           'message_id' => $messageid,
 'text'=>"👇👇👇👇👇👇👇👇👇👇",
 'parse_mode'=>"html",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
 ]);
}}
elseif(strpos($data,'dl|') !== false) {
  $id = str_replace("dl|","",$data);
  $idd = str_replace("dl|","",$data);
  $idd = str_replace("1","a",$idd);
  $idd = str_replace("2","b",$idd);
  $idd = str_replace("3","c",$idd);
  $idd = str_replace("4","d",$idd);
  $idd = str_replace("5","f",$idd);
  $idd = str_replace("6","g",$idd);
  $idd = str_replace("7","h",$idd);
  $idd = str_replace("8","i",$idd);
  $idd = str_replace("9","m",$idd);
  $idd = str_replace("0","l",$idd);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$artistfa = $api->result->singleinfo->artistfa;
$trackfa = $api->result->singleinfo->trackfa;
$artisten = $api->result->singleinfo->artisten;
$tracken = $api->result->singleinfo->tracken;
$likecount = $api->result->singleinfo->likecount;
$postimage = $api->result->singleinfo->postimage;
$posttype = $api->result->singleinfo->posttype;
$posttype = str_replace("video","موزیک ویدیو",$posttype);
$posttype = str_replace("mp3","آهنگ",$posttype);
$posttype = str_replace("album","آلبوم",$posttype);
       if (strpos($playlistcode, "$id") !== false) {
$keyboard = [];
$keyboard[] = [['text'=>"❌ حذف از پلی لیست",'callback_data'=>"delplay|$id"],['text'=>"آهنگ و آلبوم های مربوط به این $posttype 📃",'callback_data'=>"relatedpost|$id"]];
 $keyboard[] = [['text'=>"کاور 📜",'callback_data'=>"kv|$id"]];
$count1 = $api->result->link_download;
$count = count($count1);
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$keyboard[] = [['text'=>"$link_title[$i]",'callback_data'=>"dlok|$id|$i"]];
}}
$keyboard[] = [['text'=>"📎 اشتراک گذاری",'switch_inline_query'=>"dl $idd"]];
bot('sendPhoto',[
 'chat_id'=>"$chatid",
 'photo'=>"$postimage",
 'caption'=> "
🗣 $artisten
📃 $tracken
👍 $likecount
",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
]);
}else{
$keyboard = [];
$keyboard[] = [['text'=>"اضافه به پلی لیست ➕",'callback_data'=>"addplay|$id"],['text'=>"آهنگ و آلبوم های مربوط به این $posttype 📃",'callback_data'=>"relatedpost|$id"]];
 $keyboard[] = [['text'=>"کاور 📜",'callback_data'=>"kv|$id"]];
$count1 = $api->result->link_download;
$count = count($count1);
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$keyboard[] = [['text'=>"$link_title[$i]",'callback_data'=>"dlok|$id|$i"]];
}}
$keyboard[] = [['text'=>"📎 اشتراک گذاری",'switch_inline_query'=>"dl $idd"]];
bot('sendPhoto',[
 'chat_id'=>"$chatid",
 'photo'=>"$postimage",
 'caption'=> "
🗣 $artisten
📃 $tracken
👍 $likecount",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
]);
}}
elseif(strpos($data,'dlok|') !== false) {
$ex = explode("|",$data);
$id ="$ex[1]";
$code ="$ex[2]";
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$artistfa = $api->result->singleinfo->artistfa;
$trackfa = $api->result->singleinfo->trackfa;
$artisten = $api->result->singleinfo->artisten;
$tracken = $api->result->singleinfo->tracken;
$linktype = $api->result->link_download[$code]->link_type;
$linkurl = $api->result->link_download[$code]->link_url;
$link_title = $api->result->link_download[$code]->link_title;
$linkurll = str_replace(" ","%20",$linkurl);
$size_byte = get_file_size("$linkurll");
$size_kilobyte = $size_byte/1024;
$size_megabyte = $size_kilobyte/1024;
$size_megabyte = explode(".",$size_megabyte);
$size_megabyte = "$size_megabyte[0]";
     if($size_megabyte > 50){
bot('sendMessage',[
 'chat_id'=>$chatid,
 'text'=>"⚠️❗️ حجم فایل زیاد است و من نتوانستم آن را به شما ارسال کنم 
❇️ لینک دانلود :
$linkurll

🗣 $artisten
📃 $tracken
📥 $link_title
📦 $size_megabyte mb",
 ]);
}else{
if($linktype == 'video'){
$vi =     bot('SendVideo',[
 'chat_id'=>"$chatid",
 'video'=>"$linkurl",
 'caption'=> "
🗣 $artisten
📃 $tracken
📥 $link_title
📦 $size_megabyte mb",
]);
$e = $vi->error_code;
if($e == '400'){
bot('sendMessage',[
 'chat_id'=>$chatid,
 'text'=>"⚠️❗️ خطایی رخ داد و من نتوانستم آن را به شما ارسال کنم 
❇️ لینک دانلود :
$linkurll

🗣 $artisten
📃 $tracken
📥 $link_title
📦 $size_megabyte mb",
 ]);
}
}else{
     if($size_megabyte > 20){
bot('sendMessage',[
 'chat_id'=>$chatid,
 'text'=>"⚠️❗️ حجم فایل زیاد است و من نتوانستم آن را به شما ارسال کنم 
❇️ لینک دانلود :
$linkurll

🗣 $artisten
📃 $tracken
📥 $link_title
📦 $size_megabyte mb",
 ]);
}else{
        bot('sendDocument',[
        'chat_id'=>"$chatid",
        'document'=>"$linkurl",
'caption'=> "
🗣 $artisten
📃 $tracken
📥 $link_title
📦 $size_megabyte mb",
    ]);
}}}}
elseif(strpos($data,'relatedpost|') !== false) {
  $id = str_replace("relatedpost|","",$data);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$count1 = $api->result->relatedpost;
$count = count($count1);
$keyboard = [];
for($i=0;$i<$count;$i++){
$artistfa[$i] = $api->result->relatedpost[$i]->artistfa;
$trackfa[$i] = $api->result->relatedpost[$i]->trackfa;
$posttype[$i] = $api->result->relatedpost[$i]->posttype;
$postid[$i] = $api->result->relatedpost[$i]->postid;
$posttype[$i] = str_replace("mp3","آهنگ",$posttype[$i]);
$posttype[$i] = str_replace("album","آلبوم",$posttype[$i]);
$posttype[$i] = str_replace("video","موزیک ویدیو",$posttype[$i]);
if($postid[$i] != ''){
$keyboard[] = [['text'=>"دانلود $posttype[$i] $artistfa[$i] به نام $trackfa[$i]",'callback_data'=>"dl|$postid[$i]"]];
}}
bot('sendMessage',[
 'chat_id'=>$chatid,
 'text'=>"👇👇👇👇👇👇👇👇👇👇",
                'parse_mode' => "html",
                'reply_markup' => json_encode([
                    'inline_keyboard' =>$keyboard
                ])
            ]);
}
elseif(strpos($data,'addplay|') !== false) {
  $id = str_replace("addplay|","",$data);
  $idd = str_replace("addplay|","",$data);
  $idd = str_replace("1","a",$idd);
  $idd = str_replace("2","b",$idd);
  $idd = str_replace("3","c",$idd);
  $idd = str_replace("4","d",$idd);
  $idd = str_replace("5","f",$idd);
  $idd = str_replace("6","g",$idd);
  $idd = str_replace("7","h",$idd);
  $idd = str_replace("8","i",$idd);
  $idd = str_replace("9","m",$idd);
  $idd = str_replace("0","l",$idd);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$artistfa = $api->result->singleinfo->artistfa;
$trackfa = $api->result->singleinfo->trackfa;
$posttype = $api->result->singleinfo->posttype;
$posttype = str_replace("video","موزیک ویدیو",$posttype);
$posttype = str_replace("mp3","آهنگ",$posttype);
$posttype = str_replace("album","آلبوم",$posttype);
$title = "دانلود $posttype $artistfa به نام $trackfa";
file_put_contents("user/".$chatid."/playlistname.txt","$title\n$playlistname");
file_put_contents("user/".$chatid."/playlistcode.txt","$id\n$playlistcode");
  bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
 'text'=>"به پلی لیست اضافه شد ✔",
             'show_alert' => true
]);
$keyboard = [];
$keyboard[] = [['text'=>"❌ حذف از پلی لیست",'callback_data'=>"delplay|$id"],['text'=>"آهنگ و آلبوم های مربوط به این $posttype 📃",'callback_data'=>"relatedpost|$id"]];
 $keyboard[] = [['text'=>"کاور 📜",'callback_data'=>"kv|$id"]];
$count1 = $api->result->link_download;
$count = count($count1);
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$keyboard[] = [['text'=>"$link_title[$i]",'callback_data'=>"dlok|$id|$i"]];
}}
$keyboard[] = [['text'=>"📎 اشتراک گذاری",'switch_inline_query'=>"dl $idd"]];
  bot('editMessageReplyMarkup', [
 'chat_id'=>$chatid,
 'message_id'=>$messageid,
'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
]);
}
elseif(strpos($data,'delplay|') !== false) {
  $id = str_replace("delplay|","",$data);
  $idd = str_replace("delplay|","",$data);
  $idd = str_replace("1","a",$idd);
  $idd = str_replace("2","b",$idd);
  $idd = str_replace("3","c",$idd);
  $idd = str_replace("4","d",$idd);
  $idd = str_replace("5","f",$idd);
  $idd = str_replace("6","g",$idd);
  $idd = str_replace("7","h",$idd);
  $idd = str_replace("8","i",$idd);
  $idd = str_replace("9","m",$idd);
  $idd = str_replace("0","l",$idd);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$artistfa = $api->result->singleinfo->artistfa;
$trackfa = $api->result->singleinfo->trackfa;
$posttype = $api->result->singleinfo->posttype;
$posttype = str_replace("video","موزیک ویدیو",$posttype);
$posttype = str_replace("mp3","آهنگ",$posttype);
$posttype = str_replace("album","آلبوم",$posttype);
$title = "دانلود $posttype $artistfa به نام $trackfa";
  $playlistcodenew = str_replace("$id","",$playlistcode);
file_put_contents("user/".$chatid."/playlistcode.txt","$playlistcodenew");
  $playlistnamenew = str_replace("$title","",$playlistname);
file_put_contents("user/".$chatid."/playlistname.txt","$playlistnamenew");
  bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
 'text'=>"با موفقیت از پلی لیست پاک شد ✔",
              'show_alert' => true
]);
$keyboard = [];
$keyboard[] = [['text'=>"اضافه به پلی لیست ➕",'callback_data'=>"addplay|$id"],['text'=>"آهنگ و آلبوم های مربوط به این $posttype 📃",'callback_data'=>"relatedpost|$id"]];
 $keyboard[] = [['text'=>"کاور 📜",'callback_data'=>"kv|$id"]];
$count1 = $api->result->link_download;
$count = count($count1);
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$keyboard[] = [['text'=>"$link_title[$i]",'callback_data'=>"dlok|$id|$i"]];
}}
$keyboard[] = [['text'=>"📎 اشتراک گذاری",'switch_inline_query'=>"dl $idd"]];
  bot('editMessageReplyMarkup', [
 'chat_id'=>$chatid,
 'message_id'=>$messageid,
  'reply_markup'=>json_encode([
            'inline_keyboard'=>$keyboard
     ])
]);
}
elseif(strpos($data,'kv|') !== false) {
  $id = str_replace("kv|","",$data);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$artistfa = $api->result->singleinfo->artistfa;
$trackfa = $api->result->singleinfo->trackfa;
$artisten = $api->result->singleinfo->artisten;
$tracken = $api->result->singleinfo->tracken;
$likecount = $api->result->singleinfo->likecount;
$postimage = $api->result->singleinfo->postimage;
$count1 = $api->result->link_download;
$count = count($count1);
$ru = '';
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$ru .= "📥 $link_title[$i] 
";
}}
  $id = str_replace("1","a",$id);
  $id = str_replace("2","b",$id);
  $id = str_replace("3","c",$id);
  $id = str_replace("4","d",$id);
  $id = str_replace("5","f",$id);
  $id = str_replace("6","g",$id);
  $id = str_replace("7","h",$id);
  $id = str_replace("8","i",$id);
  $id = str_replace("9","m",$id);
  $id = str_replace("0","l",$id);
$p = "<a href='$postimage'>‌ </a>";
bot('sendMessage',[
 'chat_id'=>"$chatid",
 'text'=> "

🗣 $artisten
📃 $tracken
👍 $likecount
$p
$ru

#link_$id
https://telegram.me/nex1mcbot?start=$id",
                'parse_mode' => "html",
]);
}
$txxt = file_get_contents('Member.txt');
$pmembersid= explode("\n",$txxt);
if (!in_array($chat_id,$pmembersid)){
mkdir("user/$chat_id");
file_put_contents("user/".$chat_id."/playlistcode.txt","");
file_put_contents("user/".$chat_id."/playlistname.txt","");
 $aaddd = file_get_contents('Member.txt');
 $aaddd .= $chat_id."\n";
 file_put_contents('Member.txt',$aaddd);
}
elseif(strpos($inline,'dl ') !== false) {
  $idd = str_replace("dl ","",$inline);
if($idd == ''){
bot('answerInlineQuery', [
        'inline_query_id' => $update->inline_query->id,
            'results' => json_encode([]),
		'switch_pm_text'=>'کد آهنگ وجود ندارد.',
'switch_pm_parameter'=>'start'
        ]);
}else{
  $id = str_replace("dl ","",$inline);
  $id = str_replace("a","1",$id);
  $id = str_replace("b","2",$id);
  $id = str_replace("c","3",$id);
  $id = str_replace("d","4",$id);
  $id = str_replace("f","5",$id);
  $id = str_replace("g","6",$id);
  $id = str_replace("h","7",$id);
  $id = str_replace("i","8",$id);
  $id = str_replace("m","9",$id);
  $id = str_replace("l","0",$id);
$api =json_decode(file_get_contents("https://topapi.ir/nex1music/dlmusic.php?apikey=1&id=$id"));
$artistfa = $api->result->singleinfo->artistfa;
if($artistfa == ''){
bot('answerInlineQuery', [
        'inline_query_id' => $update->inline_query->id,
            'results' => json_encode([]),
		'switch_pm_text'=>'کد آهنگ اشتباه است.',
'switch_pm_parameter'=>'start'
        ]);
}else{
$trackfa = $api->result->singleinfo->trackfa;
$artisten = $api->result->singleinfo->artisten;
$tracken = $api->result->singleinfo->tracken;
$likecount = $api->result->singleinfo->likecount;
$postimage = $api->result->singleinfo->postimage;
$p = "<a href='$postimage'>‌ </a>";
$count1 = $api->result->link_download;
$count = count($count1);
$ru = '';
for($i=0;$i<$count;$i++){
$link_title[$i] = $api->result->link_download[$i]->link_title;
if($link_title[$i] != ''){
$ru .= "📥 $link_title[$i] 
";
}}
$inline = $up->inline_query->query;
bot('answerInlineQuery', [
        'inline_query_id' => $update->inline_query->id,
        'results' => json_encode([[
            'type' => 'photo',
            'title' => "لینک دانلود",
            'description'=>"برای ارسال لینک دانلود کلیک کنید",
            'id' => base64_encode(rand(5,555)),
            'thumb_url'=>"$postimage",
'photo_url'=>"$postimage",
 'caption'=> "
🗣 $artisten
📃 $tracken
👍 $likecount
https://telegram.me/nex1mcbot?start=$idd

ساخته شد توسط: @boomspam",
'parse_mode'=>"html",
     'reply_markup' => ['inline_keyboard' => [
[['text'=>"📥 دانلود از ربات📥️",'url'=>"https://telegram.me/nex1mcbot?start=$idd"]]
        ]]
                 ],[

           'type' => 'article',
            'id' => base64_encode(rand(5,555)),
            'thumb_url'=>"$postimage",
            'title' => "کاور",
            'description'=>"برای ارسال کاور کلیک کنید",
            'input_message_content'=>[
            'parse_mode' => 'html', 
            'message_text' => "

🗣 $artisten
📃 $tracken
👍 $likecount
$p
$ru

#link_$idd
https://telegram.me/nex1mcbot?start=$idd"],
]
])
    ]);
}}}
unlink("error_log");
?>

Gfg
￼
￼
