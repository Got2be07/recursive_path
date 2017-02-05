<script src="script/jquery.js"></script>
<script src="script/notify.js"></script>

<style type="text/css">
#data{
    width: auto;
    height:700px;
    overflow-x:scroll;
}
</style>

<?php

error_reporting(0);

$page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

print '<form name="displayRecursiveFolder" method="GET" ation="'.$_SERVER['PHP_SELF'].'" >';
print 'Folder path : ';
@print '<input type="text" name="folder_path" value="'.$_REQUEST['folder_path'].'" />';
print '	Ajouté depuis : ';
print '<input type="text" name="from" value="'.(isset($_REQUEST['from']) ? $_REQUEST['from'] : '').'" />';
print '<input type="submit" name="subForm" value="Afficher"/>';
print '</form>';
print 'Répertoires fréquents :<br />';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es&title_page=Soirées">Soirées</a>';
print ' : ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CSoleil&subForm=Afficher&title_page=Soleil">Soleil</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CRNB&subForm=Afficher&title_page=RNB">RNB</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CZouk+Reggae+Ragga&from=&subForm=Afficher&title_page=Zouk - Reggae - Ragga">Zouk - Reggae - Ragga</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CBombes+Disco+-+Funk&from=&subForm=Afficher&title_page=Funk">Funk</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CPop&from=&subForm=Afficher&title_page=Pop">Pop</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CGipsy&from=&subForm=Afficher&title_page=Espagnol">Espagnol</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5C80&from=&subForm=Afficher&title_page=80">80</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5C90&from=&subForm=Afficher&title_page=90">90</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5C2000&from=&subForm=Afficher&title_page=2000">2000</a>';
print '<br />';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Nouvo\Clubteam.pl\Nouveau\News%20autres%20que%20Musibox&from=&subForm=Afficher&title_page=NAQM">NAQM</a>';
print ' : ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Nouvo\Clubteam.pl\Nouveau\News%20autres%20que%20Musibox\House+-+Deep+-+Future+House&subForm=Afficher&title_page=House">House - Deep</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Nouvo\Clubteam.pl\Nouveau\News%20autres%20que%20Musibox%5CHouse+-+Deep+-+Future+House%5CChill&subForm=Afficher&title_page=Chill">Chill</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Nouvo\Clubteam.pl\Nouveau\News%20autres%20que%20Musibox%5CMoombahton&from=&subForm=Afficher&title_page=Moombahton">Moombah!</a>';
print ' / ';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Nouvo\Clubteam.pl\Nouveau\News%20autres%20que%20Musibox%5CTrap&from=&subForm=Afficher&title_page=Trap - Chill Trap">Trap - Chill trap</a>';
print '<br />';
print '<a href="http://'.$page.'?folder_path=D:\Musique\Achats internet\MBL&subForm=Afficher&title_page=Musiboxlive">MBL</a>';
print '<br />';
print '<br />';
print 'Tri BPM : ';
@print '<a href="?folder_path='.$_REQUEST['folder_path'].'&from='.$_REQUEST['from'].'&title_page='.$_REQUEST['title_page'].'&tri=asc"><img src="img/fleche_asc.jpg" /></a>';
@print '<a href="?folder_path='.$_REQUEST['folder_path'].'&from='.$_REQUEST['from'].'&title_page='.$_REQUEST['title_page'].'&tri=desc"><img src="img/fleche_desc.jpg" /></a>';
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

			$TDisplayData[$data] = array('bpm'=>$TBPM[$data]['bpm'], 'color'=>$TBPM[$data]['color'], 'folder'=>$folder_path, 'iterateur'=>$i);
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
		$tab[$value['title']]['bpm'] = $value['bpm'];
		$tab[$value['title']]['color'] = $value['color'];
		$tab[utf8_decode($value['title'])]['bpm'] = $value['bpm'];
		$tab[utf8_decode($value['title'])]['color'] = $value['color'];
	}
	
	return $tab;
}

function affichage($TData) {

	global $page;

	$bc = false;

	foreach($TData as $data=>$infos) {
		
		print '<tr ';
		if(empty($bc)) print 'bgcolor="#DCDCDC"';
		print '>';
		print '<td style="weight:50px;" ';
		if(!empty($infos['color'])) print 'bgcolor="'.$infos['color'].'"';
		elseif(empty($bc)) print 'bgcolor="#FFFFFF"';
		print '>';
		print '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
		print '</td>';
		print '<td>';
		print $data;
		print '<input type="hidden" value="'.$data.'" id="title_'.$infos['iterateur'].'" />';
		print '</td>';
		print '<td>';
		print '<input type="text" id="bpm_'.$infos['iterateur'].'" size="5" value="'.$infos['bpm'].'" />';
		print ' <input type="text" id="color_'.$infos['iterateur'].'" size="5" value="'.$infos['color'].'" />';
		print ' ';
		print '<button class="btn_save" name="'.$infos['iterateur'].'" >save</a>';
		//print '<a href="#"><img src="save.jpg" /></a>';
		print '</td>';
		print '<td>';
		print '<a href="http://'.$page.'?folder_path='.urlencode($infos['folder']).'&subForm=Afficher">'.$infos['folder'].'</a>';
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
	
	$.notify("<?php print $_REQUEST['title_page']; ?>", 'success');

	$(document).ready(function() {
		console.log($("#btn_savee"));
		$(".btn_save").click(function() {
			
		    $.ajax({

		       url : 'script/interface.php',

		       type : 'GET',

		       data : 'title=' + encodeURIComponent($("#title_" + this.name).val())
		       		   + '&bpm=' + $("#bpm_" + this.name).val()
		       		   + '&color=' + encodeURIComponent($("#color_" + this.name).val())

		    });

	    });

	});
	
</script>

<?php
