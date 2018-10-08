<?php

// PARAMETRI DA MODIFICARE

// Variabili iniziali.
//$WEBHOOK_URL = 'https://{APP NAME}.herokuapp.com/execute.php';
//$BOT_TOKEN = '{TOKEN}';

//uso getenv perchè la variabile $WEBHOOK_URL è stata inserita nelle config vars di heroku
$WEBHOOK_URL = getenv('URL_WEBHOOK');

//uso getenv perchè la variabile $WEBHOOK_URL è stata inserita nelle config vars di heroku
$BOT_TOKEN = getenv('TOKEN');

// NON APPORTARE MODIFICHE NEL CODICE SEGUENTE
$API_URL = 'https://api.telegram.org/bot' . $BOT_TOKEN .'/';
$method = 'setWebhook';
$parameters = array('url' => $WEBHOOK_URL);
$url = $API_URL . $method. '?' . http_build_query($parameters);
$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($handle, CURLOPT_TIMEOUT, 60);
$result = curl_exec($handle);
print_r($result);

?>
