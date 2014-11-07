<?php include("../lib/opin.inc.php")?>
<?php 
if($cms->is_post_back()){
	$rsCheck = $cms->db_query("select aid, ausername, atype from #_administrator where ausername='".trim($ausername)."' and apassword='".base64_encode(trim($apassword))."' and astatus='Active'");
	if(mysql_num_rows($rsCheck)){
		$arrCheck = $cms->db_fetch_array($rsCheck);
		$_SESSION["ses_adm_id"] = $arrCheck["aid"];
		$_SESSION["ses_adm_usr"] = $arrCheck["ausername"];
		$_SESSION["ses_adm_type"] = $arrCheck["atype"];
		$cms->redir(SITE_PATH_ADM."index.php");
		exit;
	}else{
		 $adm->sessset($msg[0], 'e');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="<?=SITE_PATH_ADM?>css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=SITE_PATH_ADM?>js/validate.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=SITE_TITLE?></title>
</head>
<body>
<div id="header">
  <div class="header">
    <div class="logo"><img src="<?=SITE_PATH?>images/logo.png" <?=$cms->alt(SITE_TITLE)?> border="0" height="40" /></div>
  </div>
</div>
<div id="container">
  <div class="container">
    <h1>Login</h1>
    <?=$adm->alert()?>
    <div class="login">
      <div class="login-title"><img src="<?=SITE_PATH_ADM?>images/login-icon.png" alt="" width="19" height="19">LOGIN</div>
      <form action="" method="post">
        <span>Username: </span>
        <input name="ausername" id="ausername" type="text" class="txt">
        <div class="cl"></div>
        <span>Password: </span>
        <input name="apassword" id="password" type="password" class="txt">
        <div class="cl"></div>
        <span>&nbsp;</span>
        <input type="image" class="fl" width="71" height="27" src="<?=SITE_PATH_ADM?>images/login-btn.png"  name="Submit" >
        <a href="<?=SITE_PATH_ADM?>forgot-password.php" class="forgot"> forgot password?</a>
        <div class="cl"></div>
      </form>
    </div>
  </div>
</div>
<?php include("inc/footer.inc.php")?>