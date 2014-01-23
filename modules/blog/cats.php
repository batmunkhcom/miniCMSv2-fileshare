<?
function mbmBlogCategoryRec($c_id){
	global $DB, $Mas;
	
	if($c_id !=0){
		$q = "SELECT * FROM ".PREFIX."blog_cats WHERE st=1 AND id='".$c_id."'";
		$r = $DB->mbm_query($q);
		$Mas[$DB->mbm_result($r,0,"id")]= 1;
		mbmCategoryRec($DB->mbm_result($r,$i,"cat_id"));
	}
}

function mbmCategoryDesc($cid, $c_id){
	global $DB, $Mas;

	for($i=0; $i<99999; $i++){
		$Mas[$i]= 0;
	}
	$q = "SELECT * FROM ".PREFIX."blog_cats WHERE st=1 AND cat_id=0 OR cat_id='".$c_id."' ORDER BY pos";
	$r = $DB->mbm_query($q);
	for($i=0;$i<$DB->mbm_num_rows($r);$i++){
		$Mas[$DB->mbm_result($r,$i,"id")]= 1;
	}
	mbmCategoryRec($c_id);
}

function mbmShowCategory2($htmls,$cid,$c_id,$padding_left=10,$class='menu'){
	global $DB, $Mas, $bufferCat;
	$q_menu = "SELECT * FROM ".PREFIX."blog_cats WHERE st=1 AND cat_id='".$cid."' ORDER BY pos";
	$r_menu = $DB->mbm_query($q_menu);
	if($DB->mbm_num_rows($r_menu) != 0){
		for($i=0;$i<$DB->mbm_num_rows($r_menu);$i++){
			if($Mas[$DB->mbm_result($r_menu,$i,"id")] == 1){
				$buf = $htmls[2];
//				$buf .= '<span style="padding-left:'.($padding_left*$DB->mbm_result($r_menu,$i,"sub")).'px" ><a href="'
				if($DB->mbm_result($r_menu,$i,"link")==''){
					$url='index.php?module=blog&cmd=content&cat_id='.$DB->mbm_result($r_menu,$i,"id")."&start=0&per_page=".PER_PAGE;
				}else{
					if(substr_count($DB->mbm_result($r_menu,$i,"link"),"?")>0){
						$d='&';
					}else{
						$d='?';
					}
					$url = 'index.php?redirect='.base64_encode($DB->mbm_result($r_menu,$i,"link").$d."cid=".$DB->mbm_result($r_menu,$i,"id"));
				}	
				$buf .= $url.'" title="'.$DB->mbm_result($r_menu,$i,"comment").'" class="'.$class.'" target="'.$DB->mbm_result($r_menu,$i,"target").'">'.$DB->mbm_result($r_menu,$i,"name").'</a></span>';
				$buf .=$htmls[3];
				$bufferCat .= $buf;
				mbmShowCategory2($htmls, $DB->mbm_result($r_menu,$i,"id"),$c_id,10, 'blog_cats');
			}
		}
	}
	return true;
}

function mbmShowCategory($htmls,$cat_id,$c_id,$padding_left=15,$class='blog_cats'){
	
	global $bufferCat;
	if($htmls[0]){
		$bufferCat = $htmls[0];
	}
	
	
	mbmCategoryDesc($cat_id, $c_id);
	mbmShowCategory2($htmls,$cat_id,$c_id,10,'blog_cats');
	
	if($htmls[1]){
		$bufferCat .= $htmls[1];
	}
	return $bufferCat;
}
?>
