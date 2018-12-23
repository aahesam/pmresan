<?php
$API_KEY = '237966204:AAExLADwKL5KCi54dRF1nF7xLHH4dGCuewA';
$hook_url = 'https://mrfenj.xyz/hoseinpor/bot/hoseinporbot.php';
$hok="https://api.telegram.org/bot$API_KEY/setWebhook?url=$hook_url";
echo file_get_contents($hok);

?>
