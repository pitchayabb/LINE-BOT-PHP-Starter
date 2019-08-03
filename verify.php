<?php
$access_token = 'BGEDnXo2/byCnxhloFeXxhj1YZtKq43WdyFnaIgC9rLXr4aX7QxTQHnrfRDChhQzQruUv0YXHa3eHQce5Dro1b6DsDeOzI5jN5+lEaAjeXF3kDVwr/PVbhDeqO+DkmJ7BDO6zGA+3pE31GHOpE9cjgdB04t89/1O/w1cDnyilFU=';

// $url = 'https://api.line.me/v1/oauth/verify';

$url = 'https://api.line.me/oauth2/v2.1/verify';

// GET https://api.line.me/oauth2/v2.1/verify

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;