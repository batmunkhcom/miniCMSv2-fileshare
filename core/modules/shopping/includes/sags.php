<?
function mbmShoppingAddToSag($product_id=0){
	global $DB;
	
	$q = "SELECT * FROM ".$DB->prefix."shop_products WHERE id='".$product_id."'";
	$r = $DB->mbm_query($q);
	if($DB->mbm_num_rows($r)==1){
		$_SESSION['shop_sags'] .= $DB->mbm_result($r,0,"id").':'.$DB->mbm_result($r,0,"name").',';
		return 1;
	}
	return 0;
}
function mbmShoppingAddToSagButton(){
	global $lang;
	
	$buf .= '<div id="sagsButton">';
	$buf .= '';
	$buf .= '';
	$buf .= '</div>';
}
?>