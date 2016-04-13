<?php

print '<form name="displayRecursiveFolder" method="GET" ation="'.$_SERVER['PHP_SELF'].'" >';
print 'Folder path : ';
print '<input type="text" name="folder_path" value="'.$_REQUEST['folder_path'].'" />';
print '	Ajouté depuis : ';
print '<input type="text" name="from" value="'.(isset($_REQUEST['from']) ? $_REQUEST['from'] : '').'" />';
print '<input type="submit" name="subForm" value="Afficher"/>';
print '</form>';
print 'Répertoires fréquents :<br />';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A\Ma+musique\Nouvo\Clubteam.pl\Nouveau\News+autres+que+Musibox\House+-+Deep+-+Future+House&subForm=Afficher">House - Deep</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CSoir%E9es%5CRNB&subForm=Afficher">RNB</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CSoir%E9es&subForm=Afficher">Soirées</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A\Ma+musique\Nouvo\Clubteam.pl\Nouveau\News+autres+que+Musibox&from=&subForm=Afficher">NAQM</a>';-
print '<br />';
print '<br />';

if(isset($_REQUEST['folder_path'])) $folder_path = $_REQUEST['folder_path'];
if(isset($_REQUEST['from'])) $from = strtotime($_REQUEST['from']);

//echo is_dir('D:\Ma musique\Nouvo\Clubteam.pl\Nouveau\News autres que Musibox\House - Deep House');exit;

$TBPM = get_tab_bpm();

if(!empty($folder_path)) {
	print '<table>';
	@print_folder_content_recursive($folder_path, $from, $TBPM);
	print '</table>';
}

function print_folder_content_recursive($folder_path, $from, $TBPM) {

	if(!is_dir($folder_path)) {
		print 'Répertoire incorrect';
		exit;
	}

	$TFiles = scandir($folder_path);
	
	$TFolder = array();

	foreach($TFiles as $data) {
		if($data === '.' || $data === '..' || strpos($data, '.jpg') !== false || strpos($data, '.ini') !== false) continue;
		
		if(is_dir($folder_path."\\".$data)) {
			//print_folder_content_recursive($folder_path."\\".$data);
			$TFolder[] = $folder_path."\\".$data;
		}
		else {

			if(isset($_REQUEST['search']) && strpos($data, $_REQUEST['search']) === false) continue;
			if(isset($from) && (filemtime($folder_path."\\".$data) < $from)) continue;
			print '<tr>';
			print '<td>';
			print $data;
			print '</td>';
			print '<td>';
			print $TBPM[$data];
			print ' ';
			print '<a href="#"><img src="save.jpg" /></a>';
			print '</td>';
			print '<td>';
			print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path='.urlencode($folder_path).'&subForm=Afficher">'.$folder_path.'</a>';
			print '</td>';
			print '</tr>';
		}
	}

	if(!empty($TFolder)) {
		foreach ($TFolder as $folder) {
			print_folder_content_recursive($folder, $from, $TBPM);
		}
	}

}

function get_tab_bpm() {

	$tabBPM = array();

	$db = new PDO("mysql:host=localhost;dbname=bpm_title;charset=UTF8", 'root', '');
	$resql = $db->query('SELECT * FROM bpm_title');
	$TRes = $resql->fetchAll();
	foreach ($TRes as $key => $value) {
		$tab[$value['title']] = $value['bpm'];
	}
	
	return $tab;
}
