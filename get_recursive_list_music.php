<script src="script/jquery.js"></script>

<style type="text/css">
#data{
    width: auto;
    height:430px;
    overflow-x:scroll;
}
</style>

<?php

print '<form name="displayRecursiveFolder" method="GET" ation="'.$_SERVER['PHP_SELF'].'" >';
print 'Folder path : ';
@print '<input type="text" name="folder_path" value="'.$_REQUEST['folder_path'].'" />';
print '	Ajouté depuis : ';
print '<input type="text" name="from" value="'.(isset($_REQUEST['from']) ? $_REQUEST['from'] : '').'" />';
print '<input type="submit" name="subForm" value="Afficher"/>';
print '</form>';
print 'Répertoires fréquents :<br />';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CSoir%E9es&subForm=Afficher">Soirées</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CSoir%E9es%5CRNB&subForm=Afficher">RNB</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CSoir%E9es%5CZouk+Reggae+Ragga&from=&subForm=Afficher">Zouk - Reggae - Ragga</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CSoir%E9es%5CBombes+Disco+-+Funk&from=&subForm=Afficher">Funk</a>';
print '<br />';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A\Ma+musique\Nouvo\Clubteam.pl\Nouveau\News+autres+que+Musibox&from=&subForm=Afficher">NAQM</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A\Ma+musique\Nouvo\Clubteam.pl\Nouveau\News+autres+que+Musibox\House+-+Deep+-+Future+House&subForm=Afficher">House - Deep</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CNouvo%5CClubteam.pl%5CNouveau%5CNews+autres+que+Musibox%5CMoombahton&from=&subForm=Afficher">Moombah!</a>';
print ' / ';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CNouvo%5CClubteam.pl%5CNouveau%5CNews+autres+que+Musibox%5CTrap&from=&subForm=Afficher">Trap - Chill trap</a>';
print '<br />';
print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path=D%3A%5CMa+musique%5CAchats+internet%5CT%E9l%E9chargement+l%E9gal+Musiboxlive&from=&subForm=Afficher">MBL</a>';
print '<br />';
print '<br />';
print 'Tri BPM : ';
@print '<a href="?folder_path='.$_REQUEST['folder_path'].'&from='.$_REQUEST['from'].'&tri=asc"><img src="img/fleche_asc.jpg" /></a>';
@print '<a href="?folder_path='.$_REQUEST['folder_path'].'&from='.$_REQUEST['from'].'&tri=desc"><img src="img/fleche_desc.jpg" /></a>';
print '<br />';

if(isset($_REQUEST['folder_path'])) $folder_path = $_REQUEST['folder_path'];
if(isset($_REQUEST['from'])) $from = strtotime($_REQUEST['from']);

//echo is_dir('D:\Ma musique\Nouvo\Clubteam.pl\Nouveau\News autres que Musibox\House - Deep House');exit;

$TBPM = @get_tab_bpm();
$TDisplayData = array();
$i=1;

print '<div id="data">';

if(!empty($folder_path)) {
	print '<table  style="white-space: nowrap;">';
	print '<tr>';
	print '<th>';
	print '</th>';
	print '<th>';

	print '</th>';
	print '<th>';
	print '</th>';
	print '</tr>';
	@print_folder_content_recursive($folder_path, $from, $TBPM);
	if(isset($_REQUEST['tri'])) tri_tableau($TDisplayData, $_REQUEST['tri']);
	affichage($TDisplayData);
	print '</table>';
}

print '</div>';

function print_folder_content_recursive($folder_path, $from, $TBPM) {

	global $i, $TDisplayData;

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

			$TDisplayData[$data] = array('bpm'=>$TBPM[$data], 'folder'=>$folder_path, 'iterateur'=>$i);
			$i++;
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

function affichage($TData) {

	$bc = false;

	foreach($TData as $data=>$infos) {
		print '<tr '.(empty($bc) ? 'bgcolor="#DCDCDC"' : '').'>';
		print '<td>';
		print $data;
		print '<input type="hidden" value="'.$data.'" id="title_'.$infos['iterateur'].'" />';
		print '</td>';
		print '<td>';
		print '<input type="text" id="bpm_'.$infos['iterateur'].'" size="5" value="'.$infos['bpm'].'" />';
		print ' ';
		print '<button class="btn_save" name="'.$infos['iterateur'].'" >save</a>';
		//print '<a href="#"><img src="save.jpg" /></a>';
		print '</td>';
		print '<td>';
		print '<a href="http://127.0.0.1/recursive_path/get_recursive_list_music.php?folder_path='.urlencode($infos['folder']).'&subForm=Afficher">'.$infos['folder'].'</a>';
		print '</td>';
		print '</tr>';
		$bc = !$bc;
	}

}

function tri_tableau(&$TDisplayData, $ordre='asc') {

	uasort($TDisplayData, 'cmp_'.$ordre);

}

function cmp_asc($a, $b) {
	if ($a['bpm'] == $b['bpm']) {
        return 0;
    }
    return ($a['bpm'] < $b['bpm']) ? -1 : 1;
}

function cmp_desc($a, $b) {
	if ($a['bpm'] == $b['bpm']) {
        return 0;
    }
    return ($a['bpm'] > $b['bpm']) ? -1 : 1;
}

?>

<script type="text/javascript">
	
	$(document).ready(function() {
		console.log($("#btn_savee"));
		$(".btn_save").click(function() {
			
		    $.ajax({

		       url : 'script/interface.php',

		       type : 'GET',

		       data : 'title=' + encodeURIComponent($("#title_" + this.name).val()) + '&bpm=' + $("#bpm_" + this.name).val()

		    });

	    });

	});
	
</script>

<?php
