<?php
define('API_KEY', '416465532:AAEgNd0SPQSqiUGus7dOOYmqJvIppH8RtNE');

function Neman($method,$datas=[]){
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

//m
$update = json_decode(file_get_contents('php://input'));
$message = $update->message; 
$chat_id = $message->chat->id;
$text = $message->text;
$message_id = $update->message->message_id;
$name = $update->message->from->first_name;
$last = $update->message->from->last_name;
$from_id = $update->message->from->id;
$username = $update->message->from->username;
//min
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$dfirst = $update->callback_query->from->first_name;
$dlast = $update->callback_query->from->last_name;
$duser = $update->callback_query->from->username;
$did = $update->callback_query->from->id;
$idc = $update->callback_query->id;
$type = $update->message->chat->type;
$admin = "128901753";
$forward = $update->message->forward_from_chat;
$forwardid = $forward->id;
$datetime = json_decode(file_get_contents("http://api.mostafa-am.ir/date-time/"));
$time = $datetime->time_fa;
$date = $datetime->date_fa;
//mta
$audio = $message->audio;
$voice = $message->voice;
$video = $message->video;
//mtaid
$stickerid = $update->message->sticker->file_id;
$videoid = $update->message->video->file_id;
$voiceid = $update->message->voice->file_id;
$fileid = $update->message->document->file_id;
$photo = $update->message->photo;
$photoid = $photo[count($photo)-1]->file_id;
$musicid = $update->message->audio->file_id;
$sticker_id = $update->message->sticker->file_id;
$video_id = $update->message->video->file_id;
$voice_id = $update->message->voice->file_id;
$file_id = $update->message->document->file_id;
$music_id = $update->message->audio->file_id;
$contactid = $update->message->contact->file_id;
$contactf = $update->message->contact->first_name;
$contactp = $update->message->contact->phone_number;
$photo2_id = $update->message->photo[2]->file_id;
$photo1_id = $update->message->photo[1]->file_id;
$photo0_id = $update->message->photo[0]->file_id;
$caption = $update->message->caption;
//z
$member = file_get_contents("Neman/member.txt");
$neman = file_get_contents("data/$chat_id/neman.txt");
$start = file_get_contents("Neman/start.txt");
$channel = file_get_contents("Neman/channel.txt");
$nam = file_get_contents("data/$chatid/nam.txt");
$tag = file_get_contents("data/$chatid/tag.txt");
$nam2 = file_get_contents("data/$chat_id/nam.txt");
$tag2 = file_get_contents("data/$chat_id/tag.txt");
$textch = file_get_contents("Neman/startchannel.txt");
$channelok = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$forwardid&user_id=369880942"));
$channelok2 = $channelok->ok;
$channeluser2 = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getchat?chat_id=".$channel));
$channeluser = $channeluser2->result->username;
//f
function save($filename,$TXTdata)
{
    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, "$TXTdata");
    fclose($myfile);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
    Neman('ForwardMessage',[
        'chat_id'=>$KojaShe,
        'from_chat_id'=>$AzKoja,
        'message_id'=>$KodomMSG
    ]);
}
function sendmessage($chat_id, $text){
 Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>"MarkDown"
 ]);
 }
function sendmessage2($chat_id, $text){
 Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>"html"
 ]);
 }
function a($idc, $text){
Neman('answercallbackquery',[
'callback_query_id'=>$idc,
'text'=>$text,
]);
}
function sendphoto($chat_id, $photo, $caption){
 Neman('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
 ]);
 }
 function sendaudio($chat_id, $audio, $caption, $title ,$performer){
 Neman('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>$audio,
 'caption'=>$caption,
 'title'=>$title,
 'performer'=>$performer
 ]);
 }
 function senddocument($chat_id, $document, $caption){
 Neman('senddocument',[
 'chat_id'=>$chat_id,
 'document'=>$document,
 'caption'=>$caption
 ]);
 }
 function sendsticker($chat_id, $sticker){
 Neman('sendsticker',[
 'chat_id'=>$chat_id,
 'sticker'=>$sticker
 ]);
 }
 function sendvideo($chat_id, $video, $caption){
 Neman('sendvideo',[
 'chat_id'=>$chat_id,
 'video'=>$video,
 'caption'=>$caption
 ]);
 }
 function sendvoice($chat_id, $voice, $caption){
 Neman('sendvoice',[
 'chat_id'=>$chat_id,
 'voice'=>$voice,
 'caption'=>$caption
 ]);
 }
 function sendaction($chat_id, $action){
 Neman('sendchataction',[
 'chat_id'=>$chat_id,
 'action'=>$action
 ]);
 }
//start
$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=".$channel."‌‌&user_id=".$from_id); 
if(strpos($inch , '"status":"left"') == true ) { 
Neman('sendMessage',[ 
        'chat_id'=>$update->message->chat->id, 
        'text'=>"$textch", 
 'parse_mode'=>'MarkDown', 
        'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [ 
                    ['text'=>"✅ورود به کانال",'url'=>"https://telegram.me/$channeluser"] 
                ] 
            ] 
        ]) 
    ]); 
}
elseif(preg_match('/^\/([Ss]tart)/',$text)){
if($username != null){
$neman2 = file_get_contents("Neman/start.txt");
$neman2 = str_replace("FIRSTNAME", $name, $neman2);
$neman2 = str_replace("LASTNAME", $last, $neman2);
$neman2 = str_replace("USERNAME","@$username", $neman2);
$neman2 = str_replace("USERNAMEN", $username, $neman2);
$neman2 = str_replace("DATE", $date, $neman2);
$neman2 = str_replace("TIME", $time, $neman2);
$neman2 = str_replace("USERID", $from_id, $neman2);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"$neman2",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"💎تبدیل گر",'callback_data'=>"t"]
              ],
              [
              ['text'=>"⛏ویرایش موسیقی",'callback_data'=>"vi"]
              ]
              ]
        ])
 ]);
}else{
$neman2 = file_get_contents("Neman/start.txt");
$neman2 = str_replace("FIRSTNAME", $name, $neman2);
$neman2 = str_replace("LASTNAME", $last, $neman2);
$neman2 = str_replace("USERNAME","❌یافت نشد", $neman2);
$neman2 = str_replace("DATE", $date, $neman2);
$neman2 = str_replace("TIME", $time, $neman2);
$neman2 = str_replace("USERID", $from_id, $neman2);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"$neman2",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"💎تبدیل گر",'callback_data'=>"t"]
              ],
              [
              ['text'=>"⛏ویرایش موسیقی",'callback_data'=>"vi"]
              ]
              ]
        ])
 ]);
}
}
elseif($data == "back3"){
save("data/$chatid/neman.txt","none");
a($idc, "☢به پنل برگشتید");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"♈️به پنل برگشتید",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"📊وضعیت",'callback_data'=>"v"]
              ],
              [
              ['text'=>"📮پیام همگانی",'callback_data'=>"p"],['text'=>"📯فروارد همگانی",'callback_data'=>"f"]
              ],
              [
              ['text'=>"⚛تنظیم پیام شروع",'callback_data'=>"start"],['text'=>"⏰تنظیم پیام قفل",'callback_data'=>"sgh"]
              ],
              [
              ['text'=>"☢تنظیم قفل کانال",'callback_data'=>"gh"]
              ]
              ]
        ])
 ]);
}
elseif($data == "back"){
if($duser != null){
$neman2 = file_get_contents("Neman/start.txt");
$neman2 = str_replace("FIRSTNAME", $dfirst, $neman2);
$neman2 = str_replace("LASTNAME", $dlast, $neman2);
$neman2 = str_replace("USERNAME","@$duser", $neman2);
$neman2 = str_replace("USERNAMEN", $duser, $neman2);
$neman2 = str_replace("DATE", $date, $neman2);
$neman2 = str_replace("TIME", $time, $neman2);
$neman2 = str_replace("USERID", $did, $neman2);
save("data/$chatid/neman.txt","none");
a($idc, "🃏به منو برگشتید🃏");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"$neman2",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"💎تبدیل گر",'callback_data'=>"t"]
              ],
              [
              ['text'=>"⛏ویرایش موسیقی",'callback_data'=>"vi"]
              ]
              ]
        ])
 ]);
}else{
$neman2 = file_get_contents("Neman/start.txt");
$neman2 = str_replace("FIRSTNAME", $dfirst, $neman2);
$neman2 = str_replace("LASTNAME", $dlast, $neman2);
$neman2 = str_replace("USERNAME","❌یافت نشد", $neman2);
$neman2 = str_replace("DATE", $date, $neman2);
$neman2 = str_replace("TIME", $time, $neman2);
$neman2 = str_replace("USERID", $did, $neman2);
save("data/$chatid/neman.txt","none");
a($idc, "🃏به منو برگشتید🃏");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"$neman2",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"💎تبدیل گر",'callback_data'=>"t"]
              ],
              [
              ['text'=>"⛏ویرایش موسیقی",'callback_data'=>"vi"]
              ]
              ]
        ])
 ]);
}
}
elseif($data == "back2"){
save("data/$chatid/neman.txt","none");
a($idc, "🃏به منو برگشتید🃏");
Neman('sendmessage',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"🔶به بخش تبدیل گر موسیقی خوش امدید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"🔊تبدیل موسیقی به صدا",'callback_data'=>"tm"],['text'=>"🎥تبدیل فیلم به گیف",'callback_data'=>"fg"]
              ],
              [
              ['text'=>"🔊تبدیل صدا به موسیقی",'callback_data'=>"mt"],['text'=>"🎙تبدیل فیلم به صدا",'callback_data'=>"fc"]
              ],
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
Neman('deletemessage',[
 'chat_id'=>$chatid,
 'message_id'=>$messageid+1,
]);
}
elseif($data == "t"){
a($idc, "🔔کمی صبر کنید...");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"🔶به بخش تبدیل گر موسیقی خوش امدید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"🔊تبدیل موسیقی به صدا",'callback_data'=>"tm"],['text'=>"🎥تبدیل فیلم به گیف",'callback_data'=>"fg"]
              ],
              [
              ['text'=>"🔊تبدیل صدا به موسیقی",'callback_data'=>"mt"],['text'=>"🎙تبدیل فیلم به صدا",'callback_data'=>"fc"]
              ],
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($data == "back4"){
save("data/$chatid/neman.txt","none");
a($idc, "✅انجام شد.");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"💸به بخش ویرایش موسیقی خوش امدید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"1⃣تنظیم نام",'callback_data'=>"t1"]
              ],
              [
              ['text'=>"2⃣تنظیم تگ",'callback_data'=>"t2"]
              ],
              [
              ['text'=>"3⃣تبدیل",'callback_data'=>"t3"]
              ],
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($data == "back5"){
save("data/$chatid/neman.txt","none");
a($idc, "✅انجام شد.");
Neman('sendmessage',[
 'chat_id'=>$chatid,
 'text'=>"💸به بخش ویرایش موسیقی خوش امدید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"1⃣تنظیم نام",'callback_data'=>"t1"]
              ],
              [
              ['text'=>"2⃣تنظیم تگ",'callback_data'=>"t2"]
              ],
              [
              ['text'=>"3⃣تبدیل",'callback_data'=>"t3"]
              ],
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
Neman('deletemessage',[
 'chat_id'=>$chatid,
 'message_id'=>$messageid+1,
]);
}
elseif($data == "vi"){
a($idc, "🔔کمی صبر کنید...");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"💸به بخش ویرایش موسیقی خوش امدید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"1⃣تنظیم نام",'callback_data'=>"t1"]
              ],
              [
              ['text'=>"2⃣تنظیم تگ",'callback_data'=>"t2"]
              ],
              [
              ['text'=>"3⃣تبدیل",'callback_data'=>"t3"]
              ],
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($data == "t1"){
save("data/$chatid/neman.txt","t1");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"☢نام جدید را ارسال کنید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"❌لغو",'callback_data'=>"back4"]
              ]
              ]
        ])
 ]);
}
elseif($data == "t2"){
save("data/$chatid/neman.txt","t2");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"♒️تگ جدید را ارسال کنید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"❌لغو",'callback_data'=>"back4"]
              ]
              ]
        ])
 ]);
}
elseif($data == "t3"){
if($nam != ""){
if($tag != ""){
save("data/$chatid/neman.txt","t3");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"💮آهنگ را ارسال کنید.\n🈶یا میتوانید صدا ارسال کنید ت به اهنگ تبدیل شود.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"❌لغو",'callback_data'=>"back4"]
              ]
              ]
        ])
 ]);
}else{
Neman('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"⚠️بخش تگ کامل نیست",
'show_alert'=>true
]);
}
}else{
Neman('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"⚠️بخش نام کامل نیست",
'show_alert'=>true
]);
}
}elseif($neman == "t1"){
save("data/$from_id/nam.txt", $text);
save("data/$chat_id/neman.txt","none");
Neman('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅نام جدید ثبت شد.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"1⃣تنظیم نام",'callback_data'=>"t1"]
              ],
              [
              ['text'=>"2⃣تنظیم تگ",'callback_data'=>"t2"]
              ],
              [
              ['text'=>"3⃣تبدیل",'callback_data'=>"t3"]
              ],
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}elseif($neman == "t2"){
save("data/$from_id/tag.txt", $text);
save("data/$from_id/neman.txt","none");
Neman('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅تگ اهنگ با موفقیت ثبت شد.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"1⃣تنظیم نام",'callback_data'=>"t1"]
              ],
              [
              ['text'=>"2⃣تنظیم تگ",'callback_data'=>"t2"]
              ],
              [
              ['text'=>"3⃣تبدیل",'callback_data'=>"t3"]
              ],
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($neman == "t3"){
if($audio == null){
if($voice == null){
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️لطفا فقط موسیقی یا صدا ارسال کنید.",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
}else{
$file = $voice->file_id;
      $get = Neman('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents("data/$from_id/File.mp3",file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));
Neman('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>new CURLFile("data/$chat_id/File.mp3"),
 'title'=>$nam2,
 'performer'=>$tag2,
 'caption'=>"🔘 غمــــــــــلي موسیـــــــقے🔘

🆔 @xamlyi",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♠️برگشت",'callback_data'=>"back5"]
              ]
              ]
        ])
 ]);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔶برای ویرایش دوباره، اهنگ یا صدای بعدی را ارسال کنید.",
 'reply_to_message_id'=>$message->message_id+1,
 'parse_mode'=>"MarkDown",
]);
}
}else{
$file = $audio->file_id;
      $get = Neman('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents("data/$chat_id/File.mp3",file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));
Neman('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>new CURLFile("data/$chat_id/File.mp3"),
 'title'=>$nam2,
 'performer'=>$tag2,
 'caption'=>"🔘 غمــــــــــلي موسیـــــــقے🔘

🆔 @xamlyi",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♠️برگشت",'callback_data'=>"back5"]
              ]
              ]
        ])
 ]);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔶برای ویرایش دوباره، اهنگ یا صدای بعدی را ارسال کنید.",
 'reply_to_message_id'=>$message->message_id+1,
 'parse_mode'=>"MarkDown",
]);
}
}
elseif($data == "fg"){
save("data/$chatid/neman.txt","fg");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"📽فیلم خود را ارسال کنید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($data == "fc"){
save("data/$chatid/neman.txt","fc");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"📹فیلم خود را ارسال کنید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($data == "tm"){
save("data/$chatid/neman.txt","tbmc");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"🔔موسیقی خود را ارسال کنید🔔",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($data == "mt"){
save("data/$chatid/neman.txt","tbvo");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"🔔صدای خود را ارسال کنید🔔",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back"]
              ]
              ]
        ])
 ]);
}
elseif($neman == "fg"){
if($video != null){
$file = $video->file_id;
      $get = Neman('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents("data/$chat_id/File.gif",file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));
Neman('senddocument',[
 'chat_id'=>$chat_id,
 'document'=>new CURLFile("data/$chat_id/File.gif"),
 'caption'=>"🔘 غمــــــــــلي موسیـــــــقے🔘

🆔 @xamlyi",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♠️برگشت",'callback_data'=>"back2"]
              ]
              ]
        ])
 ]);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"😁برای ادامه، فیلم بعدی را ارسال کنید.",
 'reply_to_message_id'=>$message->message_id+1,
 'parse_mode'=>"MarkDown",
 ]);
 }else{
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"❌فقط فیلم ارسال کنید.",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
}
}
elseif($neman == "fc"){
if($video != null){
$file = $video->file_id;
      $get = Neman('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents("data/$chat_id/File.ogg",file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));
Neman('sendvoice',[
 'chat_id'=>$chat_id,
 'voice'=>new CURLFile("data/$chat_id/File.ogg"),
 'caption'=>"🔘 غمــــــــــلي موسیـــــــقے🔘

🆔 @xamlyi",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♠️برگشت",'callback_data'=>"back2"]
              ]
              ]
        ])
 ]);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"😁برای ادامه، صدای بعدی را ارسال کنید.",
 'reply_to_message_id'=>$message->message_id+1,
 'parse_mode'=>"MarkDown",
 ]);
 }else{
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"❌فقط فیلم ارسال کنید.",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
}
}
elseif($neman == "tbmc"){
if($audio != null){
$file = $audio->file_id;
      $get = Neman('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents("data/$chat_id/voice.ogg",file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));
Neman('sendvoice',[
 'chat_id'=>$chat_id,
 'voice'=>new CURLFile("data/$chat_id/voice.ogg"),
 'caption'=>"🔘 غمــــــــــلي موسیـــــــقے🔘

🆔 @xamlyi",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♠️برگشت",'callback_data'=>"back2"]
              ]
              ]
        ])
 ]);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"😁برای ادامه، اهنگ بعدی را ارسال کنید.",
 'reply_to_message_id'=>$message->message_id+1,
 'parse_mode'=>"MarkDown",
]);
}else{
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"⛔️لطفا فقط اهنگ ارسال کنید.",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
}
}
elseif($neman == "tbvo"){
if($voice != null){
$file = $voice->file_id;
      $get = Neman('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents("data/$chat_id/audio.mp3",file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));
Neman('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>new CURLFile("data/$chat_id/audio.mp3"),
 'caption'=>"🔘 غمــــــــــلي موسیـــــــقے🔘

🆔 @xamlyi",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♠️برگشت",'callback_data'=>"back2"]
              ]
              ]
        ])
 ]);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"😁برای ادامه، ویس بعدی را ارسال کنید.",
 'reply_to_message_id'=>$message->message_id+1,
 'parse_mode'=>"MarkDown",
]);
}else{
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"⛔️لطفا فقط ویس ارسال کنید.",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
}
}
//panel
elseif($text == "نعمان" && $from_id == $admin){
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"😁سلام ادمین عزیز\n😍به پنل خودتون خوش اومدید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"📊وضعیت",'callback_data'=>"v"]
              ],
              [
              ['text'=>"📮پیام همگانی",'callback_data'=>"p"],['text'=>"📯فروارد همگانی",'callback_data'=>"f"]
              ],
              [
              ['text'=>"⚛تنظیم پیام شروع",'callback_data'=>"start"],['text'=>"⏰تنظیم پیام قفل",'callback_data'=>"sgh"]
              ],
              [
              ['text'=>"☢تنظیم قفل کانال",'callback_data'=>"gh"]
              ]
              ]
        ])
]);
}
elseif($data == "v"){
$neman = file_get_contents('Neman/member.txt');
$member_id = explode("\n",$neman);
$member = count($member_id) -1;
Neman('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"📮آمار اعضا : $member
♋️تعداد صدا های تبدیل شده :
📇تعداد موسیقی های تبدیل شده :
✴️تعداد موسیقی های ادیت شده :",
'show_alert'=>true
]);
}
elseif($data == "start"){
save("data/$chatid/neman.txt","start");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"🎙متن جدید شروع را ارسال کنید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back3"]
              ]
              ]
        ])
 ]);
}
elseif($neman == "start"){
save("data/$chat_id/neman.txt","none");
save("Neman/start.txt", $text);
Neman('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅پیام شروع ثبت شد.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"📊وضعیت",'callback_data'=>"v"]
              ],
              [
              ['text'=>"📮پیام همگانی",'callback_data'=>"p"],['text'=>"📯فروارد همگانی",'callback_data'=>"f"]
              ],
              [
              ['text'=>"⚛تنظیم پیام شروع",'callback_data'=>"start"],['text'=>"⏰تنظیم پیام قفل",'callback_data'=>"sgh"]
              ],
              [
              ['text'=>"☢تنظیم قفل کانال",'callback_data'=>"gh"]
              ]
              ]
        ])
]);
}
elseif($data == "sgh"){
save("data/$chatid/neman.txt","startchannel");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"🎙متن جدید شروع را ارسال کنید.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back3"]
              ]
              ]
        ])
 ]);
}
elseif($neman == "startchannel"){
save("data/$chat_id/neman.txt","none");
save("Neman/startchannel.txt", $text);
Neman('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅پیام قفل کانال ثبت شد.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"📊وضعیت",'callback_data'=>"v"]
              ],
              [
              ['text'=>"📮پیام همگانی",'callback_data'=>"p"],['text'=>"📯فروارد همگانی",'callback_data'=>"f"]
              ],
              [
              ['text'=>"⚛تنظیم پیام شروع",'callback_data'=>"start"],['text'=>"⏰تنظیم پیام قفل",'callback_data'=>"sgh"]
              ],
              [
              ['text'=>"☢تنظیم قفل کانال",'callback_data'=>"gh"]
              ]
              ]
        ])
]);
}
elseif($data == "gh"){
save("data/$chatid/neman.txt","gh");
Neman('editMessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$messageid,
 'text'=>"😁یه پست از کانالی که میخواهید قفل شود ارسال کنید😁",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back3"]
              ]
              ]
        ])
 ]);
}
elseif($neman == "gh"){
if($forward != null){
if($channelok2 == "true"){
save("data/$chat_id/neman.txt","none");
save("Neman/channel.txt", $forwardid);
Neman('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"✅قفل کانال فعال شد",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"📊وضعیت",'callback_data'=>"v"]
              ],
              [
              ['text'=>"📮پیام همگانی",'callback_data'=>"p"],['text'=>"📯فروارد همگانی",'callback_data'=>"f"]
              ],
              [
              ['text'=>"⚛تنظیم پیام شروع",'callback_data'=>"start"],['text'=>"⏰تنظیم پیام قفل",'callback_data'=>"sgh"]
              ],
              [
              ['text'=>"☢تنظیم قفل کانال",'callback_data'=>"gh"]
              ]
              ]
        ])
]);
}else{
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"⚠️ربات در کانال ادمین نیست⚠️",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
}
}else{
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"❌لطفا فقط یک پست از کانال خودتان ارسال کنید.",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
}
}
elseif($data == "f"){
save("data/$chatid/neman.txt","for");
Neman('editmessagetext',[
 'chat_id'=>$chatid,
 'message_id'=>$messageid,
 'text'=>"💾پیام خود را ارسال کنید تا به تمام اعضا فروارد شود.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back3"]
              ]
              ]
        ])
]);
}
elseif($neman == "for"){
save("data/$from_id/neman.txt","none"); 
$forp = fopen( "Neman/member.txt", 'r'); 
while( !feof( $forp)) { 
$fakar = fgets( $forp); 
Forward($fakar, $chat_id,$message_id); 
  } 
$neman = file_get_contents('Neman/member.txt');
$member_id = explode("\n",$neman);
$member = count($member_id) -1;
   Neman('sendMessage',[ 
   'chat_id'=>$chat_id, 
   'text'=>"📚پیام شما به تمام اعضا ($member) فروارد شد.", 
   'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"📊وضعیت",'callback_data'=>"v"]
              ],
              [
              ['text'=>"📮پیام همگانی",'callback_data'=>"p"],['text'=>"📯فروارد همگانی",'callback_data'=>"f"]
              ],
              [
              ['text'=>"⚛تنظیم پیام شروع",'callback_data'=>"start"],['text'=>"⏰تنظیم پیام قفل",'callback_data'=>"sgh"]
              ],
              [
              ['text'=>"☢تنظیم قفل کانال",'callback_data'=>"gh"]
              ]
              ]
        ])
   ]); 
}
elseif($data == "p"){
save("data/$chatid/neman.txt","pay");
Neman('editmessagetext',[
 'chat_id'=>$chatid,
 'message_id'=>$messageid,
 'text'=>"🗄پیام خود را ارسال کنید، تا به همه ی اعضا ارسال شود.",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"♣️برگشت",'callback_data'=>"back3"]
              ]
              ]
        ])
]);
}
elseif($neman == "pay"){
save("data/$from_id/neman.txt","none");
$all_member = fopen("Neman/member.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
if($sticker_id != null){
SendSticker($user,$sticker_id);
}
elseif($video_id != null){
SendVideo($user,$video_id,$caption);
}
elseif($voice_id != null){
SendVoice($user,$voice_id,$caption);
}
elseif($file_id != null){
SendDocument($user,$file_id,$caption);
}
elseif($music_id != null){
SendAudio($user,$music_id,$caption);
}
elseif($photo2_id != null){
SendPhoto($user,$photo2_id,$caption);
}
elseif($photo1_id != null){
SendPhoto($user,$photo1_id,$caption);
}
elseif($photo0_id != null){
SendPhoto($user,$photo0_id,$caption);
}
elseif($text != null){
SendMessage2($user,$text);
}
}
$neman = file_get_contents('Neman/member.txt');
$member_id = explode("\n",$neman);
$member = count($member_id) -1;
   Neman('sendMessage',[ 
   'chat_id'=>$chat_id, 
   'text'=>"😅پیام شما به تمام اعضا ($member) ارسال شد.", 
   'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"📊وضعیت",'callback_data'=>"v"]
              ],
              [
              ['text'=>"📮پیام همگانی",'callback_data'=>"p"],['text'=>"📯فروارد همگانی",'callback_data'=>"f"]
              ],
              [
              ['text'=>"⚛تنظیم پیام شروع",'callback_data'=>"start"],['text'=>"⏰تنظیم پیام قفل",'callback_data'=>"sgh"]
              ],
              [
              ['text'=>"☢تنظیم قفل کانال",'callback_data'=>"gh"]
              ]
              ]
        ])
   ]); 
}
else{
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"😁لطفا فقط از دکمه ها استفاده کنید.",
 'reply_to_message_id'=>$message->message_id,
 'parse_mode'=>"MarkDown",
]);
Neman('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"😁اینم از دکمه ها",
 'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"💎تبدیل گر",'callback_data'=>"t"]
              ],
              [
              ['text'=>"⛏ویرایش موسیقی",'callback_data'=>"vi"]
              ]
              ]
        ])
 ]);
}
//end
  if ($type == "private") {
  if (strpos($member , "$chat_id") == false){
 $txxt = file_get_contents('Neman/member.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($chat_id,$pmembersid)){
      $aaddd = file_get_contents('Neman/member.txt');
      $aaddd .= $chat_id."\n";
  file_put_contents('Neman/member.txt',$aaddd);
mkdir("data/$chat_id");
    }
 }
}
?>