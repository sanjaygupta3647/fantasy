<?php include("../../lib/opin.inc.php")?>
<?php define("CPAGE","gallery/")?>
<?php include("../inc/header.inc.php");?>
 
<div class="main">
<? include "../inc/header2.php"; ?>
<div class="content">
<div class="div-tbl">
<div class="cl"></div>
	<? //$adm->h1_tag('Dashboard &rsaquo; Email Alerts Manager',((!$mode)?$others:$others2))?>
<?php $hedtitle = "Page Management"; ?>  
    <?=$adm->alert()?>
      <div class="title" id="innertit"> 
           
        </div>
      <div class="tbl-contant" ><?php if($mode){include("add.php");}else{include("manage.php");}?></div>
       <div class="cl"></div>
    </div>
  </div> 
<?php include("../inc/footer.inc.php")?></div>
</div>
<div class="cl"></div>
</div>
</div>

 
</body>
</html>
