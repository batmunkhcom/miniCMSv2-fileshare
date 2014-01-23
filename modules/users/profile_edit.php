<?
if ($mBm != 1) {
    die('<div align="center"><font color="red">HACKING ATTEMPT....</font><br /> <a href="http://www.mng.cc">www.mng.cc</a></div>');
} else {
    ?>
    <script language="javascript">
        function mbmCheckForm(){
            var userForm=document.userRegistration;
            var result_txt = '';
    		
            if(userForm.pass1.value!=userForm.pass2.value){
                result_txt = result_txt+' Нууц үгс хоорондоо тохирохгүй байна.';
            }
    		
            if(result_txt!=''){
                alert(result_txt);
                return false;
            }else{
                userForm.action="";
                userForm.method="post";
                userForm.submit();
                return true;
            }
        }
    </script><?
    if (isset($_POST['saveButton'])) {
//        $data['email'] = $_POST['email'];
        if (strlen($_POST['pass1']) > 3) {
            $data['password'] = md5($_POST['pass1']);
        }
//        $data['firstname'] = $_POST['firstname'];
//        $data['lastname'] = $_POST['lastname'];
//        $data['birthday'] = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
//        $data['gender'] = $_POST['gender'];
//        $data['phone'] = $_POST['phone'];
//        $data['fax'] = $_POST['fax'];
//        $data['mobile'] = $_POST['mobile'];
//        $data['yim'] = $_POST['yim'];
//        $data['msn'] = $_POST['msn'];
//        $data['occupation'] = $_POST['occupation'];
//        $data['city'] = $_POST['city'];
//        $data['country'] = $_POST['country'];
//        $data['website'] = $_POST['website'];
//        $data['date_lastupdated'] = mbmTime();

        if ($DB2->mbm_update_row($data, 'users', $_SESSION['user_id'], "id") == 1) {
            $result_txt = 'Шинэчилэгдлээ';
            $b = 1;
        } else {
            $result_txt = $lang["users"]["error_occurred"];
        }
        echo '<div id="query_result">' . $result_txt . '</div>';
    }
    if ($b != 1) {
        $q_user_profile = "SELECT * FROM " . USER_DB_PREFIX . "users WHERE id='" . $_SESSION['user_id'] . "'";
        $r_user_profile = $DB2->mbm_query($q_user_profile);
        ?>
        <form id="userRegistration" name="userRegistration" method="post" action="" onsubmit="mbmCheckForm();return false;">
            <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tr>
                    <td align="right">Нэвтрэх имэйл хаяг</td>
                    <td><input name="username" type="text" class="input" id="username" value="<?= $DB2->mbm_result($r_user_profile, 0, "email") ?>" size="30" disabled="disabled" /></td>
                    <td align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">Шинэ нууц үг:</td>
                    <td><input name="pass1" type="password" class="input" id="pass1" size="30" /></td>
                    <td align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">Нууц үгээ дахин оруулна уу:</td>
                    <td><input name="pass2" type="password" class="input" id="pass2" size="30" /></td>
                    <td align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" class="button" name="saveButton" id="saveButton" value="Хадгалах" /></td>
                    <td align="right">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right">&nbsp;</td>
                </tr>
            </table>
        </form>
        <?
    }
}
?>
