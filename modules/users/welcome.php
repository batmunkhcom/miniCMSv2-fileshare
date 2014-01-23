<h2>Сайн байна уу </h2>
Та сүүлд <?=date("Y/m/d H:i:s",$DB2->mbm_get_field($_SESSION['user_id'],'id',"date_lastlogin","users"))?>-ний өдөр 
        <?=$DB2->mbm_get_field($_SESSION['user_id'],'id',"ip_lastlogin","users")?> хаягнаас хандсан байна. 
<br />
Та "<?=$GLOBALS['config_fileshare']['service_name'][$_SESSION['lev']]?>" багцийн хэрэглэгч бөгөөд хамгийн томдоо <?=$GLOBALS['config_fileshare']['upload_max_size'][$_SESSION['lev']]?> MB файл хуулах боломжтой. 
<br />
Таны файлыг хэн нэг нь татахгүй <?=$GLOBALS['config_fileshare']['days_to_save'][$_SESSION['lev']]?> хоносон тохиолдолд уг файл серверээс автоматаар устана. 