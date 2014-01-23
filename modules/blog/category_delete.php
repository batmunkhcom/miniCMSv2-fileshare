<?	
	mbmDeleteShopCategory($_GET['id']);
	mbmResetPos($_GET['id'], $_GET['cat_id'], "shop_categories");
?>
<div align="center">
	<a href="index.php?module=shopping&cmd=categories&start=<?= $_GET['start']?>&per_page=<?= $_GET['per_page']?>&cat_id=<?= $_GET['cat_id']?>"><?= $lang['success'][3]?></a>
</div>