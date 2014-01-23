<?
if($mBm!=1){
	die('<div align="center"><font color="red">HACKING ATTEMPT....</font><br /> <a href="http://www.mng.cc">www.mng.cc</a></div>');
}
if(isset($_POST['buttonRecover'])){
	$q_check_user = "SELECT * FROM ".USER_DB_PREFIX."users WHERE email='".addslashes($_POST['email'])."'";
	$r_check_user = $DB2->mbm_query($q_check_user);
	if($DB2->mbm_num_rows($r_check_user)==1){
		$new_pass = rand(1000,9999);
		$q_reset_pw = "UPDATE ".USER_DB_PREFIX."users SET password='".md5($new_pass)."' WHERE email='"
					.addslashes($_POST['email'])."'";
                
                
		$r_reset_pw = $DB2->mbm_query($q_reset_pw);
		if($r_reset_pw==1){
			$result_txt = 'Шинэ нууц үгийг имэйлээр илгээлээ. Имэйлээ шалгана уу.';
			$email_content = PASSWORD_RECOVERY_EMAIL;
                        $email_content = str_replace('{PASSWORD}',$new_pass,PASSWORD_RECOVERY_EMAIL);
			mbmSendEmail(ADMIN_NAME.'|'.ADMIN_EMAIL,$_POST['email'].'|'.$_POST['email'],DOMAIN.": Password has been resetted",$email_content);
		}else{
			$result_txt = 'Уг хэрэглэгч олдсонгүй';
		}
	}else{
		$result_txt = 'Уг хэрэглэгч олдсонгүй';
	}
	echo mbmError($result_txt);
}
?>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
    <tr>
      <td>Имэйл</td>
      <td><input type="text" name="email" id="email" class="input" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="buttonRecover" id="buttonRecover" value="Шинэ нууц үгийг илгээ" class="button" /></td>
    </tr>
  </table>
</form>

