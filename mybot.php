<?php
/**
 * Telegram Bot example.
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 * https://github.com/Eleirbag89/TelegramBotPHP
 * https://t.me/howCreateBot
 */
include("Telegram.php");

// Set the bot TOKEN
date_default_timezone_set("Asia/Tehran");

$bot_id = "795641758:AAEQL3FZovKgc0kzLnoFAfyrZt8g6ACfgNs";
// Instances the class
$telegram = new Telegram($bot_id);

// Take text and chat_id from the message
$text 			  = $telegram->Text();
$chat_id 		  = $telegram->ChatID();

$type = $telegram->getUpdateType();

if($type=='location'){
	
	$latitude = $telegram->Latitude();
	$longitude = $telegram->Longitude();
	
	$content = ['text' => '<b>Latitude:</b> '.$latitude, 'parse_mode' => 'HTML','chat_id' => $chat_id];
	$telegram->sendMessage($content);
	
	$content = ['text' => '<b>Longtitude:</b> '.$longitude, 'parse_mode' => 'HTML','chat_id' => $chat_id];
	$telegram->sendMessage($content);
}

if($type=='contact'){
	
	$phone = $telegram->getContactPhoneNumber();
	$name = $telegram->getContactFirstName();
	
	$content = ['text' => '<b>Phone Number:</b> '.$phone, 'parse_mode' => 'HTML','chat_id' => $chat_id];
	$telegram->sendMessage($content);
	
	$content = ['text' => '<b>Contact Name:</b> '.$name, 'parse_mode' => 'HTML','chat_id' => $chat_id];
	$telegram->sendMessage($content);
}
