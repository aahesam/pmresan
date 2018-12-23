<?php
$API_KEY = '777113449:AAHrhhC6-NLYovqkPXWO72lCi0ZnhbKdxVo';
$hook_url = 'https://aaahesam.000webhostapp.com/watermark/set.php';
$hok="https://api.telegram.org/bot$API_KEY/setWebhook?url=$hook_url";
echo file_get_contents($hok);

?>
