<?
if($mBm!=1){
	die('<div align="center"><font color="red">HACKING ATTEMPT....</font><br /> <a href="http://www.mng.cc">www.mng.cc</a></div>');
}elseif($DB2->mbm_check_field('id',$_SESSION['user_id'],'users')==0){
	echo '<div id="errorMain">Please login first.</div>';
}else{
	$q_user_profile = "SELECT * FROM ".USER_DB_PREFIX."users WHERE id='".$_SESSION['user_id']."'";
	$r_user_profile = $DB2->mbm_query($q_user_profile);
?>
<table width="100%" border="0" cellspacing="2" cellpadding="5">
  <tr class="tblHeader">
    <td colspan="2">Хувийн мэдээлэл</td>
    <td colspan="2">Холболтын мэдээлэл</td>
  </tr>
  <tr>
    <td width="25%" valign="top" bgcolor="#F5F5F5">Имэйл хаяг: </td>
    <td width="25%" valign="top" bgcolor="#F5F5F5"><strong>
      <?=$DB2->mbm_result($r_user_profile,0,"email")?>
    </strong></td>
    <td width="25%" valign="top" bgcolor="#F5F5F5">Бүртгүүлсэн:</td>
    <td width="25%" valign="top" bgcolor="#F5F5F5"><strong>
      <?=date("Y/m/d H:i:s",$DB2->mbm_result($r_user_profile,0,"date_added"))?>
      <br />
    </strong></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#F5F5F5">Багц: </td>
    <td valign="top" bgcolor="#F5F5F5"><strong>
            <?=$GLOBALS['config_fileshare']['service_name'][$_SESSION['lev']]?>
    </strong></td>
    <td valign="top" bgcolor="#F5F5F5">Сүүлд нэвтэрсэн огноо:</td>
    <td valign="top" bgcolor="#F5F5F5"><strong>
      <?=date("Y/m/d H:i:s",$DB2->mbm_result($r_user_profile,0,"date_lastlogin"))?>
    </strong></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#F5F5F5">Файлын хуулах хэмжээ: </td>
    <td valign="top" bgcolor="#F5F5F5"><strong>
            <?=$GLOBALS['config_fileshare']['upload_max_size'][$_SESSION['lev']]?> MB
    </strong></td>
    <td valign="top" bgcolor="#F5F5F5">Сүүлд хандсан хаяг:</td>
    <td valign="top" bgcolor="#F5F5F5"><strong>
      <?=$DB2->mbm_result($r_user_profile,0,"ip_lastlogin")?>
    </strong></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#F5F5F5">Файлын хадгалах хоног: </td>
    <td valign="top" bgcolor="#F5F5F5"><strong>
            <?=$GLOBALS['config_fileshare']['days_to_save'][$_SESSION['lev']]?> хоног
    </strong></td>
    <td valign="top" bgcolor="#F5F5F5">&nbsp;</td>
    <td valign="top" bgcolor="#F5F5F5"><strong>
            &nbsp;
    </strong></td>
  </tr>
</table>
<?
}
?>
