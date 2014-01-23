<?
if($mBm!=1 && $_SESSION['lev']==0){
	echo 'access denied';
}else{
	if(isset($_POST['submit']))
	{	
		if(isset($_POST['_action']))
			$action = $_POST['_action'];
		else
			$action = 0;
		
		$tmp= $_POST['cat_id'];
		$data['cat_id']= $_POST['cat_id'];

		$data['title']= $_POST['cnt_title'];
		
		if($_POST['show_title'] == 1)
			$data['show_title']= 1;
		else
			$data['show_title']= '0';
		
		if($_POST['show_short'] == 1)
			$data['show_content_short']= 1;
		else
			$data['show_content_short']= '0';
		
		if($_POST['use_comment'] == 1)
			$data['use_comments']= 1;
		else
			$data['use_comments']= '0';
		
		$data['content_more']= $_POST['content_more'];
		$data['user_id']= $_SESSION['user_id'];
		$data['blog_id']= $_SESSION['blg_id'];
		$data['date_added'] = mbmTime();
		
		if($action == 'add'){
			$data['date_lastupdated'] = $data['date_added'];
		}elseif($action == 'edit'){
			$data['date_lastupdated'] = mbmTime();
			$data['total_updated']= $DB->mbm_get_field($_POST['cat_id'], 'id','totsl_updated', 'blog_contents') + 1;		
		}
		
//		foreach($data as $k => $v)
//			echo $k.'->> '.$v.'<br>';
		
					
		if(mbmCheckEmptyfield($data)){
			echo $DB->mbm_show_error(15);
		}else{
			$data['content_short']= $_POST['content_short'];
			
				if($action == 'add'){
					echo '<div align="center"><A href="blog.php?module=blog&cmd=content_add&blog_id='.$blog_id.'&action=list&cat_id='.$_POST['cat_id'].'">'.$lang_blog['db_success'][$DB->mbm_insert_row($data, 'blog_contents')].'</a></div>';
				}elseif($action == 'edit'){
					echo '<div align="center"><A href="blog.php?module=blog&cmd=content_add&blog_id='.$blog_id.'&action=list&cat_id='.$_POST['cat_id'].'">'.$lang_blog['db_success'][$DB->mbm_update_row($data, 'blog_contents', $_POST['i_d'], 'id')].'</a></div>';
				}
		}
	}else{
		
		if(isset($_GET['action']))
			$action = $_GET['action'];
		else
			$action = 0;
		
		switch($action){	
			case 'add':
				mbmBlogContentAdd($blog_id);	
			break;
			case 'edit':
				mbmBlogContentEdit($blog_id, $_GET['id']);
			break;
			case 'list':
				if(isset($_GET['actions'])){
					switch($_GET['actions']){
					case 'cat_id':
						mbmUpdateDB($_GET['id'],$_GET['cat_id'],$_GET['tbl'], "cat_id");
					break;
					}
				}
				echo mbmBlogContentList($blog_id, $_GET['id'], $_GET['cat_id'], START, PER_PAGE);
			break;
			case 'delete':
				;
				echo '<div align="center">
				<a href="blog.php?module=blog&cmd=content_add&blog_id='.$blog_id.'&action=list&cat_id='.$_POST['cat_id'].'">'.$lang_blog['db_success'][mbmBlogDeleteContent($_GET["id"])].'</a></div>';
			break;
		}
}
}
?>
