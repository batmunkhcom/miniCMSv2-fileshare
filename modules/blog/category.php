<?		
if($mBm!=1 && $_SESSION['lev']==0){
	echo 'access denied';
}else{
	if(isset($_POST['submit']) && $action != 'list')
	{	
		if(isset($_POST['_action']))
			$action = $_POST['_action'];
		else
			$action = 0;
		  
		$tmp= $_POST['cat_id'];
		//$data['cat_id']= $_POST['cat_id'];
		
		if($_POST['cat_id'] == 0){
			$data['sub']= '0';
		}else{
			$data['sub']= $DB->mbm_get_field($_POST['cat_id'], 'id','sub', 'blog_cats') + 1;
		}
		
		$data['st']= $_POST['cat_status'];
		
		$data['target']= $_POST['cat_target'];
		$data['title']= $_POST['cat_name'];
		$data['comment']=$_POST['cat_comment'];
		$data['verify_comment']=$_POST['cat_verify'];
		$data['user_id']= $_SESSION['user_id'];
		$data['blog_id']= $_POST['blg_id'];

		$data['date_added'] = mbmTime();
		
		if($action == 'add'){
			$q = "SELECT * FROM ".PREFIX."blog_cats WHERE cat_id='".$_POST['cat_id']."' ORDER BY pos";
			$r = $DB->mbm_query($q);
			$data['pos']= $DB->mbm_num_rows($r) + 1;
			$data['date_lastupdated'] = $data['date_added'];
		}elseif($action == 'edit'){
			$data['date_lastupdated'] = mbmTime();
			$data['total_updated']= $DB->mbm_get_field($_POST['cat_id'], 'id','totsl_updated', 'blog_cats') + 1;		
		}

//		foreach($data as $k => $v)
//			echo $k.'-'.$v.'<br>';		

		if(mbmCheckEmptyfield($data)){
			echo $DB->mbm_show_error(15);
		}else{
			if(mbmCheckLink($_POST['cat_link'])){
				if(isset($_POST['linked'])){
					$data['link']= $_POST['cat_link'];
				}else { $data['link']= 'http://'; }
				
				if($action == 'add'){
					echo '<div align="center"><A href="blog.php?module=blog&cmd=category&blog_id='.$blog_id.'&action=list&cat_id='.$_POST['cat_id'].'">'.$lang_blog['db_success'][$DB->mbm_insert_row($data, 'blog_cats')].'</a></div>';
				}elseif($action == 'edit'){
					echo '<div align="center"><A href="blog.php?module=blog&cmd=category&blog_id='.$blog_id.'&action=list&cat_id='.$_POST['cat_id'].'">'.$DB->mbm_update_row($data, 'blog_cats', $_POST['i_d'], 'id').'</a></div>';
				}
			}else{
				echo '<a href="blog.php?module=blog&cmd=category&blog_id='.$blog_id.'&action=add>link is typed incorrectly...</a>';
			}
		}
	}else{
	
		if(isset($_GET['action']))
			$action = $_GET['action'];
		else
			$action = 0;
		
		switch($action){	
			case 'add':
				echo mbmBlogCategoryAdd($blog_id);	
			break;
			case 'edit':
				echo mbmBlogCategoryEdit($blog_id, $_GET['id']);
			break;
			case 'list':
				if(isset($_GET['actions'])){
					switch($_GET['actions']){
					case 'pos':
						mbmUpdateDB($_GET['id'],$_GET['pos'],$_GET['tbl'], "pos");
						if($_GET['tbl'] == 'blog_cats'){
							mbmResetPos("cat_id",$DB->mbm_get_field($_GET['id'],"id","cat_id","blog_cats"),"blog_cats");
						}
					break;
					case 'st':
					mbmUpdateDB($_GET['id'],$_GET['st'],$_GET['tbl'], "st");
					break;
					case 'target':
						mbmUpdateDB($_GET['id'],$_GET['target'],$_GET['tbl'], "target");
					break;
					}
				}
				echo mbmBlogCategoryList($blog_id, $_GET['cat_id'], START, PER_PAGE);
			break;
			case 'delete':
				echo '<div align="center">
				<a href="blog.php?module=blog&cmd=category&blog_id='.$blog_id.'&action=list&cat_id='.$_POST['cat_id'].'">'.$lang_blog['db_success'][mbmBlogDeleteCategory($_GET['id'])].'</a></div>';
				mbmBlogResetPos($_GET['id'], $_GET['cat_id'], "blog_cats");
			break;
		}
	}
}
?>
