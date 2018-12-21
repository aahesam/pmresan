<?php
/**
 * Telegram Bot example.
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 * https://github.com/Eleirbag89/TelegramBotPHP
 * https://t.me/howCreateBot
 */
include("Telegram.php");

// Set the bot TOKEN
$bot_id = "681497805:AAEtZ3bLias74vdxxr9j6UyUMCUzzCq05sY";
// Instances the class
$telegram = new Telegram($bot_id);

// Take text and chat_id from the message
$text 			  = $telegram->Text();
$chat_id 		  = $telegram->ChatID();

$channel_name 	  = '@test_ii'; // @howCreateBot

/************ DETECT CONTENT TYPE ************/

$msgType = $telegram->getUpdateType(); // get type of files

if($msgType == 'channel_post') die();

if(empty($text) && !is_null($chat_id)){ // means sent files

	if($msgType=='photo'){
		$file_id = $telegram->bigPhotoFileID();

		file_put_contents('last_file_id.txt',$file_id); // save last file id
		file_put_contents('last_file_type.txt',$msgType); // save last file id

		$content = array('chat_id' => $chat_id, 'text' => 'تصویر دریافت شد، حالا توضیحاتتان را اضافه کنید');
		$telegram->sendMessage($content);
	}

	if($msgType=='voice'){
		$file_id = $telegram->voiceFileID();

		file_put_contents('last_file_id.txt',$file_id); // save last file id
		file_put_contents('last_file_type.txt',$msgType); // save last file id

		$content = array('chat_id' => $chat_id, 'text' => 'فایل صوتی دریافت شد، حالا توضیحاتتان را اضافه کنید');
		$telegram->sendMessage($content);
	}

	if($msgType=='audio'){
		$file_id = $telegram->audioFileID();

		file_put_contents('last_file_id.txt',$file_id); // save last file id
		file_put_contents('last_file_type.txt',$msgType); // save last file id

		$content = array('chat_id' => $chat_id, 'text' => 'فایل موسیقی دریافت شد، حالا توضیحاتتان را اضافه کنید');
		$telegram->sendMessage($content);
	}

	if($msgType=='video'){
		$file_id = $telegram->videoFileID();

		file_put_contents('last_file_id.txt',$file_id); // save last file id
		file_put_contents('last_file_type.txt',$msgType); // save last file id

		$content = array('chat_id' => $chat_id, 'text' => 'ویدئو دریافت شد، حالا توضیحاتتان را اضافه کنید');
		$telegram->sendMessage($content);
	}

	if($msgType=='document'){
		$file_id = $telegram->documentFileId();

		file_put_contents('last_file_id.txt',$file_id); // save last file id
		file_put_contents('last_file_type.txt',$msgType); // save last file id

		$content = array('chat_id' => $chat_id, 'text' => 'سند دریافت شد، حالا توضیحاتتان را اضافه کنید');
		$telegram->sendMessage($content);
	}	
}

/*********** SAVE DESCRIPTION *************/

if(!is_null($text) && !is_null($chat_id)){

	$last_file_id = file_get_contents('last_file_id.txt');
	$last_file_type = file_get_contents('last_file_type.txt');
	
	if($last_file_type=='voice' && $text != '/send'){
		
		$content = array('chat_id' => $chat_id, 'voice' => $last_file_id, 'caption' => $text, 'duration' => $duration);
		$telegram->sendVoice($content);
		
		$last_title = file_put_contents('last_title.txt', $text);
		
		$content = array('chat_id' => $chat_id, 'text' =>  'برای ارسال در کانال بر روی /send کلیک کنید.');
		$telegram->sendMessage($content);
		
	}
	
	elseif($last_file_type=='audio' && $text != '/send'){
		
		$content = array('chat_id' => $chat_id, 'audio' => $last_file_id, 'caption' => $text, 'duration' => $duration);
		$telegram->sendAudio($content);	
		
		$last_title = file_put_contents('last_title.txt', $text);
		
		$content = array('chat_id' => $chat_id, 'text' =>  'برای ارسال در کانال بر روی /send کلیک کنید.');
		$telegram->sendMessage($content);

	}
	
	elseif($last_file_type=='photo' && $text != '/send'){
		
		$content = array('chat_id' => $chat_id, 'photo' => $last_file_id, 'caption' => $text);
		$telegram->sendPhoto($content);	
		
		$last_title = file_put_contents('last_title.txt', $text);
		
		$content = array('chat_id' => $chat_id, 'text' =>  'برای ارسال در کانال بر روی /send کلیک کنید.');
		$telegram->sendMessage($content);

	}
	
	elseif($last_file_type=='video' && $text != '/send'){
		
		$content = array('chat_id' => $chat_id, 'video' => $last_file_id, 'caption' => $text);
		$telegram->sendVideo($content);	
		
		$last_title = file_put_contents('last_title.txt', $text);
		
		$content = array('chat_id' => $chat_id, 'text' =>  'برای ارسال در کانال بر روی /send کلیک کنید.');
		$telegram->sendMessage($content);

	}
	
	elseif($last_file_type=='document' && $text != '/send'){

		$content = array('chat_id' => $chat_id, 'document' => $last_file_id, 'caption' => $text);
		$telegram->sendDocument($content);	
		
		$last_title = file_put_contents('last_title.txt', $text);
		
		$content = array('chat_id' => $chat_id, 'text' =>  'برای ارسال در کانال بر روی /send کلیک کنید.');
		$telegram->sendMessage($content);

	}
	
	if($text=='/send' && !empty($last_file_type)){ // If Click on /send
		
		$last_title = file_get_contents('last_title.txt');
		$last_title .= PHP_EOL.PHP_EOL.$channel_name;
		
		if($last_file_type=='voice'){
		
			$content = array('chat_id' => $channel_name, 'voice' => $last_file_id, 'caption' => $last_title);
			$telegram->sendVoice($content);	
		
		}
		
		elseif($last_file_type=='audio'){

			$content = array('chat_id' => $channel_name, 'audio' => $last_file_id, 'caption' => $last_title);
			$telegram->sendAudio($content);	

		}
		
		elseif($last_file_type=='photo'){

			$content = array('chat_id' => $channel_name, 'photo' => $last_file_id, 'caption' => $last_title);
			$telegram->sendPhoto($content);

		}
		
		elseif($last_file_type=='video'){

			$content = array('chat_id' => $channel_name, 'video' => $last_file_id, 'caption' => $last_title);
			$telegram->sendVideo($content);

		}
		
		elseif($last_file_type=='document'){
			
			$content = array('chat_id' => $channel_name, 'document' => $last_file_id, 'caption' => $last_title);
			$telegram->sendDocument($content);	

		}
		
	}
    
}
