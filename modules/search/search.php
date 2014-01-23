<?

echo mbmShowSearchResult($_GET['q']);

/*
	$q_search = "SELECT * FROM ".PREFIX."menu_contents WHERE MATCH(title,content_short,content_more,tag) AGAINST('".$_GET['q']."')";
	$r_search = $DB->mbm_query($q_search);
	echo $DB->mbm_num_rows($r_search).' :: '.$r_search.' :: <strong>'.$q_search.'</strong>';
	
	echo '<h2>Search ['.$DB->mbm_num_rows($r_search).']</h2>';
	
	echo mbmShowContentShort_($q_search);

	for($i=0;$i<$DB->mbm_num_rows($r_search);$i++){
		$buf_search .= '<strong>'.($i+1).'.</strong> ';
		$buf_search .= $DB->mbm_result($r_search,$i,"title"); 
		$buf_search .= '<br />';
	}
		$buf_search .= '<br />';
	echo $buf_search;
	
*/
?>