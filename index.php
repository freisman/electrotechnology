<?php

$botToken = "424159475:AAFr3p2dKKniIC_oxH0nE9EXeoHgYRgm5Z4";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$lastname = $update["message"]["from"]["last_name"];

switch($message)
{
	case "/id":
		funcionid($chatId);
		break;
	case "/soporte":
		funcionsoporte($chatId);
		break;	
	default:
		menuprincipal($chatId);
		break;
}

function enviarmensaje($chatId,$mensaje)
{
	
	$url = "$GLOBALS[website]/sendmessage?chat_id=$chatId&parse_mode=HTML&text=$mensaje";
	file_get_contents($url);
}

function funcionid($chatId)
{
	$mensaje="Tu <b>Chat_ID</b> es:%0A<b>".$chatId."</b>";
	enviarmensaje($chatId,$mensaje);
}

function funcionsoporte($chatId)
{
	$mensaje = "Si requieres soporte tecnico mandanos un mensaje a:%0Asac@electrotechnologycr.com o tels: +506 4000-3280 o Cel: +506 8632-4444, +506 8628-5656";
	enviarmensaje($chatId,$mensaje);
}

function noentiendo($chatId)
{
	$mensaje = "No te entiendo, puedes repetirlo?";
	enviarmensaje($chatId,$mensaje);
}

function menuprincipal($chatId)
{
	$message = "Hola, soy <b>Electrotechnology Bot</b> y te puedo indicar tu /id%0ALo necesitas para que te pueda enviar alertas.%0ASi requieres asistencia solicita /soporte";
	$tecladoprincipal = '&reply_markup={"keyboard":[["ID"],["Soporte"]],"resize_keyboard":true}';
	$url = $GLOBALS[website].'/sendmessage?chat_id='.$chatId.'&parse_mode=HTML&text='.$message;
	file_get_contents($url);
}

?>