<?php
// recupero il contenuto inviato da Telegram
$content = file_get_contents("php://input");
// converto il contenuto da JSON ad array PHP
$update = json_decode($content, true);

// se la richiesta è null interrompo lo script
if(!$update)
{
  exit;
}

// assegno alle seguenti variabili il contenuto ricevuto da Telegram
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

// pulisco il messaggio ricevuto togliendo eventuali spazi prima e dopo il testo
$text = trim($text);

// converto tutti i caratteri alfanumerici del messaggio in minuscolo
$text = strtolower($text);


// mi preparo a restitutire al chiamante la mia risposta che è un oggetto JSON
// imposto l'header della risposta
//header("Content-Type: application/json");

// per andare a capo bisogna usare  il comando \r\n
$response = '';

if(strpos($text, "/start") === 0 || $text=="ciao")
{
	$response = "Ciao $firstname, benvenuto!";
}
elseif(strpos($text, "/ver") === 0 || $text=="version")
{
	$response = "$firstname, la versione di questo bot è: v46";
}
elseif(strpos($text, "/help") === 0 || $text=="aiuto")
{
	$response = "$firstname, questo bot non salva nulla di ciò che gli viene scritto, è possibile aggiungerlo anche nei gruppi, presenta ancora qualche errore ma nei futuri aggiornamenti verranno corretti.";
} 
elseif(strpos($text, "/listmsg") === 0 || $text=="lista messaggi")
{
	$response = "$firstname, questi sono i messaggi disponibili: \r\n 
	- che si fà? \r\n 
	- che facciamo stasera \r\n 
	- barletta \r\n 
	- margherita \r\n 
	- trani \r\n 
	- chi ha la macchina? \r\n 
	- io non esco \r\n 
	- non mi va \r\n 
	- basta \r\n 
	- come stai? \r\n";
} // fine sezione /commands aggiungere altri comandi sopra questa riga, e poi usare botfather per rendere visibili le stringhe alla pressione dello /
elseif($text=="che si fà?")
{
	$response = "proposte...";
}
elseif($text=="che facciamo stasera")
{
	$response = "proposte...";
}
elseif($text=="barletta")
{
	$response = "forse...";
}
elseif($text=="margherita")
{
	$response = "forse...";
}
elseif($text=="trani")
{
	$response = "forse...";
}
elseif($text=="basta") // new
{
	$response = "io sono un robot! Smetti di scrivermi e smetterò di inviarti messaggi.";
}
elseif($text=="chi ha la macchina?")
{
	$response = "devo controllare, appena posso vi faccio sapere";
}
elseif($text=="io non esco")
{
	$response = "perchè non vuoi uscire?";
}
elseif($text=="non mi va")
{
	$response = "sei arrabiata/o";
}
elseif($text=="come stai?") // new
{
	$response = "dciavn i francios comme sie et comme sà! \r\n ";
}
elseif($text=="prova github")
{
	$response = "Sè leggi questo messaggio, allora github funziona!";
}
else
{
	$response = "Comando non valido!";
}




// mi preparo a restitutire al chiamante la mia risposta che è un oggetto JSON
// imposto l'header della risposta
header("Content-Type: application/json");

// la mia risposta è un array JSON composto da chat_id, text, method
// chat_id mi consente di rispondere allo specifico utente che ha scritto al bot
// text è il testo della risposta
$parameters = array('chat_id' => $chatId, "text" => $response);

// method è il metodo per l'invio di un messaggio (cfr. API di Telegram)
$parameters["method"] = "sendMessage";

// OPZIONALE
// imposto la inline keyboard
//$keyboard = ['inline_keyboard' => [[['text' =>  'myText', 'callback_data' => 'myCallbackText']]]];
//$parameters["reply_markup"] = json_encode($keyboard, true);

// NECESSARIO
// converto e stampo l'array JSON sulla response
echo json_encode($parameters, TRUE);



//Chiudo PHP
?>
