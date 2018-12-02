<?php /*
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
این سورس در khabar_arz@ و به وسیله khabar_arz@ نوشته شده است
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
*/
ob_start();
define('API_KEY','696846250:AAGAWlQgjtwVNQfNURS-SzC88PvL_9g2LZs'); // توکن ربات
//========= Functions ===========
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
function SendMessage($chat_id,$text,$parsmde,$reply_markup){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>$parsmde,
'reply_markup'=>$reply_markup
]);
}
function ForwardMessage($BeKoja,$AzKoja,$KodomMSG){
bot('ForwardMessage',[
'chat_id'=>$BeKoja,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}
function SendPhoto($chat_id,$photo,$caption){
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>$photo,
'caption'=>$caption
]);
}
function SendDocument($chat_id,$document,$caption){
bot('SendDocument',[
'chat_id'=>$chat_id,
'document'=>$document,
'caption'=>$caption
]);
}
function objectToArrays($object){if (!is_object($object) && !is_array($object)) {return $object;}if (is_object($object)) {$object = get_object_vars($object);}return array_map("objectToArrays", $object);}
//========== Variables ==========
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
$message = $update->message;
$message_id = $message->message_id;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$text = $message->text;
$Dev = "698038310"; //   
$botusername = "AhangBX_bot"; //  
$channel = file_get_contents("data/join channel.txt");
$ads_channel = file_get_contents("data/ads channel.txt");
$ads_message = file_get_contents("data/ads message.txt");
$dl = file_get_contents("data/$chat_id/download.txt");
$dls = file_get_contents("data/downloads.txt");
$first_name = $message->from->first_name;
$user = file_get_contents("Member.txt");
$command = file_get_contents("data/command.txt");
$step = file_get_contents("data/$chat_id/step.txt");
$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@".$channel."&user_id=".$from_id);
//========= Keyboards ==========
$dev_keyboard = json_encode([
'keyboard' => [
[['text' => "تنظیم کانال جوین اجباری"]],
[['text' => "آمار ربات"],['text' => "تبلیغات"]],
[['text' => "پیام همگانی"],['text' => "فوروارد همگانی"]],
[['text' => "بازگشت به منوی اصلی"]],
],'resize_keyboard'=>true
]);
$back_keyboard= json_encode([
'keyboard' => [
[['text' => "بازگشت به مدیریت"]],
],'resize_keyboard'=>true
]);
$keyboard = json_encode([
'keyboard' => [
[['text' => "💑 اشتراک با دوستان 💑"]],
],'resize_keyboard'=>true
]);
//========= Start Source =========
if (strpos($text,'/start') !== false or $text == "بازگشت به منوی اصلی"){
	$user = file_get_contents('Member.txt');
	$members = explode("\n", $user);
	if (!in_array($chat_id, $members)){
		mkdir("data/$chat_id");
		$fileO = fopen('Member.txt', "a");
		fwrite($fileO, "$chat_id \n");
		fclose($fileO);
		file_put_contents("data/$chat_id/download.txt","0");
		file_put_contents("data/$chat_id/step.txt","none");
	}
ForwardMessage($chat_id,"$ads_channel","$ads_message");
SendMessage($chat_id,"🌹 سلام $first_name عزیز، به ربات جستجوی موزیک خوش آمدید.

🎵 این ربات یک سرویس خودکار جستجو و دانلود موسیقی در تلگرام است.

🔍 نام خواننده و موزیک مورد نظر خود را به انگلیسی ارسال کنید تا لیست موزیک های موجود خواننده برای شما ارسال شود.

⚠️ از + بجای فاصله استفاده کن

📌 مثال موزیک : Gole+Man
📌 مثال خواننده : Reza+Pishro

🆔 @$botusername",'html',$keyboard);
}
//-------------------------------------
elseif($text == "💑 اشتراک با دوستان 💑"){
SendPhoto($chat_id,new CURLFile("data/img.png"),"🎧 جستجو و دانلود موزیک با بیش از 3 میلیون موزیك جدید و قدیمی، همراه با تکست 😍\n\n🆔 https://telegram.me/$botusername?start=$from_id");
SendMessage($chat_id,"👌 با انتشار بنر بالا در گروه ها و معرفی ربات به دوستانتان از ما و ربات حمایت کنید تا این سرویس همچنان بصورت رایگان به فعالیت خود ادامه دهد. 😊",'html',$keyboard);
}
//-------------------------------------
elseif (strpos($inch , '"status":"left"') !== false ) {
SendMessage($chat_id,"🌐 برای ادامه کار با ربات لطفا\nدر کانال رسمی ربات عضو شوید\n\n👈 با عضویت در کانال رسمی\nاز آخرین اخبار و بروز رسانی ها\nمطلع باشید.\n\n🆔 @$channel",'html',json_encode(['inline_keyboard'=>[[['text'=>"🌐 عضویت در کانال رسمی 🌐",'url'=>"https://telegram.me/$channel"]]]]));
return false;
}
//-------------------------------------
elseif(strpos($text,'/download_') !== false){
file_put_contents("data/downloads.txt",$dls +1);
file_put_contents("data/$chat_id/download.txt",$dl +1);
$text = str_replace('/download_','',$text);
$musicapi = json_decode(file_get_contents("https://apprdjvn.com/api2/mp3?id=$text"));
$mus = objectToArrays($musicapi);
$title = $mus['title'];
$link = $mus['link'];
$photo = $mus['photo'];
$plays = $mus['plays'];
$lyric = $mus['lyric'];
$like = $mus['likes'];
$dislike = $mus['dislikes'];
$downloads = $mus['downloads'];
SendPhoto("$chat_id","$photo","🎧 $title\n📯 Plays : $plays\n📥 Downloads : $downloads\n👍 $like / 👎 $dislike\n\n🆔 @$botusername");
SendDocument("$chat_id","$link","🎧 @$botusername 🎧");
SendMessage("$chat_id","$lyric","html");
}
//========== Manage ===========
elseif($text == "مدیریت" or $text == "بازگشت به مدیریت" and $chat_id == $Dev){
SendMessage($Dev,"به مدیریت ربات خوش آمدید",'html',$dev_keyboard);
file_put_contents("data/command.txt","none");
}
//-------------------------------------
elseif($text == "آمار ربات" and $chat_id == $Dev){
	$member_id = explode("\n",$user);
	$member_count = count($member_id) -1;
	SendMessage($Dev,"✅ تا کنون $member_count نفر در ربات شما عضو شده اند و تعداد $dls موزیک دانلود شده است.",'html',$dev_keyboard);
}
//-------------------------------------
elseif($text == "تنظیم کانال جوین اجباری" and $chat_id == $Dev){
	file_put_contents("data/command.txt","setchannel");
	SendMessage($Dev,"آیدی کانال را بدون @ ارسال کنید. توجه کنید که ربات در کانال مورد نظر ادمین باشد.",'html',$back_keyboard);
	}
elseif($command == "setchannel" and $chat_id == $Dev){
	file_put_contents("data/join channel.txt","$text");
		file_put_contents("data/command.txt","none");
		SendMessage($Dev,"کانال با موفقیت تنظیم شد",'html',$dev_keyboard);
	}
//-------------------------------------
elseif($text == "تبلیغات" and $chat_id == $Dev){
	file_put_contents("data/command.txt","ads1");
	SendMessage($Dev,"آیدی کانال را با @ ارسال کنید",'html',$back_keyboard);
	}
elseif($command == "ads1" and $chat_id == $Dev){
	file_put_contents("data/ads channel.txt",$text);
		file_put_contents("data/command.txt","ads2");
		SendMessage($Dev,"شماره پست را ارسال کنید",'html',$back_keyboard);
	}
elseif($command == "ads2" and $chat_id == $Dev){
	file_put_contents("data/ads message.txt","$text");
		file_put_contents("data/command.txt","none");
		SendMessage($Dev,"تبلیغات با موفقیت ثبت شد",'html',$dev_keyboard);
	}
//-------------------------------------
elseif($text == "فوروارد همگانی" and $chat_id == $Dev){
	file_put_contents("data/command.txt","fwd");
	SendMessage($Dev,"پیام را فوروارد کنید",'html',$back_keyboard);
	}
elseif($command == "fwd" and $chat_id == $Dev){
		file_put_contents("data/command.txt", "none");
		SendMessage($Dev,"پیام در صف فوروارد قرار گرفت",'html',$dev_keyboard);
		$all_member = fopen("Member.txt", "r");
		while (!feof($all_member)){
		$user = fgets($all_member);
		ForwardMessage($user,$Dev,$message_id);
	}
}
//-------------------------------------
elseif($text == "پیام همگانی" and $chat_id == $Dev){
	file_put_contents("data/command.txt","send");
	SendMessage($Dev,"پیام را ارسال کنید",'html',$back_keyboard);
	}
elseif($command == "send" and $chat_id == $Dev){
		file_put_contents("data/command.txt", "none");
		SendMessage($Dev,"پیام در صف ارسال قرار گرفت",'html',$dev_keyboard);
		$all_member = fopen("Member.txt", "r");
		while (!feof($all_member)){
		$user = fgets($all_member);
		SendMessage($user,$text);
	}
}
//========= Download ==========
elseif($text){
$musicapi = json_decode(file_get_contents("https://apprdjvn.com/api2/search?query=$text"));
$mus = objectToArrays($musicapi);
$result = '';
for($i=0;$i<20;$i++){
$a[$i] = $mus['mp3s'][$i]['title'];
$b[$i] = $mus['mp3s'][$i]['id'];
$d[$i] = $mus['mp3s'][$i]['downloads'];
if($a[$i] != ''){
$result .= "🎧 <b>$a[$i]</b>
📥 /download_$b[$i]
($d[$i] Downloads)
-----------------------------------------------";
}
}
if($a[0] != ''){
SendMessage($chat_id,"$result\n🆔 @$botusername",'Html',$keyboard);
}else{
SendMessage($chat_id,"🚫 نتیجه مورد نظر یافت نشد !!!\n⚠️ باید از حروف انگلیسی برای جستجو استفاده کنید و یا خواننده یا موزیک مورد نظر وجود ندارد.\nاز + بجای فاصله استفاده کنید.",'Html',$keyboard);
}
}
/*
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
این سورس در khabar_arz@ و به وسیله khabar_arz@ نوشته شده است
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
*/
unlink("error_log");
?>
