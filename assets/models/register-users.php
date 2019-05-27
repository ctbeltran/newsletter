<?php

$email = $_POST['usuario'];

// MailChimp API credentials
$api_key = '{apiKey de mailchimp}';
$list_id = '{audienceID de mailchimp}';

// MailChimp API URl
$member_id = md5(strtolower($email));
$data_center = substr($api_key, strpos($api_key,'-')+1);
$url = 'https://' . $data_center . '.api.mailchimp.com/3.0/list/' . $list_id .'/members' . $member_id;

// Member information
$json = json_encode([
    'email_address' => $email,
    'status' => 'subscribed',
    'update_existing' => true
]);

// Send a HTTP POST request with curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['content-type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


$resultado = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo json_encode($resultado);