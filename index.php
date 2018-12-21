<?php 
/*
Anti spam channel 
-------------------
v : 1
-------------------
on the PHP txt source 
-------------------
our channel : https://t.me/source_search
@source_search
-------------------
by : @MrLTE 

*/
ob_start();
$API_KEY = '795641758:AAEQL3FZovKgc0kzLnoFAfyrZt8g6ACfgNs'; // توکن ربات
$admin= "698038310"; // آیدی عددی ادمین
##------------------------------##
define('API_KEY',$API_KEY);
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
function deletefolder($path) { 
     if ($handle=opendir($path)) { 
       while (false!==($file=readdir($handle))) { 
         if ($file<>"." AND $file<>"..") { 
           if (is_file($path.'/'.$file))  { 
             @unlink($path.'/'.$file); 
             } 
           if (is_dir($path.'/'.$file)) { 
             deletefolder($path.'/'.$file); 
             @rmdir($path.'/'.$file); 
            } 
          } 
        } 
      } 
 }

 //----------------@MrLTE------------------//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$reply = $update->message->reply_to_message;
$chatid=$update->callback_query->message->chat->id;
$messageid=$update->callback_query->message->message_id;
$data=$update->callback_query->data;
 //----------------@MrLTE------------------//
$channel_id=$update->channel_post->chat->id;
$author_signature=$update->channel_post->author_signature;
$text_channel=$update->channel_post->text;
$channel_message_id=$update->channel_post->message_id;
$data=$update->callback_query->data;
 if(!is_dir('flood/'.$channel_id)){mkdir('flood/'.$channel_id);}
  if(!is_dir('floods')){mkdir('floods');}
$maxflood = file_get_contents("floods/$channel_id.txt");
if($text=='/start' and $chat_id==$admin){
	            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"سلام ادمین گرامی به ربات خودتون خوش آمدید
				لطفا دکمه مورد نظر را انتخاب کنید",
				    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
		     	[['text'=>"🎀راهنما",'callback_data'=>"help"]],
                [['text'=>"Ⓜ️مدیریت",'callback_data'=>"modiriat"]]
            ],
            ])
                ]);
}
if($data=='modiriat'){
	        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "نویسنده ɪʀαɴɪαɴ</>м

کانال

@hos138",
            'show_alert' => true
        ]);
}
if($data=='help'){
	bot('editmessagetext',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"تنظیمات مدیریتی
	تنظیم اسپم 
	/setflood عدد 1 -10
	مثال : 
	/setflood 5
	 ➖➖➖➖➖➖➖➖➖➖➖➖
	 ادمین کردن 
	 /promote آیدی عددی طرف
	 مثال : 
	 /promote 198153003
	 جهت پیدا کردن ایدی ععدی شخص یک پیام شخص را به ربات زیر فوروارد کنید
	 @userinfobot
کانال سازنده ربات     @source_search
	",
					    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
		     	[['text'=>"🔚برگشت",'callback_data'=>"back"]],
            ],
            ])
    ]);
}
if($data=='back'){
	bot('editmessagetext',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
                'text'=>"سلام ادمین گرامی به ربات خودتون خوش آمدید
				لطفا دکمه مورد نظر را انتخاب کنید",
				    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
		     	[['text'=>"🎀راهنما",'callback_data'=>"help"]],
                [['text'=>"Ⓜ️مدیریت",'callback_data'=>"modiriat"]]
            ],
            ])
                ]);
}
if(preg_match('/^[\#\!\/]?(setflood|تنظیم فلود) (.*)$/si',$text_channel,$match)){
	                bot('deletemessage',[
                'chat_id'=>$channel_id,
                'message_id'=>$channel_message_id
                ]);
      if(is_numeric($match[2]) && $match[2] < 10 && $match[2] > 0){
              $data=file_get_contents('https://api.telegram.org/bot'.$API_KEY.'/getChatAdministrators?chat_id='.$channel_id);
    $data = json_decode($data,true);
      foreach($data['result'] as $user){
      if($user['user']['first_name'] == $author_signature){
      $id = $user['user']['id'];}}
            if(!is_dir('flood')){mkdir('flood');}
            if(!is_dir('flood/'.$channel_id)){mkdir('flood/'.$channel_id);}
            $answer = '✅ میزان ارسال پیام در هر دقیقه به '.$match[2].' پیام تغییر یافت .'.PHP_EOL.'از این پس اگر کاربری '.$match[2].' پیام در دقیقه در گروه ارسال کند تحریم میشود .';
            file_put_contents("floods/$channel_id.txt",$match[2]);
            bot('sendmessage',[
                'chat_id'=>$id,
                'text'=>$answer
                ]);
      }else{
            $answer = '❌ فرمت انتخابی برای تعیین میزان اسپم در گروه اشتباه است .'.PHP_EOL.'لطفا یک عدد لاتین و بین 1 تا 10 انتخاب کنید .';
                bot('sendmessage',[
                'chat_id'=>$id,
                'text'=>$answer
                ]);
            
      }
}
if(preg_match('/^[\#\!\/]?(promote|ادمین) (.*)$/si',$text_channel,$match)){
					  bot('deletemessage',[
                'chat_id'=>$channel_id,
                'message_id'=>$channel_message_id
                ]);
      if(is_numeric($match[2])){
                $promoteChatMember=bot('promoteChatMember',[
				'chat_id'=>$channel_id,
                'user_id'=>$match[2],
				'can_post_messages'=>true,
				'can_edit_messages'=>true,
				'can_delete_messages'=>true,
				'can_invite_users'=>true,
                ]);
				if($promoteChatMember->ok =='true'){
				bot('sendmessage',[
                'chat_id'=>$admin,
                'text'=>"کاربر [$match[2]](tg://user?id=$match[2]) با موفقیت ادمین کانال شد",
				'parse_mode'=>markdown
                ]);
				 }else{  
	                bot('sendmessage',[
                'chat_id'=>$admin,
                              'text'=>"در هنگام ادمین کردن[$match[2]](tg://user?id=$match[2]) خطایی   رخ داد 
👇خطای مورد نظر: \n".json_encode($promoteChatMember),

				'parse_mode'=>markdown
                ]);
      }
	  }else{
                bot('sendmessage',[
                'chat_id'=>$admin,
                'text'=>'لطفا فقط آیدی عددی ارسال کنید'
                ]);
            
      }
}
if(isset($update->channel_post)){
    if(file_exists("floods/$channel_id.txt")){
    $data=file_get_contents('https://api.telegram.org/bot'.$API_KEY.'/getChatAdministrators?chat_id='.$channel_id);
    $data = json_decode($data,true);
      foreach($data['result'] as $user){
      if($user['user']['first_name'] == $author_signature){
      $id = $user['user']['id'];}}
      $flood=file_get_contents("flood/$channel_id/$id.txt");
            if($maxflood -1 == $flood){
            file_put_contents("flood/$channel_id/$id.txt",$flood +1);
            $answer = 'کاربر گرامی '.$author_signature.PHP_EOL.'شما در هر دقیقه میتوانید فقط '.$maxflood.' پیام ارسال کنید ، درصورت ادامه دادن تحریم میشوید .';
            
                bot('sendmessage',[
                'chat_id'=>$id,
                'text'=>$answer
                ]);
      }else{
      if($flood >= $maxflood){
          unlink("flood/$channel_id/$id.txt");
                $promoteChatMember=bot('promoteChatMember',[
				'chat_id'=>$channel_id,
                'user_id'=>$id,
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
                'chat_id'=>$id,
                'text'=> 'کاربر '.$author_signature.PHP_EOL.' بدلیل اسپم کردن از ارسال پیام محدودی شدید
جهت رفع محدودیت با ادمین های کانال در ارتباط باشید'
                ]);
              bot('sendmessage',[
                'chat_id'=>$admin,
                'text'=>"ادمین گرامی
				کاربر [$author_signature](tg://user?id=$id) به دلیل اسپم کردن در کانال محدود شد",
				'parse_mode'=>markdown
                ]);
				
      }else{  
	                bot('sendmessage',[
                'chat_id'=>$admin,
                'text'=>"ادمین گرامی
				کاربر [$author_signature](tg://user?id=$id) در حال اسپم کردن کانال است
				اما من دسترسی کافی برای محدود کردن او را ندارم لطفا سریع ببرسی کنید",
				'parse_mode'=>markdown
                ]);
	  }
	  }else{
          file_put_contents("flood/$channel_id/$id.txt",$flood +1);
      }
}
}
}

?>
