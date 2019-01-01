<?php

$title = utf8_decode($_REQUEST['title']);
$bpm = $_REQUEST['bpm'];
$color = $_REQUEST['color'];

$db = new PDO("mysql:host=localhost;dbname=bpm_title;charset=UTF8", 'root', '');

$sql = 'SELECT rowid FROM bpm_title WHERE title = "'.utf8_encode($title).'"';
$resql = $db->query($sql);
$res = $resql->fetchAll();
if(!empty($res)) $id = (int)$res[0]['rowid'];
else $id = 0;

if(!empty($id)) { // Ligne déjà existante
	$sql_update = 'UPDATE bpm_title SET title = "'.utf8_encode($title).'", bpm = '.(empty($bpm) ? 0 : $bpm).', color = "'.$color.'" WHERE rowid = '.$id;
	$resql = $db->query($sql_update);
} else { // Nouvelle ligne
	$sql_add = 'INSERT INTO bpm_title(title, bpm, color) VALUES("'.utf8_encode($title).'", '.(empty($bpm) ? 0 : $bpm).', "'.$color.'")';
	$resql = $db->query($sql_add);
}