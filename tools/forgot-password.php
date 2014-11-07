<?php include("../lib/opin.inc.php");

if($cms->is_post_back()){
	$rsCheck = $cms->db_query("select * from #_administrator where aemail='".trim($email)."' and astatus='Active'");
	if(mysql_num_rows($rsCheck)){
		$arrCheck = $cms->db_fetch_array($rsCheck);
		$msg='<p><b>Hello</b>,</p><p><a href="'.SITE_PATH_ADM.'login.php">click here</a> to login</p><p>Usernanme: '.$arrCheck[ausername].'</p><p>Password: '.$arrCheck[apassword].'</p><p>Thanks</p><p>RAS Team</p><p>&nbsp;</p><p>&nbsp;</p>';
		$cms->sendmail($arrCheck[aemail], "Forget password", $msg);
		$adm->sessset($msg[2], 's');
		$cms->redir(SITE_PATH_ADM."login.php");
		exit;
	}else{
		 $adm->sessset($msg[1], 'e');
		 $cms->redir(SITE_PATH_ADM."forgot-password.php");
		 exit;
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
<div id="header">
  <div class="header">
    <div class="logo"><img src="<?=SITE_PATH_ADM?>images/logo.png" <?=$cms->alt(SITE_TITLE)?> border="0" /></div>
  </div>
</div>
<div id="container">
  <div class="container">
    <h1>Forget password</h1>
    <?=$adm->alert()?>
    <div class="login">
      <div class="login-title"><img src="<?=SITE_PATH_ADM?>images/login-icon.png" width="19" height="19">Forgot Password ?</div>
      <form action="" method="post">
        <br />
        <div class="cl"></div>
        <span>Email Id : </span>
        <input name="email" id="password" type="text" class="txt"/>
        <div class="cl"></div>
        <span>&nbsp;</span>
        <input type="image" class="fl" width="71" height="27" src="<?=SITE_PATH_ADM?>images/reset-btn.png"  name="Submit" >
        <div class="cl"></div>
      </form>
    </div>
  </div>
</div>
<?php include("inc/footer.inc.php")?>