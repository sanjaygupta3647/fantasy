<?php include("../lib/opin.inc.php")?>
<?php include("inc/header.inc.php")?>
<?php
if($cms->is_post_back()){
	$cms->sqlquery("rs","administrator",$_POST,'aid',$_SESSION["ses_adm_id"]);
	$adm->sessset('Record has been updated', 's');
	$cms->redir(SITE_PATH_ADM."admin-setting.php", true);
}
$rsAdmin=$cms->db_query("select * from #_administrator where `aid`='".$_SESSION["ses_adm_id"]."'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);
?>
<div id="container">
  <div class="container">
    <h1>Dashboard &rsaquo; Setting </h1>
    <div class="internal-box"><?=$adm->alert()?>
      <div class="title">
        <h2>Update profile</h2>
      </div>
      <div class="internal-data">
      <table width="98%" border="0" align="center" cellpadding="4" cellspacing="1" class="table-1 t2">
       <tr class="grey">
          <td width="18%" align="left" valign="middle" class="label">Username:</td>
          <td width="82%"><?=$ausername?></td>
        </tr>
		<tr  class="grey_">
      <td width="25%"  class="label">First name:<span>*</span></td>
      <td width="75%"><input type="text" name="afname" class="input"  lang="R" title="First name" value="<?=$afname?>" /></td>
    </tr>
	<tr>
      <td width="25%" class="label">Last name:<span>*</span></td>
      <td width="75%"><input class="input" type="text" name="alname"  lang="R" title="Last name" value="<?=$alname?>" /></td>
    </tr>
	<tr  class="grey_">
	  <td class="label">Email id:<span>*</span></td>
	  <td><input  class="input" type="text" name="aemail"  lang="RisEmail" title="Email id" value="<?=$aemail?>" /></td>
    </tr>
	<tr>
	  <td class="label">Password:<span>*</span></td>
	  <td><input class="input" type="password" name="apassword"  lang="R" title="Password" value="<?=base64_decode($apassword)?>" /></td>
    </tr>
	      <tr>
	        <td align="left" valign="middle">&nbsp;</td>
	        <td><input type="submit" name="Submit" class="button" value="Submit" /></td>
          </tr>
       </table>
      </div>
      <div class="internal-rnd-footer"></div>
    </div>
  </div>
</div>
</div>
<?php include("inc/footer.inc.php")?>