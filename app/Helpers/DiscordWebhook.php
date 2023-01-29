<?php

use App\Models\WConfig;

/**
 * Type tersedia : otp-webhook, kas-payment, kas-cashout, custom.
 * Custom required $customUrl
 *
 * @var array $content = [["name" => "title", "value" => "content", "inline" => false], ...];
 */
function send_dc_webhook($type, $content, $img = null, $customUrl = null)
{
  if ($type == 'otp-webhook') {
    $webhookurl = WConfig::where('key', 'discord_webhook_otp')->first()->value;
    $title = "OTP Nih";
  } else if ($type == 'kas-payment') {
    $webhookurl = WConfig::where('key', 'discord_webhook_kas_payment')->first()->value;
    $title = "Uhuyy Kas Dapat Pemasukan";
  } else if ($type == 'kas-cashout') {
    $webhookurl = WConfig::where('key', 'discord_webhook_kas_cashout')->first()->value;
    $title = "Penarikan Kas";
  } else if ($type == 'custom') {
    $webhookurl = $customUrl;
    $title = "Custom";
  }

  //=======================================================================================================
  // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
  //========================================================================================================

  $timestamp = date("c", strtotime("now"));

  $json_data = json_encode([
    // Message
    // "content" => "Hello World! This is message line ;) And here is the mention, use userID <@12341234123412341>",

    // Username
    // "username" => "krasin.space",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
      [
        // Embed Title
        "title" => $title,

        // Embed Type
        "type" => "rich",

        // Embed Description
        "description" => "Aplikasi berjalan pada environment : " . WConfig::where('key', 'app_env')->first()->value,

        // URL of title link
        "url" => "https://kas.marimas.xyz/kas",

        // Timestamp of embed must be formatted as ISO8601
        "timestamp" => $timestamp,

        // Embed left border color in HEX
        "color" => hexdec("560a8c"),

        // Footer
        // "footer" => [
        //   "text" => "GitHub.com/Mo45",
        //   "icon_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=375"
        // ],

        // Image to send
        "image" => [
          "url" => (is_null($img)) ? '' : $img
        ],

        // Thumbnail
        //"thumbnail" => [
        //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
        //],

        // Author
        "author" => [
          "name" => "Kas MariMas",
          "url" => "https://kas.marimas.xyz/"
        ],

        // Additional Fields array
        "fields" => $content
      ]
    ]

  ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


  $ch = curl_init($webhookurl);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $output = json_decode(curl_exec($ch), true);
  curl_close($ch);
  return $output;
}