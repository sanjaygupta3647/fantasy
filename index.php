<?php 
	require_once "lib/opin.inc.php"; 
	if(strpos($_GET[q],'ms_box')!==false ){
		$isbox=1;
		include_once("inc/ms_box.php");
		die;
	}
	if(strpos($_GET[q],'ms_file')!==false ){
		include_once("inc/ms_file.php");
		die;
	} 	
	require_once "inc/frame.php";	 
	die();

?>