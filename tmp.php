<center><a href="index.php"><img src="http://ubedn.mn/stants/logo2.png" width="267" height="90"></a><br />"Улаанбаатар Цахилгаан Түгээх Сүлжээ" ХК-ийн ажилчдын хэрэгцээнд</center><br />

<!--

<div style=" background-color: #EEE;">
    <?
    echo mbmUserPanel($_SESSION['user_id'], array('', '', '<div style="padding-left:10px;padding-bottom:4px;margin-bottom:3px;border-bottom:1px solid #3c5995;">', '</div>'), 'index.php?module=fileshare&cmd=myfiles');
    ?>
</div>

-->



<?
$buf_actions = '<div id="error">';
switch ($_GET['action']) {
    case 'delete':
        $buf_actions .= 'Файлыг устгав.';
        break;
    case 'error':
        $buf_actions .= 'Файл олдсонгүй.';
        break;
}
$buf_actions .= '</div>';

if (strlen($_SERVER['QUERY_STRING']) < 4) {
    mbm_include_file("templates/" . TEMPLATE . "/home.php");
//    echo '...1';
} elseif (file_exists(ABS_DIR . "modules/" . $_GET['module'] . "/" . $_GET['cmd'] . ".php")) {
    mbm_include_file("modules/" . $_GET['module'] . "/" . $_GET['cmd'] . ".php");
//    echo '...2';
} else {
//    echo '...3';
    if (isset($_GET['k'])) {
//        echo 1; die();
        if ($DB->mbm_check_field('key', $_GET['k'], 'fileshare') == 1) {
            mbm_include_file("modules/fileshare/dl.php");
        } else {
            echo mbmError('Файл олдсонгүй...');
        }
    } else {

        if (isset($_GET['action'])) {
            mbmError($buf_actions);
        } else {
            mbm_include_file("templates/" . TEMPLATE . "/home.php");
        }
    }
}
?>

<br />
<center>Таны оруулсан файл 7 хоногийн дараа автоматаар устах болно</center>