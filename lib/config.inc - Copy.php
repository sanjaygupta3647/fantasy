<?php
	if(!defined('LOCAL_MODE')) {
		die('<span style="font-family: tahoma, arial; font-size: 11px">config file cannot be included directly');
	}
	if (LOCAL_MODE) {
		$ARR_CFGS["db_host"] = 'localhost';
		$ARR_CFGS["db_name"] = 'cricket'; 
    	$ARR_CFGS["db_user"] = 'root';
		$ARR_CFGS["db_pass"] = '';
		define('SITE_SUB_PATH', '/cricket/');		
	} else { 
		$ARR_CFGS["db_host"] = 'localhost';
		$ARR_CFGS["db_name"] = 'cricw_match'; 
    	$ARR_CFGS["db_user"] = 'cricw_match';
		$ARR_CFGS["db_pass"] = 'demodemo2';
		define('SITE_SUB_PATH', '/');
	}
	
	$tmp = dirname(__FILE__);
	$tmp = str_replace('\\' ,'/',$tmp);
	$tmp = str_replace('/lib' ,'',$tmp);
	define('SITE_FS_PATH', $tmp);

	define('tb_Prefix', 'pro_');
	define('ADMIN_DIR', 'tools/'); 
	define('SITE_PATH', 'http://'.$HTTP_HOST.SITE_SUB_PATH); 
	define('SITE_PATH_ADM', 'http://'.$HTTP_HOST.SITE_SUB_PATH.ADMIN_DIR); 
	define('SITE_PATH_MEM', 'http://'.$HTTP_HOST.SITE_SUB_PATH.MEMBER_DIR); 
	
	define('THUMB_CACHE_DIR', 'thumb_cache');
	define('PLUGINS_DIR', 'lib/plugins');
	define('UP_FILES_FS_PATH', SITE_FS_PATH.'/uploaded_files');
	define('UP_FILES_FS_PATHPC', SITE_FS_PATH.'/uploads');
	define('UP_FILES_WS_PATH', SITE_WS_PATH.'/uploaded_files');

	define('SITE_NAME', 'Property');
	
	define('CUR', '&#x20AC;');
	define('SITE_TITLE', SITE_NAME.' Property');
	
	define('DEF_PAGE_SIZE', 25);
	define('FRO_PAGE_SIZE', 10);
	define('MAX_CATEGORY_SELECT', 2);
	define('MAX_HOME_PROPERTY', 8);
	$adminToolBar = array();
?>
