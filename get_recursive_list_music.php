<script src="script/jquery.js"></script>
<script src="script/notify.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style type="text/css">
#data{
    width: auto;
    height:677px;
    overflow-x:scroll;
}
td.color_track_visu{
	width:30px;
	border:1px solid;
}
td.title_track{
	width:1000px;

</style>

<?php

error_reporting(0);

$page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

print '<form name="displayRecursiveFolder" method="GET" ation="'.$_SERVER['PHP_SELF'].'" >';
print 'Folder path : ';
@print '<input type="text" name="folder_path" value="'.$_REQUEST['folder_path'].'" />';
print '&nbsp;&nbsp;Ajouté depuis : ';
print '<input type="text" name="from" value="'.(isset($_REQUEST['from']) ? $_REQUEST['from'] : '').'" />';
print '<input type="submit" name="subForm" value="Afficher"/>';
print '&nbsp;&nbsp;<input placeholder="Rechercher titre / BPM" type="text" id="track_name"/>&nbsp;';
print '&nbsp;&nbsp;<a href="#" id="empty_field" style="text-decoration:none;">X</a>';
print '&nbsp;&nbsp;<a href="#" class="filter_color" value="#14c904" style="background-color:#14c904;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
print '&nbsp;&nbsp;<a href="#" class="filter_color" value="#f2ff00" style="background-color:#f2ff00;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
print '&nbsp;&nbsp;<a href="#" class="filter_color" value="#FFA500" style="background-color:#FFA500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
print '&nbsp;&nbsp;<a href="#" class="filter_color" value="#AFAFAF" style="background-color:#AFAFAF;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
print '&nbsp;&nbsp;<a href="#" class="filter_color" value="#dc39e5" style="background-color:#dc39e5;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
print '</form>';

print 'Répertoires fréquents&nbsp;:&nbsp;';
print '<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es&title_page=Soirées">Collection</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CSoleil&subForm=Afficher&title_page=Soleil">Soleil</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CRNB&subForm=Afficher&title_page=RNB">RNB</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CZouk+Reggae+Ragga&from=&subForm=Afficher&title_page=Zouk - Reggae - Ragga">Latino</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CBombes+Disco+-+Funk&from=&subForm=Afficher&title_page=Funk">Funk</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CPop&from=&subForm=Afficher&title_page=Pop">Pop</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CGipsy&from=&subForm=Afficher&title_page=Espagnol">Espagnol</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5C80&from=&subForm=Afficher&title_page=80">80</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5C90&from=&subForm=Afficher&title_page=90">90</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5C2000&from=&subForm=Afficher&title_page=2000">2000</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CHouse+-+Deep+-+Future+House&subForm=Afficher&title_page=House">House</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CMinimal&subForm=Afficher&title_page=House">Minimal</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CHouse+-+Deep+-+Future+House%5CChill&subForm=Afficher&title_page=Chill">Chill</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CMoombahton&from=&subForm=Afficher&title_page=Moombahton">Moombah!</a>';
print '&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Soir%E9es%5CTrap&from=&subForm=Afficher&title_page=Trap - Chill Trap">Trap</a>';
print '&nbsp;/&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Nouvo\Clubteam.pl\Nouveau\News%20autres%20que%20Musibox&from=&subForm=Afficher&title_page=NAQM">NAQM</a>';
print '&nbsp;/&nbsp;<a class="btn btn-info" href="http://'.$page.'?folder_path=D:\Musique\Achats internet\MBL&subForm=Afficher&title_page=Musiboxlive">MBL</a>';

/*print 'Tri BPM : ';
@print '<a href="?folder_path='.$_REQUEST['folder_path'].'&from='.$_REQUEST['from'].'&title_page='.$_REQUEST['title_page'].'&tri=asc"><img src="img/fleche_asc.jpg" /></a>';
@print '<a href="?folder_path='.$_REQUEST['folder_path'].'&from='.$_REQUEST['from'].'&title_page='.$_REQUEST['title_page'].'&tri=desc"><img src="img/fleche_desc.jpg" /></a>';*/
print '<br />';
print '<br />';

if(isset($_REQUEST['folder_path'])) $folder_path = $_REQUEST['folder_path'];
if(isset($_REQUEST['from'])) $from = strtotime($_REQUEST['from']);

//echo is_dir('D:\Ma musique\Nouvo\Clubteam.pl\Nouveau\News autres que Musibox\House - Deep House');exit;

$TBPM = @get_tab_bpm();
$TDisplayData = array();
$i=1;

print '<div id="data">';

if(!empty($folder_path)) {
	print '<table  id="all_tracks" style="white-space: nowrap;">';
	/*print '<tr>';
	print '<th>';
	print '</th>';
	print '<th>';

	print '</th>';
	print '<th>';
	print '</th>';
	print '</tr>';*/
	@print_folder_content_recursive($folder_path, $from, $TBPM);
	tri_tableau($TDisplayData, !empty($_REQUEST['tri']) ? $_REQUEST['tri'] : 'desc');
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
		print '<td class="color_track_visu" ';
		if(!empty($infos['color'])) print 'bgcolor="'.$infos['color'].'"';
		elseif(empty($bc)) print 'bgcolor="#FFFFFF"';
		print '>';
		print '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
		print '</td>';
		print '<td class="title_track" style="weight:1000px;">';
		print $data;
		print '<input type="hidden" value="'.$data.'" id="title_'.$infos['iterateur'].'" />';
		print '</td>';
		print '<td class="bpm_and_color">';
		print '<input placeholder="BPM" type="text" id="bpm_'.$infos['iterateur'].'" size="5" value="'.$infos['bpm'].'" />';
		print ' <input placeholder="Color" type="text" id="color_'.$infos['iterateur'].'" size="5" value="'.$infos['color'].'" />';
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
			var color = $("#color_" + this.name).val();
		    $.ajax({

		       url : 'script/interface.php',

		       type : 'GET',

		       data : 'title=' + encodeURIComponent($("#title_" + this.name).val())
		       		   + '&bpm=' + $("#bpm_" + this.name).val()
		       		   + '&color=' + encodeURIComponent(color)

		    });

		    $(this).parent('td').parent('tr').find('td.color_track_visu').attr('bgcolor', color);

	    });

		$("#track_name").keyup(function() {
			var key_search = $(this).val();
			var it = true;
			$("#all_tracks > tbody > tr").each(function(i, item) {
				var title = $(item).find('td.title_track').text();
				var bpm = $(item).find('td.bpm_and_color').find('input[id^="bpm_"]').val();
				var color = $(item).find('td.bpm_and_color').find('input[id^="color_"]').val();
				
				if(title.toLowerCase().indexOf(key_search.toLowerCase()) == -1 
					&& bpm.indexOf(key_search) == -1
					&& color.indexOf(key_search) == -1) {
					$(item).hide();
				} else {
					$(item).show();
					if(it) {
						$(item).find('td').each(function(k, col) {
							if($(col).attr('class') != 'color_track_visu') {
								$(col).attr('bgcolor','#DCDCDC');
							}
						});
					}
					else {
						$(item).attr('bgcolor','');
						$(item).find('td').each(function(k, col) {
							if($(col).attr('class') != 'color_track_visu') {
								$(col).attr('bgcolor','');	
							}
						});
					}

					it=!it;
				}

			});
		});

		$("[class=filter_color]").click(function() {
			$("#track_name").val($(this).attr('value')).trigger("keyup");
		});

		$("#empty_field").click(function() {
			$("#track_name").val('').trigger('keyup');
		});

	});
	
</script>

<?php
