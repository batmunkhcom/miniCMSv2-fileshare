<?
if($mBm!=1 && $_SESSION['lev']==0){
	echo 'access denied';
}else{
	
	if(isset($_POST['loginButton'])){	
		
		$data['name']= $_POST['b_name'];
		$data['template']= $_POST['b_template'];
		
		if($_POST['actn'] == "add"){
			$data['date_added']= mbmTime();
			$DB->mbm_query("UPDATE ".USER_DB_PREFIX."users SET enable_blog='1' WHERE id=".$_SESSION['user_id']);
		}else{
			$data['date_lastupdated']= mbmTime();
			$data['total_updated']= $DB->mbm_get_field($_POST['i_d'], "id", "total_updated", "blog")+1;
		}
			
		$data['user_id']= $_SESSION['user_id'];
		$data['username']= $DB->mbm_get_field($_SESSION['user_id'], "id", "username", "users");;
						
		if($_POST['actn'] == 'add'){
			$data['date_lastupdated'] = $data['date_added'];
		}elseif($_POST['actn'] == 'edit'){
			$data['date_lastupdated'] = mbmTime();
			$data['total_updated']= $DB->mbm_get_field($_POST['cat_id'], 'id','totsl_updated', 'blog') + 1;		
		}
		
//		foreach($data as $k => $v)
//			echo $k.'->> '.$v.'<br>';
		
		if($_POST['actn'] == 'add'){
			$res= $DB->mbm_insert_row($data, 'blog');
			echo '<div align="center"><A href="blog.php?blog_id='.$DB->mbm_get_field($_SESSION['user_id'], 'user_id','id', 'blog').'">'.$lang_blog['db_success'][$res].'</a></div>';
		}elseif($_POST['actn'] == 'edit'){
			$res= $DB->mbm_update_row($data, 'blog', $_POST['i_d'], 'id');
			echo '<div align="center"><A href="blog.php?blog_id='.$DB->mbm_get_field($_SESSION['user_id'], 'user_id','id', 'blog').'">'.$lang_blog['db_success'][$res].'</a></div>';
		}
	}else{
		if(isset($_GET['act']) && $_GET['act'] == 'edit'){
			$q_cat = "SELECT * FROM ".PREFIX."blog WHERE ";
			if(isset($blog_id) && $blog_id !=0){
				$q_cat .= "id='".$blog_id."'";
			}else{
				$q_cat .= "id='0'";
			}
			$res = $DB->mbm_query($q_cat);
			$act1 = "edit";
		}else{
			$act1 = "add";
		}
	$buf = '
	<form name="form1" method="post" action="">
	  <table width="100%" border="0" cellspacing="0" cellpadding="3" class="loginTBL">
		<tr>
		  <td colspan="5" class="loginTitle">'.$lang_blog['blog']['create'].'</td>
		</tr>
		<tr>
		  <td width="80">'.$lang_blog['blog']['blog_name'].'</td>
		  <td width="200"><input type="text" size="20" name="b_name" id="b_name" class="input"';
	if($act1 == 'edit'){
		$buf .= " value=\"".$DB->mbm_result($res, 0, "name")."\"";
		$btn = $lang_blog['blog']['edit'];
	}else{
		$btn = $lang_blog['blog']['add'];
	}	  
	$buf .='></td>
		  <td width="100">'.$lang_blog['blog']['template'].'</td>
		  <td width="100">
		  <select name="b_template">
		  	<option value="naiznet">naiznet</option>
		  </select>
		  </td>
		  <td><input type="submit" name="loginButton" class="button" id="loginButton" value="'.$btn.'"></td>
		</tr>
		<input type="hidden" name="actn" value="'.$act1.'" >';
		if($act1 == 'edit'){
			$buf .= '<input type="hidden" name="i_d" value="'.$DB->mbm_result($res, 0, "id").'" >';
		}	  
	  $buf .= '</table>
	</form>
	';
	
	echo $buf;
	}
}
?>