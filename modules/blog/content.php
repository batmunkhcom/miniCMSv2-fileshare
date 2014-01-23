<?	
if($mBm!=1 && $_SESSION['lev']==0){
	echo 'access denied';
}else{	
	if(isset($_POST['submit_comment'])){
		$data['blog_content_id']= $_POST['i_d'];
		$data['user_id']= $_SESSION['user_id'] ;
		$data['st']= 1;
		$data['comment']= $_POST['addcomment'];
		$data['date_added']= mbmTime();
		$data['browser']=  $_SERVER['HTTP_USER_AGENT'];
		$data['ip']= getenv("REMOTE_ADDR");
		$data['name']= $DB->mbm_get_field($_SESSION['user_id'], "id", "username", "users");

		$totalcomment = $DB->mbm_get_field($_POST['i_d'], "id", "total_comments", "blog_contents");
		$DB->mbm_query("UPDATE ".PREFIX."blog_contents SET total_comments=".($totalcomment+1)." WHERE id=".$_POST['i_d']);

		$DB->mbm_insert_row($data, 'blog_comments');
		unset($_POST['submit_comment']);
	}
	
	$htmls_con[0]= '<table class="blog_content_outer" cellpadding="5" cellspacing="0" width="100%" border="0">';
	$htmls_con[1]= '</table>';

	$htmls_con[2]= '<tr><td class="blog_content_inner">';
	$htmls_con[3]= '</td></tr><tr><td height="10"></td></tr>';
	if(isset($_GET['id']) && isset($_GET['cat_id'])){	
		echo mbmBlogShowContentMore($blog_id, $htmls_con, $_GET['id']);
	}else{
		if(isset($_GET['archive']) && isset($_GET['archive'])){
			echo mbmBlogShowContentArchive($blog_id, $htmls_con, 0, START, PER_PAGE, $_GET['archive']);
		}elseif(isset($_GET['cat_id']) && !isset($_GET['id'])){
			echo mbmBlogShowContentShort($blog_id, $htmls_con, $_GET['cat_id'], START, PER_PAGE);
		}
	}
}
?>