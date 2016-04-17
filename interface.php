<?php

$title = utf8_decode($_REQUEST['title']);
$bpm = $_REQUEST['bpm'];

$db = new PDO("mysql:host=localhost;dbname=bpm_title;charset=UTF8", 'root', '');
$sql = 'REPLACE INTO bpm_title(title, bpm) VALUES("'.$title.'", '.$bpm.')';
$resql = $db->query($sql);
echo $sql;exit;