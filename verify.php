<?php

$access_token = 'iyx7Z0eGYPRFjBG6XHnHbnHLO4fPjAU8pFgi9ykz/HMqZJbn0zoErtfnV28qNYTf+LQYbkD96uoLfeUcum22n9zo08Y37eFnJnlEI2HxnR/+ocXxJvtsJRGhrxz8LOOqrV9tXx0TiRaAm2LPmRslzQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>