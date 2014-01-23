<?
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 

$tddddddddddddd = time();
//include zamiig todorhoilj uguh
//ini_set('include_path',ABS_DIR . INCLUDE_DIR);
ini_set('session.cookie_lifetime',8888);
set_time_limit(0);

if(ini_get('session.save_handler') != 'user'){
	///ini_set('session.save_handler', 'user');
}
ini_set('session.gc_maxlifetime', 3600);
ini_set("url_rewriter.tags","");
ini_set("gd.jpeg_ignore_warning", 1);

header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past




define("PREFIX",$config['db_prefix']);
$security_key = md5('mbm');

// session eheleh
///include_once("adodb/adodb.inc.php");
///include_once("adodb/session/adodb-session-clob2.php");



///$options['table'] = SESSION_DB_PREFIX.SESSION_DB_TABLE;

if(isset($_COOKIE[COOKIE_NAME]) && strlen($_COOKIE[COOKIE_NAME])==32){
	$sssss_id = $_COOKIE[COOKIE_NAME];
}else{
	$sssss_id = md5(uniqid(rand(), true));
}

//session_set_cookie_params(3600,'/','.'.COOKIE_DOMAIN,0);
//setcookie(COOKIE_NAME,$az_session_id,time()+3600,'/',COOKIE_DOMAIN,0);
unset($_COOKIE['PHPSESSID']);
session_set_cookie_params(21600);
if(session_name() != COOKIE_NAME) session_name(COOKIE_NAME);
session_id($sssss_id);

//ADOdb_Session::user($az_session_id);
///ADOdb_Session::config('mysql', SESSION_DB_HOST,SESSION_DB_USER,SESSION_DB_PASS,SESSION_DB_NAME,$options);

///ADODB_Session::optimize(true); //vacuum on

session_start();

//session asuudal duusah
	
	function mbm_include($dir,$ext)
	{

		$d = dir(ABS_DIR.$dir);
		
		while (false !== ($entry = $d->read())) {
		  
		  switch(strtolower($ext)){
		  	case 'php':
				if(substr($entry,-3)=='php'){
						include_once(ABS_DIR.$dir.'/'.$entry);
				  }
			break;
		  	case 'txt':
				if(substr($entry,-3)=='txt'){
						include_once(ABS_DIR.$dir.'/'.$entry);
				  }
			break;
			case 'css':
			  if(substr($entry,-3)=='css'){
					//echo '<link href="'.DOMAIN.DIR.$dir.'/'.$entry.'" rel="stylesheet" type="text/css" />'."\n";
					$css_files .= '@import url("'.DOMAIN.DIR.$dir.'/'.$entry.'");'."\n";
			  }
			break;
			case 'js':
			  if(substr($entry,-2)=='js'){
			  	echo '<script  src="'.INCLUDE_DOMAIN.str_replace(INCLUDE_DIR,"",$dir).'/'.$entry.'" language="Javascript" type="text/javascript"></script>'."\n";
			  /*
					echo '<script language="javascript" type="text/javascript" >'."\n";
					echo "<!--\n";
					//echo "//".$dir.'/'.$entry." file eheljiinadaa..\n";
					$lines = file(ABS_DIR.$dir.'/'.$entry);
					foreach ($lines as $line_num => $line) {
					   echo $line;
					}
					echo '//-->';
					echo '</script>'."\n";
			  */
			  }
			break;
			case 'php_js':
			  if(substr($entry,-3)=='php'){
			  	echo '<script  src="'.INCLUDE_DOMAIN.str_replace(INCLUDE_DIR,"",$dir).'/'.$entry.'" language="Javascript" type="text/javascript"></script>'."\n";
			  }
			break;
			case 'js_template':
			  if(substr($entry,-2)=='js'){
			  	echo '<script  src="'.DOMAIN.DIR.$dir.'/'.$entry.'" language="Javascript" type="text/javascript"></script>'."\n";
			  /*
					echo '<script language="javascript" type="text/javascript" >'."\n";
					echo "<!--\n";
					//echo "//".$dir.'/'.$entry." file eheljiinadaa..\n";
					$lines = file(ABS_DIR.$dir.'/'.$entry);
					foreach ($lines as $line_num => $line) {
					   echo $line;
					}
					echo '//-->';
					echo '</script>'."\n";
			  */
			  }
			break;
		  }
		}
		$d->close();
		if($ext == 'css'){
			echo "\n".'<style type="text/css">'."\n";
				echo $css_files;
			echo '</style>'."\n";
		}
	}
	
	function mbm_test($d){
		echo '<table cellspacing="2" cellpadding="5" 
				style="border: 1px solid #FF0000;
				margin-bottom:6px;
				float:right;">';
			echo '<tr><td align="center" 
						style="font-weight:bold;background-color:#FF0000;color:#FFFFFF;">';
				echo 'Keys';
			echo '</td><td align="center" 
						style="font-weight:bold;background-color:#FF0000;color:#FFFFFF;">';
				echo 'Values';
			echo '</td></tr>';
		foreach($d as $k=>$v){
			echo '<tr><td align="right" bgcolor="#EEEEEE">';
			echo '<strong>'.$k.'</strong>';
			echo '</td><td bgcolor="#F5F5F5">';
			echo $v;
			echo '</td></tr>';
		}
		echo '</table>';
	}
	function mbm_test2($d){
		echo '<table cellspacing="2" cellpadding="5" 
				style="border: 1px solid #FF0000;
				margin-bottom:6px;
				margin-right:2px;
				float:right;">';
			echo '<tr><td align="center" 
						style="font-weight:bold;background-color:#FF0000;color:#FFFFFF;">';
				echo 'Keys';
			echo '</td><td align="center" 
						style="font-weight:bold;background-color:#FF0000;color:#FFFFFF;">';
				echo 'Values';
			echo '</td></tr>';
		foreach($d as $k=>$v){
				echo '<tr style="color:#FFFFFF"><td bgcolor="#175796" colspan="2">';
				echo '<strong>'.$k.'</strong>';
				echo '</td></tr>';
				foreach($d[$k] as $kk=>$vv){
					echo '<tr><td align="right" bgcolor="#EEEEEE">';
					echo '<strong>'.$kk.'</strong>';
					echo '</td><td bgcolor="#F5F5F5">';
					echo $vv;
					echo '</td></tr>';
				}
		}
		echo '</table>';
	}
	
	function mbm_result($txt=''){
		if(strlen($txt)>3){
			return '<div id="query_result">'.$txt.'</div>';
		}else{
			return '';
		}
	}
	function mbm_get_included_file(){
		$included_files = get_included_files();
		$buf = '';		
		foreach ($included_files as $filename) {
		   $buf .= "$filename<br />";
		}
		return $buf;
	}
	
?>