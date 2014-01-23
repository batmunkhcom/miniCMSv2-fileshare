<?php
function shortURL($URL=''){
	$url = file_get_contents('http://l.az.mn/api.php?url='. urlencode($URL));
	return $url;
}
?>