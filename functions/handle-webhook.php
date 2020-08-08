<?php
$body = @file_get_contents("php://input");
$signature = (isset($_SERVER['HTTP_X_PAYSTACK_SIGNATURE']) ? $_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] : '');

if (!$signature)
{
exit();
}

define('PAYSTACK_SECRET_KEY', 'sk_xxxx_xxxxxxx');

if ($signature !== hash_hmac('sha512', $body, PAYSTACK_SECRET_KEY)) {
	exit();
}

http_response_code(200);

$event = json_decode($body);
switch ($event->event) 
{
	case 'charge.success':
	
		break;
}
exit();
?>