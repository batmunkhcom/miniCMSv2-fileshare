<?
$link = mysql_connect("localhost","root","") or die(mysql_error());
mysql_query("LOAD DATA FROM MASTER") or die(mysql_error());
echo 'done';
?>