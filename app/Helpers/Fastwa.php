<?php

use App\Models\WConfig;

function send_msg(int $phone_number, string $msg)
{
  $url = 'https://fastwa.io/api/whatsapp/message/send/' . WConfig::where('key', 'fastwa_instance_key')->first()->value;
  $data = [
    'phone_number' => $phone_number,
    'text_message' => $msg
  ];
  $encodedData = json_encode($data);
  $curl = curl_init($url);
  $data_string = urlencode(json_encode($data));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/json'));
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);
  $result = curl_exec($curl);
  curl_close($curl);
  return $result;
}