<?
	error_reporting(E_ALL ^ E_NOTICE);
	unset($_GET['mBm'],$_POST['mBm'],$_SESSION['mBm'],$_REQUEST['mBm']);
	$mBm=1;
	if(substr_count($_SERVER['QUERY_STRING'],"%20")>0){
		die("HACKING ATTEMP....");
	}
	unset($_GET['PHPSESSID']);
	if(isset($_GET['redirect'])){
		header("Location: ".base64_decode($_GET['redirect']));
	}
	require_once("config.php");
	include(INCLUDE_DIR."includes/common.php");
	
	if(!isset($_SESSION['ln'])){
		$_SESSION['ln']=DEFAULT_LANG;
	}
	if(!isset($_SESSION['lev'])){
		$_SESSION['lev']=0;
	}
	if($_SESSION['lev']<4){
		//die("please login www.Yadii.Net");
	}
	include(INCLUDE_DIR."lang/".$_SESSION['ln']."/index.php");
	mbm_include(INCLUDE_DIR."classes",'php');
	mbm_include(INCLUDE_DIR."functions_php",'php');
	require_once(INCLUDE_DIR."includes/settings.php");

	include_once(ABS_DIR."editors/spaw2/spaw.inc.php");
	
	foreach($modules_active as $module_k=>$module_v){
		require_once(ABS_DIR."modules/".$module_v."/index.php");
	}
	foreach($module_include_dir as $include_folders_k=>$include_folders_v){
		mbm_include($include_folders_v,'php');
	}
	
	//include(INCLUDE_DIR."includes/header.php");
	#include("templates/".TEMPLATE."/index.php");
	
	echo '<form action="" method="get"><select onchange="window.location=\'videos.php?n=\'+this.value">';
		echo '<option>Select folder </option>';
	$d = dir(ABS_DIR."videos/");
		while (false !== ($entry = $d->read())) {
			if(substr_count($entry,".")==0){
				echo '<option value="'.$entry.'">';
					echo $entry;
				echo '</option>';
			}
		}
	echo '</select><br />
			<input type="input" name="n" id="n"><input type="submit" name="go" value="next step"></form>';
	if($_GET['n']){
		$video_dir = $_GET['n']."/";
		$d = dir(ABS_DIR."videos/".$video_dir);
		$i=0;
		while (false !== ($entry = $d->read())) {
			if(strtolower(substr($entry,-3))=='flv' && substr_count($entry,'\'')==0){
				if($DB->mbm_check_field('url',DOMAIN.DIR."videos/".$video_dir.$entry,'menu_videos')==0){
					$i++;
					unset($abs_filename);
					$abs_filename = ABS_DIR."videos/".$video_dir.$entry;
					$f_size = filesize($abs_filename);
					echo '<strong>'.($i).'.</strong>  <input type="text" size="100" value="'.addslashes(str_replace("_"," ",substr($entry,0,-4))).'" /> <br />';
						echo '<input type="text" size="100" value="'.DOMAIN.DIR."videos/".$video_dir.$entry.'" /> <br />';
							
							echo'<input type="text" size="50" value="'.$f_size.'" /> Filesize<br />';
							echo'<input type="text" size="50" value="';
							if($f_size < 67108864 ){
								echo mbmGetFLVDuration($abs_filename);
							}else{
								echo 'file aa ajluulaad toonii mashin ashiglaj bod. niit sekund';
							}
							echo '" /> Duration<br />';
						//echo '<input type="text" size="50" value="videos/'.substr($entry,0,-3).'jpg" /> Image url<br />';
						//echo '<img src="'.DOMAIN.DIR.'videos/'.substr($entry,0,-3).'jpg" width="100" />';
					echo '<hr />';
				}
			}
			if( $i == 30){
				exit();
			}
		}
		$d->close();
		echo '<br /> total : '.$i;
	}
	include(ABS_DIR.INCLUDE_DIR."includes/footer.php");
?>