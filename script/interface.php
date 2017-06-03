<?php

$title = utf8_decode($_REQUEST['title']);
$bpm = $_REQUEST['bpm'];
$color = $_REQUEST['color'];

$db = new PDO("mysql:host=localhost;dbname=bpm_title;charset=UTF8", 'root', '');
$sql = 'REPLACE INTO bpm_title(title, bpm, color) VALUES("'.utf8_encode($title).'", '.(empty($bpm) ? 0 : $bpm).', "'.$color.'")';
$resql = $db->query($sql);
echo $sql;exit;