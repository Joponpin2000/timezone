<?php

$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if (!$reference) {
	die('No reference supplied');
}

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.paystack.co/transaction/verify" . rawurlencode($reference),
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HTTPHEADER => [
		"accept : application/json",
		"authorization : Bearer sk_test_390328948y38",
		"cache-control : no-cache"
	],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
	die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if(!tranx->status)
{
	die('API returned error: ' . $tranx->message);
}

if ('success' == $tranx->data->status) {
	echo "<h2>Thank you for making a purchase. Your file has been sent to your email.</h2><a class="btn_1" href="shop.php">Continue Shopping</a>";
}

?>