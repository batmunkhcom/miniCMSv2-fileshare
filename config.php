<?
$config['domain'] = "http://share.domain.com/";
$config['abs_dir'] = "/home/username/share.domain.com/";
$config['dir'] = "";
$config['include_dir'] = "core/"; //relative to abs_dir
$config['include_domain'] = "http://share.domain.com/core/"; //library domain

$config['time_zone'] = 0;
$config['exclude_domain_stat'] = 'share.domain.com'; //stat module-d referer deer algasah domain. WWW gui bichne.


$config['db_host'] = "localhost";
$config['db_name'] = "DBNAME";
$config['db_user'] = "DBUSER";//.rand(1,26);
$config['db_pass'] = "DBPASS";
$config['db_prefix'] = "mbm_";
$config['db_type'] = "mysql";

$config_user['db_host'] = "localhost";
$config_user['db_name'] = "DBNAME";
$config_user['db_user'] = "DBUSER";
$config_user['db_pass'] = "DBPASS";
$config_user['db_prefix'] = "mbm2_";
$config_user['db_type'] = "mysql";

//twitter info
$config['TWITTER_USERNAME'] = "TWITTERUSERNAME";
$config['TWITTER_PASSWORD'] = "";

$config['user_db_prefix'] = $config_user['db_prefix'];

$config['session_db_host'] = "localhost";
$config['session_db_name'] = "DBNAME";
$config['session_db_user'] = "DBUSER";//.$rand_db_user_core;
$config['session_db_pass'] = "DBPASS";
$config['session_db_prefix'] = "mbm_";
$config['session_db_type'] = "mysql";
$config['session_db_table'] = "sessions";
	
$config['cache_dir'] = $config['abs_dir']."cache/";
$config['video_dir'] = "files/videos/"; //video news video storage folder.
$config['photo_dir'] = "files/photos/"; //photo news photo storage folder
$config['gallery_dir'] = "files/galleries/"; //photo gallery photo storage folder
$config['product_dir'] = "files/products/"; //shopping products storage folder
$config['default_lang'] = "mn";
$config['levels'] = 9;
$config['hits_by'] = 1;
$config['currency']='MNT';

//grabber settings start
	$config["grabber_module_dir"] = $config['abs_dir']."modules/grabber";
	
	// Write the path of curl installation
	// example: '/usr/local/bin/curl' (linux)
	$config["grabber_curl_path"] = "/usr/local/bin/curl";
	
	// NOTE: make sure that the 'tmp' folder have write permission.
	
	$config["grabber_error_msg"] =  "<br />Холболт амжилтгүй боллоо";
	$config["grabber_cookie_file"] = $config["grabber_module_dir"]."/cookie.txt";
//grabber settings end

$config['cookie_name'] = 'FILEusername';
$config['cookie_domain'] = 'share.domain.com';
$user_level_types =  array(	
							0=>'Guest',
							1=>'Member',
							2=>'Mod member',
							3=>'Super member',
							4=>'Administrator',
							5=>'Super administrator');
$image_types = array(
						1=>'gif',
						2=>'jpg',
						3=>'png',
						4=>'swf',
						5=>'psd',
						6=>'bmp',
						7=>'tiff1',
						8=>'tiff2',
						9=>'jpc',
						10=>'jp2',
						11=>'jpx',
						12=>'jb2',
						13=>'swc',
						14=>'iff',
						15=>'wbmp',
						16=>'xbm');
$modules_active = array(
						//"blog",
						"fileshare",
						"forum",
						"poll",
						//"zurkhai",
						"users",
						"search",
						//"auto",
						"menu",
						"shopping",
						//"cache",
						"music",
						"video",
						"banner",
						"stats",
						"dic",
						"web",
						"faqs",
						"photogallery",
						"phazeddl",
						"shoutbox",
						"ratings",
						"comments");
$modules_permissions = array(
							//"blog"=>3,
							"fileshare"=>3,
							"forum"=>3,
							"poll"=>3,
							"zurkhai"=>3,
							"users"=>5,
							"search"=>3,
							"auto"=>5,
							"menu"=>3,
							"shopping"=>4,
							"cache"=>5,
							"music"=>3,
							"video"=>3,
							"banner"=>4,
							"stats"=>0,
							"dic"=>0,
							"web"=>0,
							"faqs"=>0,
							"photogallery"=>0,
							"phazeddl"=>0,
							"shoutbox"=>0,
							"ratings"=>0,
							"comments"=>3,
							"settings"=>5);
foreach($config as $k=>$v){
	define(strtoupper($k),$v);
}






$ftp_config['server'] = 'share.domain.com';
$ftp_config['username'] = 'FTPUSER';
$ftp_config['password'] = 'FTPPASS';
$ftp_config['web_root'] = '/';
$ftp_config['upload_dir'] = 'upload/'; //relative to ftp


$config_fileshare['storage_dir']='upload';


//MB aar
$config_fileshare['upload_max_size'][0]=100;
$config_fileshare['upload_max_size'][1]=200;
$config_fileshare['upload_max_size'][2]=1000;
$config_fileshare['upload_max_size'][3]=2000;
$config_fileshare['upload_max_size'][4]=3000;
$config_fileshare['upload_max_size'][5]=5000;

//name
$config_fileshare['service_name'][0]= 'Free';
$config_fileshare['service_name'][1]= 'Package 1';
$config_fileshare['service_name'][2]= 'Package 2';
$config_fileshare['service_name'][3]= 'Package 3';
$config_fileshare['service_name'][4]= 'Package 4';
$config_fileshare['service_name'][5]= 'Package 5';

$config_fileshare['days_to_save'][0]=7;
$config_fileshare['days_to_save'][1]=30;
$config_fileshare['days_to_save'][2]=60;
$config_fileshare['days_to_save'][3]=90;
$config_fileshare['days_to_save'][4]=180;
$config_fileshare['days_to_save'][5]=365;

$config_fileshare['dl_limit'][0]=102400;
$config_fileshare['dl_limit'][1]=102400;
$config_fileshare['dl_limit'][2]=102400;
$config_fileshare['dl_limit'][3]=102400;
$config_fileshare['dl_limit'][4]=102400;
$config_fileshare['dl_limit'][5]=102400;



// 2 dahi file tatahad huleeh hugatsaa. secundeerв hamgiin bagadaa 10 - 15 sec bval iluu tohiromjtoi

$config_fileshare['next_file_dl_limit'][0]=120;
$config_fileshare['next_file_dl_limit'][1]=10;
$config_fileshare['next_file_dl_limit'][2]=5;
$config_fileshare['next_file_dl_limit'][3]=4;
$config_fileshare['next_file_dl_limit'][4]=3;
$config_fileshare['next_file_dl_limit'][5]=2;



// timer yavah hugatsaa. millisecundeer. 1 sec = 1000

$config_fileshare['dl_timer'] = 1000;

?>