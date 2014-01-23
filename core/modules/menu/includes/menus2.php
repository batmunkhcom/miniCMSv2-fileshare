<?

function mbmShowSlideDownMenu($menu_id=0,$root_css='',$sub_css=''){
	global $DB;
	
	$q_menu = "SELECT * FROM ".PREFIX."menus WHERE st=1 
				AND lang='".$_SESSION['ln']."'
				AND lev<=".$_SESSION['lev']." AND menu_id='".$menu_id."' ORDER BY pos";
	$r_menu = $DB->mbm_query($q_menu);
	
	$buf = '';
	
	if($DB->mbm_num_rows($r_menu) != 0){
		for($i=0;$i<$DB->mbm_num_rows($r_menu);$i++){
			$q_submenu = "SELECT * FROM ".PREFIX."menus WHERE st=1 
				AND lang='".$_SESSION['ln']."'
				AND lev<=".$_SESSION['lev']." AND menu_id='".$DB->mbm_result($r_menu,$i,"id")."' ORDER BY pos";
			$r_submenu = $DB->mbm_query($q_submenu);
			
			$buf .= '<div id="jMenu'.$i.'" class="'.$root_css.'">';
				$buf .= '<a href="';
				$buf .= mbmMenuLink($DB->mbm_result($r_menu,$i,"id"),$DB->mbm_result($r_menu,$i,"link"));
				if($DB->mbm_num_rows($r_submenu)>0){
					$buf .= '" onclick="$(\'#jSubMenu'.$i.'\').toggle(); return false;" ondblclick="window.location=\''.mbmMenuLink($DB->mbm_result($r_menu,$i,"id"),$DB->mbm_result($r_menu,$i,"link")).'\'" ';
				}else{
					$buf .= '" ';
				}
				$buf .= '>';
					$buf .= $DB->mbm_result($r_menu,$i,"name");
				$buf .= '</a>';
			$buf .= '</div>';
			if($DB->mbm_num_rows($r_submenu) != 0){
				$buf .= '<div id="jSubMenu'.$i.'" class="'.$sub_css.'">';
				for($j=0;$j<$DB->mbm_num_rows($r_submenu);$j++){
						$buf .= '<a href="';
						$buf .= mbmMenuLink($DB->mbm_result($r_submenu,$j,"id"),$DB->mbm_result($r_submenu,$j,"link"));
						$buf .= '">'.$DB->mbm_result($r_submenu,$j,"name").'</a>';
				}
				$buf .= '</div>';
			}
		}
	}
	return $buf;
}

?>