<?php
if(!$_SESSION["ses_adm_id"]){$cms->redir(SITE_PATH_ADM."login");die;}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=">
<title>Admin Area</title>
<link rel="stylesheet" href="<?=SITE_PATH_ADM?>css/style.css" type="text/css">
<!--[if IE]> <script type="text/javascript" src="js/html5.js"></script><![endif]-->
<!--[if lte IE 7]><script defer type="text/javascript" src="js/pngfix.js"></script><![endif]--> 
<script language="javascript" src="<?=SITE_PATH_ADM?>js/validate.js"></script>
<script type="text/javascript" src="<?=SITE_PATH?>js/jquery-1.4.4.min.js" ></script> 
<script type="text/javascript" src="<?=SITE_PATH_ADM?>js/jquery.popupWindow.js.js" ></script> 
<script type="text/javascript" src="<?=SITE_PATH?>lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=SITE_PATH?>lib/ckfinder/ckfinder.js"></script>
<!-- for color picker-->
<link href="<?=SITE_PATH_ADM?>js/syronex-colorpicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=SITE_PATH_ADM?>js/syronex-colorpicker.js"></script>
<!-- for color picker--> 
<script src="<?=SITE_PATH_ADM?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="<?=SITE_PATH_ADM?>SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="<?=SITE_PATH_ADM?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css"> 
<link href="<?=SITE_PATH_ADM?>SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css">
<?php include(SITE_FS_PATH.'/'.ADMIN_DIR."js/calc.php")?>
</head> 
<body>

<?=$cms->sform((($mode)?'onsubmit="return formvalid(this)"':'onsubmit="return formvalid(this)"'));?>
<div class="wrap wrap2">
  <div class="admin-bar">
    <div class="logout"> <a href="<?=SITE_PATH_ADM?>logout.php">Logout</a> </div>
 <span id="big-nav">   
     <?php if($_SESSION["ses_adm_type"]=='su' or $_SESSION["ses_adm_type"]=='admin'){?>
	<ul class="nav admin-settings" id="nav">
      <li > <a href="" class="st"  ><img src="<?=SITE_PATH_ADM?>images/admin.png"   class="gear" alt="" width="18" height="18" /></a>
        <ul>
          <li> <a href="<?=SITE_PATH_ADM?>setting.php?mode=true">My Profile</a> </li>
        <!--  <li> <a href="<?=SITE_PATH_ADM?>setting.php?mode=true">Administrator settings</a> </li>-->
          <li> <a href="<?=SITE_PATH_ADM?>adm">User Settings</a> </li>
        </ul>
      </li>
    </ul>
	<?php }?>
    <div class="welcome"> </div></span>
     
     <div class="logo" > <a href="#" style="color:#FFFFFF; font-size:16px;">Welcome to <?=$_SESSION["ses_adm_usr"]?></a></div>
    
  </div>
  <div class="aside">
    <ul class="nav2"> 
       
     
 	 
      <li><a href="#">Series Management</a>
        <div class="ul-arrow">
          <ul> 
             <li><a href="<?=SITE_PATH_ADM?>series/?mode=add">Add Series</a></li>
            <li><a href="<?=SITE_PATH_ADM?>series/">Manage Series</a></li> 
          </ul>
        </div> 
	  </li>
	   <li><a href="#">Match Management</a>
        <div class="ul-arrow">
          <ul> 
             <li><a href="<?=SITE_PATH_ADM?>match/?mode=add">Add Match</a></li>
            <li><a href="<?=SITE_PATH_ADM?>match/">Manage Match</a></li> 
          </ul>
        </div> 
	  </li>
		<li><a href="#">Team Management</a>
        <div class="ul-arrow">
          <ul>
           
             <li><a href="<?=SITE_PATH_ADM?>team/?mode=add">Add Team</a></li>
            <li><a href="<?=SITE_PATH_ADM?>team/">Manage Team</a></li> 
          </ul>
        </div> </li>
		<li><a href="#">Player Management</a>
        <div class="ul-arrow">
          <ul>
           
             <li><a href="<?=SITE_PATH_ADM?>player/?mode=add">Add Player</a></li>
            <li><a href="<?=SITE_PATH_ADM?>player/">Manage Player</a></li> 
          </ul>
        </div> </li>
		<li><a href="#">Prediction Management</a>
        <div class="ul-arrow">
          <ul>
           
             <li><a href="<?=SITE_PATH_ADM?>prediction/?mode=add">Add Prediction</a></li>
            <li><a href="<?=SITE_PATH_ADM?>prediction/">Manage Prediction</a></li> 
          </ul>
        </div> </li>
		 <li><a href="#">News Management</a>
        <div class="ul-arrow">
          <ul>
           
             <li><a href="<?=SITE_PATH_ADM?>news/?mode=add">Add News</a></li>
            <li><a href="<?=SITE_PATH_ADM?>news/">Manage News</a></li> 
          </ul>
        </div> </li>
		 
    </ul>
</div>
<div class="cl"></div>