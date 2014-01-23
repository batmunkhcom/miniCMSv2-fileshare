<?
	error_reporting(E_ALL ^ E_NOTICE);
	unset($_GET['mBm'],$_POST['mBm'],$_SESSION['mBm'],$_REQUEST['mBm']);
	$mBm=1;
	if(substr_count($_SERVER['QUERY_STRING'],"%20")>0){
		//die("HACKING ATTEMP....");
	}
	unset($_GET['PHPSESSID']);
	if(isset($_GET['redirect'])){
		header("Location: ".base64_decode($_GET['redirect']));
	}
	require_once("/home/azmn/public_html/share.az.mn/config.php");
	include(ABS_DIR.INCLUDE_DIR."includes/common.php");
	
	if(!isset($_SESSION['ln'])){
		$_SESSION['ln']=DEFAULT_LANG;
	}
	if(!isset($_SESSION['lev'])){
		$_SESSION['lev']=0;
	}

	include(ABS_DIR.INCLUDE_DIR."lang/".$_SESSION['ln']."/index.php");
	mbm_include(INCLUDE_DIR."classes",'php');
	mbm_include(INCLUDE_DIR."functions_php",'php');
	require_once(ABS_DIR.INCLUDE_DIR."includes/settings.php");

	include_once(ABS_DIR."editors/spaw2/spaw.inc.php");
	
	foreach($modules_active as $module_k=>$module_v){
		require_once(ABS_DIR."modules/".$module_v."/index.php");
	}
	foreach($module_include_dir as $include_folders_k=>$include_folders_v){
		mbm_include($include_folders_v,'php');
	}
	
	$u_q = "UPDATE ".PREFIX."fileshare SET `days_to_save`=(`days_to_save`-1) WHERE session_time<".(mbmTime()-24*3600)."";
	$DB->mbm_query($u_q);
	
	$q_delete_files = "SELECT `key`,`key_delete`,`filename_orig` FROM ".PREFIX."fileshare WHERE days_to_save<0 ORDER BY date_added ";
	$r_delete_files = $DB->mbm_query($q_delete_files);
	
	for($i=0;$i<$DB->mbm_num_rows($r_delete_files);$i++){
		$result_txt .=  $DB->mbm_result($r_delete_files,$i,"user_id").'';
		$result_txt .=  $DB->mbm_result($r_delete_files,$i,"filename_orig");
		$result_txt .=  ' '.mbmDeleteFileFileshare(array(
											'del_key'=>$DB->mbm_result($r_delete_files,$i,"key_delete"),
											'key'=>$DB->mbm_result($r_delete_files,$i,"key")
											))."\n";
		$result_txt .=  '<br />';
		sleep(2);
	}
	
	$result_txt .= '<br />';
	$result_txt .= $DB->mbm_num_rows($r_delete_files).' files are deleted. ';
	echo $result_txt.'<br />';
	
	mbmSendEmail('Share AZ|info@az.mn','M.Batmunkh|admin@az.mn','fileshare cron',$result_txt);

?>