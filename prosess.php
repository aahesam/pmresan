
<?php

require("img.class.php");
function pma($pic,$chat_id,$cap,$bot_id)
{
	 $array1=array('chat_id'=>$chat_id);
	 $text.=" $cap";
		$myphoto=$pic;
		$array2=array('photo'=>$myphoto); 
		$ch = curl_init();      

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot$bot_id/sendPhoto?caption=$text");
		curl_custom_postfields($ch,$array1,$array2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

		$output=curl_exec($ch);
		print_r( $output);
		curl_close($ch);

}	
function curl_custom_postfields($ch, array $assoc = array(), array $files = array()) {

          // invalid characters for "name" and "filename"
          static $disallow = array("\0", "\"", "\r", "\n");

          // build normal parameters
          foreach ($assoc as $k => $v) {
              $k = str_replace($disallow, "_", $k);
              $body[] = implode("\r\n", array(
                  "Content-Disposition: form-data; name=\"{$k}\"",
                  "",
                  filter_var($v),
              ));
          }

          // build file parameters
          foreach ($files as $k => $v) {
            
              $data = file_get_contents($v);
              $v = call_user_func("end", explode(DIRECTORY_SEPARATOR, $v));
              $k = str_replace($disallow, "_", $k);
              $v = str_replace($disallow, "_", $v);
              $body[] = implode("\r\n", array(
                  "Content-Disposition: form-data; name=\"{$k}\"; filename=\"{$v}\"",
                  "Content-Type: image/jpeg",
                  "",
                  $data,
              ));
          }

          // generate safe boundary
          do {
              $boundary = "---------------------" . md5(mt_rand() . microtime());
          } while (preg_grep("/{$boundary}/", $body));

          // add boundary for each parameters
          array_walk($body, function (&$part) use ($boundary) {
              $part = "--{$boundary}\r\n{$part}";
          });

          // add final boundary
          $body[] = "--{$boundary}--";
          $body[] = "";

          // set options
          return @curl_setopt_array($ch, array(
              CURLOPT_POST       => true,
              CURLOPT_POSTFIELDS => implode("\r\n", $body),
              CURLOPT_HTTPHEADER => array(
                  "Expect: 100-continue",
                  "Content-Type: multipart/form-data; boundary={$boundary}", // change Content-Type
              ),
          ));
      }


function processMessage($message,$API_KEY) {
  // process incoming message
  $message_id = $message['message_id'];

  $chat_id = $message['chat']['id'];
 
if (isset($message['photo'])) {
    // incoming photo message
    $text = $message['caption'];
    $photo = $message['photo'];
    // pmphoto($text,$photo,$chat_id,$API_KEY);
 $photo= $message['photo'];
	  foreach($photo as $pic)
		$pict = $pic['file_id'];
	$getfile='https://api.telegram.org/bot'.$API_KEY.'/getFile?file_id='.$pict;
	$getfile=file_get_contents($getfile);
	$file=json_decode($getfile, true);
	$picurl='https://api.telegram.org/file/bot'.$API_KEY.'/'.$file['result']['file_path'];
	$img = new img;
//variabili settabili (valori segnati default)
$img->name = $pict; //nome immagine senza estensione, di default preso nome originale
$img->thumb_w = 172; // larghezza thumb in px
$img->thumb_h = 130; // altezza thumb in px
$img->max_w = 720; // larghezza max in px
$img->max_h = 540; // altezza max in px
$img->pos_x = "RIGHT"; // posizione logo -> RIGHT, LEFT, CENTER
$img->pos_y = "BOTTOM"; // posizione logo -> BOTTOM, TOP, MIDDLE
$img->img_folder = ""; // cartella immagine grande (default-> cartella dell'immagine originale)
$img->thumb_folder = ""; // cartella immagine thumb (default-> cartella dell'immagine originale)
$img->saveBIG = 1; //salvare immagine grande 1 o 0
$img->saveTHUMB = 0; //salvare thumb -> 1 o 0
$img->AddLogo($picurl, "logo.png");
$newpic=$pict.'_big.jpg';
$cap="mrfenj";
	 pma($newpic,$chat_id,$cap,$API_KEY);
}else{
	 $text = 'saalaaaaaam only pic';
	$post = 'https://api.telegram.org/bot'.$API_KEY.'/sendMessage';
				$matn = urlencode($text);
				
	$post.="?text=$matn&caption=@mrfenj&chat_id=$chat_id";
	echo file_get_contents($post);
}

}
$content = file_get_contents("php://input");
$update = json_decode($content, true);

$bot_id="237966204:AAExLADwKL5KCi54dRF1nF7xLHH4dGCuewA";
if (isset($update["message"])) {
	
  processMessage($update["message"],$bot_id);
}


?>

