<?php  
	putenv("TZ=Asia/Calcutta");	 
 	if(count($items) >= 1)
	{		
		$page = $items[0].".php";
	} 
	if($items[0]!="" && file_exists("site/".$page)){
		$loadpage=$page;
	}else{		
		$loadpage="index.php";
		
	}
	$loadpage="site/".$loadpage; 

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>%%title%%</title>
<base href="<?=SITE_PATH?>">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<meta name="DC.title" content="%%title%%" />
<meta name="DC.creator" content="Fizzkart CDI" />
<meta name="DC.subject" content="Meta-data" />
<meta name="DC.description" content="%%description%%" />
<meta name="DC.publisher" content="Fizzkart CDI" />
<meta name="DC.contributor" content="Fizzkart CDI" />
<meta name="DC.date" content="%%datetime%%" scheme="DCTERMS.W3CDTF" />
<meta name="DC.type" content="Text" scheme="DCTERMS.DCMIType" />
<meta name="DC.format" content="text/html" scheme="DCTERMS.IMT" />
<meta name="DC.identifier" content="%%uri%%" scheme="DCTERMS.URI" />
<meta name="DC.source" content="http://www.w3.org/TR/html401/struct/global.html#h-7.4.4" scheme="DCTERMS.URI" />
<meta name="DC.language" content="%%lang%%" scheme="DCTERMS.RFC3066" />
<meta name="DC.relation" content="http://dublincore.org/" scheme="DCTERMS.URI" />
<meta name="DC.coverage" content="Fizzkart CDI" scheme="DCTERMS.TGN" />
<meta name="DC.rights" content="All rights reserved" />
<meta name="author" content="Fizzkart CDI" />
<meta name="keywords" content="%%keywords%%" />
<meta name="description" content="%%description%%" /> 
<?php  include_once "common_css.php"; ?>
</head> 

<div id="preloader">
    <div id="status">&nbsp;</div>
</div> 
<body>
<div id="sb-site">
	<div class="boxed">
	     <?php
		 if($_SESSION['pid']){
			 $arrCheck = $cms->db_query("SELECT * FROM #_user WHERE pid = '".$_SESSION['pid']."' AND userName = '".$_SESSION['userName']."'");
			 $udetl = $cms->db_fetch_array($arrCheck);
		 } ?>
		<?php include "header.php"; ?> 
		<?php include_once $loadpage; ?>  
		<?php include "footer.php"; ?>  
	</div> 
</div>  
<div id="back-top">
    <a href="#header"><i class="fa fa-chevron-up"></i></a>
</div>
<?php include_once "common_js.php"; ?> 
</body> 
</html>
<?php 
	//---- this script to parse all content and parse to replace keys  
	$templateContent = ob_get_contents();
	ob_end_clean();
	$templateContent = str_replace("%%title%%",$metaTitle,$templateContent);
	if($items[0]=="detail" || $items[0]=="event" || $items[0]=="article" || $items[0]=="page" || $items[0]=="partner_detail"){
		$templateContent = str_replace("%%pagetitle%%",$metaTitle . " - ",$templateContent);
	}else{
		$templateContent = str_replace("%%pagetitle%%","",$templateContent);
	}
	$templateContent = str_replace("%%description%%",$metaIntro,$templateContent);
	$metaDate=str_replace(' ','TO',$metaDate) . '+00:00';
	$templateContent = str_replace("%%datetime%%",$metaDate,$templateContent);
	$metaURI="http://www." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$templateContent = str_replace("%%uri%%",$metaURI,$templateContent);
	$templateContent = str_replace("%%lang%%",$_SESSION['lang'],$templateContent);
	$templateContent = str_replace("%%keywords%%",$metaKeyword,$templateContent);
	echo $templateContent;
	 
?>
