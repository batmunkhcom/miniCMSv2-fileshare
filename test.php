<?php



$link = mysql_connect('localhost','share','T72C2KtDDLNQvxJu') or die('not connected');
mysql_select_db('share_db',$link) or die('db not selected');

echo 'all db things are fine';

$q = "SELECT * from mbm_settings";
$r = mysql_query($q);

for($i=0;$i<mysql_num_rows($r);$i++){
		echo highlight_string(mysql_result($r,$i,'value'),true).'<br />';
}
?>