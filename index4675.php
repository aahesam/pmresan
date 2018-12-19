<?php
ob_start();
$API_KEY = 'توکن ربات شما';
##------------------------------##
define('API_KEY', $API_KEY);
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

function sendphoto($chat_id, $photo, $action)
{
    bot('sendphoto', [
        'chat_id' => $chat_id,
        'photo' => $photo,
        'action' => $action
    ]);
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


//====================ᵗᶦᵏᵃᵖᵖ======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$channel_post = $update->message->channel_post;
$chid = $update->channel_post->message->message_id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$c_id = $message->forward_from_chat->id;
$forward_id = $update->message->forward_from->id;
$forward_chat = $update->message->forward_from_chat;
$forward_chat_username = $update->message->forward_from_chat->username;
$forward_chat_msg_id = $update->message->forward_from_message_id;
$text = $message->text;
@mkdir("data/$chat_id");
$ADMIN = 185610082;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id2 = $update->callback_query->message->message_id;
$fromm_id = $update->inline_query->from->id;
$fromm_user = $update->inline_query->from->username;
$inline_query = $update->inline_query;
$query_id = $inline_query->id;
//====================شروع نوشتن سورس طبق متغیر ها و فانکشن های تعریف شده======================//

?>