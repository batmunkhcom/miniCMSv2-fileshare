<?
if ($mBm != 1) {
    die('<div align="center"><font color="red">HACKING ATTEMPT....</font><br /> <a href="http://www.mng.cc">www.mng.cc</a></div>');
} elseif ($_SESSION['lev'] > 0) {
    echo '<div id="query_result">You must be logged out before register. 
			<a href="index.php?action=logout&url=' . base64_encode('index.php?module=users&cmd=registration') . '">click here</a> to log out.</div>';
} else {
    ?>
    <script language="javascript">
        function mbmCheckForm(){
            var userForm=document.userRegistration;
            var result_txt = '';
    		
            if(userForm.email.value.length<5){
                result_txt = result_txt+' <?= $lang["users"]["invalid_email"] ?>';
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
    </script>
    <h2>Бүртгэл</h2>
    <?
    if (isset($_POST['email'])) {
        $data['lev'] = 1;
        if (USER_DIRECT_ACTIVATION == '1') {
            $data['st'] = 1;
        } else {
            $data['activation_key'] = rand(1000000, 9999999);
            $data['st'] = 1;
        }
        $uname = explode('@', $_POST['email']);

        //$data['username']=strtolower($_POST['username']);
        $data['username'] = $uname[0];
        $newPASS = rand(1000, 99999999);
        $data['password'] = md5($newPASS);
        $data['email'] = $_POST['email'];
        $data['firstname'] = $_POST['firstname'];
        $data['lastname'] = $_POST['lastname'];
        $data['date_added'] = mbmTime();
        $data['enable_blog'] = 1;
        $data['session_id'] = session_id();

        //if(!eregi("^[a-zA-Z]+[a-zA-Z0-9_]+[a-zA-Z0-9_]$",$_POST['username'])){
        //	$result_txt = $lang["users"]['invalid_username_format'];
//			}else
        if ($DB2->mbm_check_field('username', $data['username'], 'users') == 1) {
            $result_txt = $lang["users"]["already_exists_username"];
        } elseif (mbmCheckEmail($_POST['email']) == 0) {
            $result_txt = $lang["users"]["invalid_email"];
        } elseif (strtolower(substr($_POST['email'], -6)) != 'gov.mn') {
            $result_txt = $lang["users"]["invalid_email"] . ' Зөвхөн user@domain.gov.mn бүхий имэйл хаягаар бүртгүүлэх бололмжтой.';
        } elseif ($DB2->mbm_check_field('email', $data['email'], 'users') == 1) {
            $result_txt = $lang["users"]["already_exists_email"];
        } else {
            if ($DB2->mbm_insert_row($data, 'users') == 1) {

                $v_link = DOMAIN . DIR . 'index.php?action=verification&UID=' . $DB2->mbm_get_field($data['session_id'], 'session_id', 'id', 'users')
                        . '&url=' . base64_encode('index.php?module=users&cmd=login'
                                . '&key=' . $data['activation_key']);
                if (USER_DIRECT_ACTIVATION == '0') {
                    $email_content = REGISTRATION_EMAIL . $lang['users']['verification_txt'];
                } else {
                    $email_content = REGISTRATION_EMAIL;
                }
                echo $newPASS.'----';
                $email_content = str_replace("{USERNAME}", $data['email'], $email_content);
                $email_content = str_replace("{PASSWORD}", $newPASS, $email_content);
                $email_content = str_replace("{DOMAIN}", DOMAIN, $email_content);

                if (USER_DIRECT_ACTIVATION == '0') {
                    $email_content = str_replace("{VERIFICATION_LINK}", $v_link, $email_content);
                } else {
                    $email_content = str_replace("{VERIFICATION_LINK}", "", $email_content);
                }

                $result_txt = $lang['users']['registration_successfull'];
                $b = 1;
                mbmSendEmail(ADMIN_NAME . '|' . ADMIN_EMAIL, $data['username'] . '|' . $data['email'], DOMAIN . ": User registration info", $email_content);
                //mbmSendEmail($data['firstname'].'|'.$data['email'],ADMIN_NAME.'|'.ADMIN_EMAIL,DOMAIN.": User {".$data['username']."} has been registered",mbmDate("Y-m-d, H:i:s"));
            } else {
                $result_txt = $lang["users"]["error_occurred"];
            }
        }
        echo '<div id="query_result">' . $result_txt . '</div>';
    }
    if ($b != 1) {
        ?>
        <form id="userRegistration" name="userRegistration" method="post" action="" onsubmit="mbmCheckForm();return false;">
            <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tr>
                    <td width="20%" align="right"><?= $lang["users"]["email"] ?>:</td>
                    <td width="30%"><input name="email" type="text" class="input" value="<?= $_POST['email'] ?>" id="email" size="30" /></td>
                    <td>Зөвхөн email@*.gov.mn имэйл хаягтай хэрэглэгчдэд үйлчилнэ.</td>
                </tr>
                <tr style="display: none;">
                    <td align="right"><?= $lang["users"]["select_username"] ?></td>
                    <td><input name="username" type="text" class="input" id="username" value="<?= $_POST['username'] ?>" size="30" /></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="button" name="userRegistration" id="userRegistration" value="<?= $lang["users"]["button_register"] ?>" /></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
        <?
    }
}
?>
