<?php 
	@session_start(); 
	$qry=$_GET['q']; 
	 $items=explode("/",$qry); 
	if(count($items)!=0){
		if($items[(count($items)-1)]==""){
			array_pop($items);
		}
	} 
	set_time_limit (0);
	//@extract($_POST);
	//@extract($_GET);
	 @extract($_SERVER);
	//@extract($_SESSION); 
	@error_reporting(E_ALL ^ E_NOTICE); 
	ini_set('register_globals', 'on');	
	ini_set('memory_limit', '800M');
	ini_set(max_upload_filesize,"300M"); 
	if ($HTTP_HOST == "127.0.0.1" || $HTTP_HOST == "localhost") {
		define('LOCAL_MODE', true);
	} else {
		define('LOCAL_MODE', false);
	} 
 	$tmp = dirname(__FILE__);
	$tmp = str_replace('\\' ,'/',$tmp);
	$tmp = substr($tmp, 0, strrpos($tmp, '/'));
	define('SITE_FS_PATH', $tmp); 
	define('_JEXEC', $tmp);  
	require_once(SITE_FS_PATH."/lib/config.inc.php");
	require_once(SITE_FS_PATH."/lib/funcs_lib.inc.php");
	require_once(SITE_FS_PATH."/lib/funcs_extra.inc.php");
	require_once(SITE_FS_PATH."/lib/adminfunction.inc.php");
	require_once(SITE_FS_PATH."/lib/simplexlsx.class.php");
	require_once(SITE_FS_PATH."/lib/messages.php"); 
	$cms = new DAL(); //Class Start
	$cms_CUR = new DAL_CUR(); //Class Start
	$adm = new ADMIN_DAL(); //Class Start 
	if(strtolower($_SERVER['HTTPS'])=='on') {
		define('IN_SSL', true);
		define('HTTP_OR_HTTPS_PATH', SITE_SSL_PATH);
	} else {
		define('IN_SSL', false);
		define('HTTP_OR_HTTPS_PATH', SITE_WS_PATH);
	}
	define('SCRIPT_START_TIME', $cms->getmicrotime());
	if(get_magic_quotes_runtime()) {
		set_magic_quotes_runtime(0);
	}
	
	if(basename($_SERVER[PHP_SELF], ".php")=='index'){
		$tbl = 'index';	
	}else{
		$tbl = basename($_SERVER['REQUEST_URI'], ".html");		
	}
	$pageinfo = $cms->pageinfo($tbl);  
	$pagen = (($tbl)?$tbl:'index'); 
	define('SITE_MAIL', $cms->getSingleresult("select email from #_setting where `id`='1'"));
	define('SITE_PHONE', $cms->getSingleresult("select phone from #_setting where `id`='1'"));
	define('SITE_ADDR', $cms->getSingleresult("select address from #_setting where `id`='1'"));
	
	$month = array (1=>"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
 	$folder_array = explode("/", $_SERVER['REQUEST_URI']);
	define("CPAGE",$folder_array[sizeof($folder_array)-2]);
	$SITE_conts = $cms->db_query("select * from ".tb_Prefix."setting where id='1'");
	$SITE_CONTF = $cms->db_fetch_array($SITE_conts); 
?>