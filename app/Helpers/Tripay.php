<?php

function get_channel()
{
  $apiKey = 'DEV-tNwdDHaOXeacAPIP66euYNiaJcE5KSM6gr7oitUz';

  $payload = [];

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_FRESH_CONNECT  => true,
    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel?' . http_build_query($payload),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => false,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
    CURLOPT_FAILONERROR    => false,
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
  ));

  $response = json_decode(curl_exec($curl), true);
  $error = curl_error($curl);

  curl_close($curl);

  return empty($error) ? $response : $error;
}

function calc_price($code, $amount)
{
  $apiKey = 'DEV-tNwdDHaOXeacAPIP66euYNiaJcE5KSM6gr7oitUz';

  $payload = [
    'code' => $code,
    'amount' => $amount,
  ];

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_FRESH_CONNECT  => true,
    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/fee-calculator?' . http_build_query($payload),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => false,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
    CURLOPT_FAILONERROR    => false,
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
  ]);

  $response = json_decode(curl_exec($curl), true);
  $error = curl_error($curl);

  curl_close($curl);

  return empty($error) ? $response : $error;
}

function request_trx($data)
{
  $apiKey = 'DEV-tNwdDHaOXeacAPIP66euYNiaJcE5KSM6gr7oitUz';

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_FRESH_CONNECT  => true,
    CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER         => false,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
    CURLOPT_FAILONERROR    => false,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query($data),
    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
  ]);

  $response = json_decode(curl_exec($curl), true);
  $error = curl_error($curl);

  curl_close($curl);

  return empty($error) ? $response : $error;
}
