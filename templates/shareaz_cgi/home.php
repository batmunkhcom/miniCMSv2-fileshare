<?
$config_fileshare = $GLOBALS['config_fileshare'];
?>
<div id="query_result" style="display:none;">Туршилтын хугацаанд хэрэглэгчид <?=$config_fileshare['dl_limit'][1]?>кв/с хурдаар татах авах болно.</div>
<iframe src="<?=DOMAIN.DIR?>html/ubr_file_upload.php?code=<?=md5($_SESSION['lev'])?>" border="0" style="border:0px; margin:0px;width:100%; height:220px; background-color:#FFFFFF;" id="uploadFrame"></iframe>

<br clear="all" />
