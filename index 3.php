<?php

include 'Class.php';

// Variable Source
$update = json_decode(file_get_contents('php://input'));
$from_id = $update->message->from->id;
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$forward = $update->message->forward_from->id;
$first = $update->message->from->first_name;
$username = $update->message->from->username;
$inline = $update->inline_query;
$inline_text = $update->inline_query->query;
$first_inline = $update->inline_query->from->first_name;
$command = file_get_contents("user/".$from_id."/command.txt");
$code = file_get_contents("user/".$from_id."/code.txt");
$channel = "@test_ii";
$group_id = '-1001188370083';
$botname = "https://t.me/wateri_bot";
$ptext  = "سورس رایگان ربات تلگرام";
$sticker = $update->message->sticker->file_id;
$video = $update->message->video->file_id;
$voice = $update->message->voice->file_id;
$file = $update->message->document->file_id;
$photo2 = $update->message->photo[2]->file_id;
$photo1 = $update->message->photo[1]->file_id;
$photo0 = $update->message->photo[0]->file_id;
$music = $update->message->audio->file_id;
$text = $update->message->text;
$caption = $update->message->caption;
$url_pattern = '/(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w]([-\d\w]{0,253}[\d\w])?\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.,\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.,\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.,\/\d\w]|%[a-fA-f\d]{2,2})*)?$/'; 	
	//======================== تمیز کردن از ای دی
	if ( preg_match("/@[\w\-]+/", $text))
{$pattern = '/@[\w\-]+/';
$replacement = '';
$text= preg_replace($pattern, $replacement, $text);}
if ( preg_match("/@[\w\-]+/", $caption))
{$pattern = '/@[\w\-]+/';
$replacement = '';
$caption= preg_replace($pattern, $replacement, $caption);}
//======================== تمیز کردن از لینک
if (preg_match($url_pattern, $caption)) {
$replacement='';    
$caption = preg_replace($url_pattern, $replacement, $caption);}
if (preg_match($url_pattern, $text)) {
$replacement='';    
$text = preg_replace($url_pattern, $replacement, $text);}
//======================== تمیز کردن از لینک
	
	//========================
	if(preg_match('/^\/([Ss]tart)/',$text) and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessage($chat_id,"سلام ادمین عزیز خوش اومدی از این به بعد میتونی پیام هارو برای من فوروارد کنی تا من بدون منبع توی کانال قرار بدم:(","html","true");
	}
	elseif($sticker != null  and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendSticker($channel,$sticker);

	}
	elseif($video != null  and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendVideo($channel,$video,"$caption\n$channel\n$botname");
	}
	elseif($voice != null  and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendVoice($channel,$voice,'',"$caption\n$channel\n$botname");
	}
	elseif($file != null  and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendDocument($channel,$file,'',"$caption\n$channel\n$botname");
	}
	elseif($music != null  and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendAudio($channel,$music,'',"$caption\n$channel\n$botname");
	}
	elseif($text != null  and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendMessage($channel,"$text\n$ptext\n$channel\n $botname ","html","true");
  SendMessage($group_id,"$text\n$ptext\n$channel\n $botname\n-------------------------\n این پیام توسط $username عزیز  به کانال ارسال گردید","html","true");
}
	elseif($photo2 != null and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendPhoto($channel,$photo2,'',"$caption\n$channel\n$botname");
	}
	elseif($photo1 != null and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendPhoto($channel,$photo1,'',"$caption\n$channel\n$botname");
	}
	elseif($photo0 != null and $from_id == $admin || $from_id == $admin1 || $from_id == $admin2){
	SendChatAction($chat_id,"typing");
	SendMessageadmin($chat_id,"ارسال شد.","html","true");
	SendPhoto($channel,$photo0,'',"$caption\n$channel\n$botname");
	}
	

	?>
