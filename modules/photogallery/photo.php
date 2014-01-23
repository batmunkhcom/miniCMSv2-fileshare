<?
if($mBm!=1){
	die('<div align="center"><font color="red">HACKING ATTEMPT....</font><br /> <a href="http://www.mng.cc">www.mng.cc</a></div>');
}elseif($DB->mbm_check_field('id',$_GET['id'],'gallery_files')==0){
	echo '<h2>Photo gallery</h2>';
	echo '<div id="query_result">No such photo exists.</div>';
}else{

	echo '<h2>Photo gallery</h2>';
	
	$DB->mbm_query("UPDATE ".PREFIX."gallery_files SET hits=hits+1,views=views+1 WHERE id='".$_GET['id']."'");
	
	$q_photo_file = "SELECT * FROM ".PREFIX."gallery_files WHERE id='".$_GET['id']."'";
	$r_photo_file = $DB->mbm_query($q_photo_file);
	echo '<div id="contentTitle">'.$DB->mbm_result($r_photo_file,0,"name").'</div>';
	echo '<img src="img.php?type='.$DB->mbm_result($r_photo_file,0,"filetype")
						.'&w=';
	if(PHOTOGALLERY_MAX_PHOTO_WIDTH>$DB->mbm_result($r_photo_file,0,"width")){
		echo $DB->mbm_result($r_photo_file,0,"width");
	}else{
		echo PHOTOGALLERY_MAX_PHOTO_WIDTH;
	}
	echo '&f='.base64_encode($DB->mbm_result($r_photo_file,0,"url"))
		 .'" border="0" alt="'.$DB->mbm_result($r_photo_file,0,"comment").'" />';
	echo '<br />'.$DB->mbm_result($r_photo_file,0,"comment");
}
?>