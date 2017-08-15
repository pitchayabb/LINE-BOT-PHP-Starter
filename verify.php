<?php
$access_token = 'rQy/kEpoG83KSi4thyZWyJXLHehNr1N23BStJ2BkJzWBWgvYIkhFfCXYQ9swg4KqfRcDQ6zsVUn328rdLUvWT35NPBUGru6c0QdXG7BPkP2+82nZPwZq/XVY26j19OnZFJQPH2YrYLLra83icEQ8LAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;