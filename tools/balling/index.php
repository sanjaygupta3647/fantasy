<?php include("../../lib/opin.inc.php")?> 
<?php include("../inc/header.inc.php");?>
<div class="main">
<header>
     
  <div class="hrd-right-wrap"> 
	<div class="brdcm" id="hed-tit"></div>
	<div class="unvrl-btn">  
	<a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
	<img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a> 
	
	</div> 
  </div>
  <div class="cl"></div>
</header> 
<div class="content">
<div class="div-tbl">
<div class="cl"></div>
	<? //$adm->h1_tag('Dashboard &rsaquo; Email Alerts Manager',((!$mode)?$others:$others2))?>
<?php $hedtitle = "Match Summary Manager"; ?>  
    <?=$adm->alert()?>
      <div class="title"  id="innertit">
       <?$adm->heading(((!$mode)?'Match Summary Manager':'Add/Update Team'))?>
        </div>
      <div class="tbl-contant"><?php include("add.php"); ?></div>  
       <div class="cl"></div>
       <?php include("../inc/paging.inc.php")?>
    </div>
  </div> 
<?php include("../inc/footer.inc.php")?></div>
</div>
<div class="cl"></div>
</div>
</div>

</body>
</html>
