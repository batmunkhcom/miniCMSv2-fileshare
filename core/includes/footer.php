<?
 "<script language=\"javascript\">
		function tempSession(){
			mbmLoadXML('GET','".DOMAIN.DIR."xml.php',mbmSession);
			setTimeout(\"tempSession()\",45000);
		}
		
		tempSession();
		</script>";

mbmStats();

echo '
<script language="javascript" type="text/javascript">

if($("#loginStatusText")){
	setTimeout("$(\"#loginStatusText\").slideUp()",3000);
}
</script>
</body>
</html>';
$DB->mbm_close();
$DB2->mbm_close();
include_once(ABS_DIR.INCLUDE_DIR.'debug.php');
unset($_SESSION['login_st']);
?>
