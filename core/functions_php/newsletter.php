<?php
function sendNewsletter($val = array(
	'subject'=>'',
	'from_email'=>'',
	'from_name'=>'',
	'title'=>'',
	'content'=>''
	
)){
	global $DB, $DB2;
	
	$content = $val['title']."\n\n\n";
	$content .= mbmCleanUpHTML($val['content']);
	
	$q = "SELECT * FROM ".$DB2->prefix."emails ORDER BY id";
	$r = $DB2->mbm_query($q);
	
	for($i=0;$i<$DB2->mbm_num_rows($r);$i++){
		
		$name = strtoupper(substr($DB2->mbm_result($r,$i,"email"),0,strpos('@',$DB2->mbm_result($r,$i,"email"))));
		mbmSendEmail($val['from_name'].'|'.$val['from_email'],$DB2->mbm_result($r,$i,"email"),$val['subject'],$content);
		
		unset($name);
	}
}
?>