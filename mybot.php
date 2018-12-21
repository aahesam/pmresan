<?php
/**
 * Telegram Bot example.
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 * https://github.com/Eleirbag89/TelegramBotPHP
 */
include("Telegram.php");

// Set the bot TOKEN
$bot_id = "751222329:AAFtXgIeRwPNZCh1plOec1dv5ULeb0pwXoQ";

// Instances the class
$telegram = new Telegram($bot_id);

/* If you need to manually take some parameters
*  $result = $telegram->getData();
*  $text = $result["message"] ["text"];
*  $chat_id = $result["message"] ["chat"]["id"];
*/

// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

$result = $telegram->getData();
//$channel_post = $result["channel_post"];

// Take text and chat_id from the message
$text 			   = $telegram->Text();
$chat_id 		   = $telegram->ChatID();
$user_id		   = $telegram->UserID();

$up_type = $telegram->getUpdateType(); // data type

$photo_file_id = $telegram->bigPhotoFileID(); // largest Photo file_id

if($up_type=='photo'){
	
	$content = array('chat_id' => $chat_id, 'text' => 'Please Wait...');
	$telegram->sendMessage($content);
	
	if(!empty($photo_file_id)){
		
		// Retireve File Direct Path
		$file_id = $photo_file_id;
		$file = $telegram->getFile($file_id);
		$file_path = $file['result']['file_path'];
		$full_path ='https://api.telegram.org/file/bot'.$bot_id.'/'.$file_path;

		// Change FileName
		$file_name = 'image_'.mt_rand(1,1000).'.jpg';
		file_put_contents('tmp_img/'.$file_name,file_get_contents($full_path));

		$new_file = logoWatermark($file_name);
		$new_full_path = 'https://aaahesam.000webhostapp.com/watermarkbot/tmp_img/'.$new_file;

		$content = array('chat_id' => $chat_id, 'photo' => $new_full_path, 'caption' => $text);
		$telegram->sendPhoto($content);	
		
	}	
}else{
	$content = array('chat_id' => $chat_id, 'text' => 'Please Send a photo...');
	$telegram->sendMessage($content);
}	


function logoWatermark($file_name){
	
	$dest = 'tmp_img/';
	
	// open an image file
	$img = Image::make($dest.$file_name);

	// and insert a watermark for example
	$img->insert($dest.'logo.png','bottom-left', 10, 10);

	// finally we save the image as a new file
	$new_name = 'wm_'.mt_rand(1,1000).'.jpg';
	$img->save($dest.$new_name);
	unlink($dest.$file_name); // delete tmp image
	return $new_name;
}
