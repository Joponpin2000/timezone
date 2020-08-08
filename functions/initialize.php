<?php
$curl = curl_init();

$email = $_GET['email'];
$amount = $_GET['amount'];

$callback_url = 'timezone.com/functions/callback.php';

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode([
		'amount' => $amount,
		'email' =>$email,
		'callback_url' => $callback_url
	]),
	CURLOPT_HTTPHEADER => [
	"authorization : Bearer sk_test_xxxxxxxxxxxxxxxxxxxxxx",
	"content-type : application/json",
	"cache-control : no-cache"
	],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
	die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!tranx['status'])
{
	print_r('API returned error: ' . $tranx['message']);
}

//print_r($tranx)

header('Location: ' . $tranx['data']['authorization_url']);
?>