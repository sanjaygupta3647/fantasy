<?php include("../../lib/opin.inc.php")?>
 
<?php include("../inc/header.inc.php");?>
<div class="main">
<header>
     
      <div class="hrd-right-wrap">
        <?php
		if(!$id && !$mode){
		 ?>
         <nav style="margin-top:10px;">
          <ul>
            <li style="margin:10px;">
			<input  placeholder="MATCH TITLE" list="browsers" type="text" id="match" name="match" value="<?=$_GET[match]?>">
			<?php  $namesq="select title from #_matches  group by title  order by title";
					$namesqe=$cms->db_query($namesq);?>
					<datalist id="browsers"  ><?php 
					 while($na=$cms->db_fetch_array($namesqe)){  ?>
					<option value="<?=$na[title]?>">
                <?php }?></datalist>
			</li>

			
			<li style="margin:10px;">
			   <datalist id="series">
				  <select name="series">
					<?php  $namesq="select title from #_series group by title  order by title ";
					$namesqe=$cms->db_query($namesq); 
					 while($na=$cms->db_fetch_array($namesqe)){  ?>
					<option value="<?=$na[title]?>"><?=$na[title]?></option> 
                <?php }?> 
				  </select> 
				</datalist>
				  <input type="text" placeholder="SERIES NAME" value="<?=$_GET[series]?>"  id="seriess" name="series" list="series">

			 
			</li>


			 
			<li style="margin:10px;"> 
			<select  name="status" class="txt medium" id="status">
			  <option value="">----Select----</option> 		
			  <option value="Active" <?=($_GET[status]=='Active')?'selected="selected"':''?>>Active</option>  
			  <option value="Inactive" <?=($_GET[status]=='Inactive')?'selected="selected"':''?>>Inactive</option>  
			</select> 
			</li>
			<li style="margin:10px;"><input id="search"   type="button" name="search" value="search"></li>
          </ul>
        </nav> 
        <?php }?>
        
        <div class="brdcm" id="hed-tit"></div>
        <div class="unvrl-btn"> 
        <a href="<?=SITE_PATH_ADM.CPAGE.'/?mode=add'?>" class="ub">
        <img  src="<?=SITE_PATH_ADM?>images/add-new.png" alt=""></a>
         <?php if(!$_GET[mode]){?>
          <a href="javascript:void(0)"  onclick="javascript:submitions('Active');"class="ub">
        <img src="<?=SITE_PATH_ADM?>images/active.png" alt=""></a>
        <a href="javascript:void(0)" onClick="javascript:submitions('Inactive');" class="ub">
        <img src="<?=SITE_PATH_ADM?>images/inactive.png" alt=""></a>
        <a href="javascript:void(0)" class="ub"   onclick="javascript:submitions('delete');">
        <img src="<?=SITE_PATH_ADM?>images/delete.png" alt=""></a> <? }?>
       <?php if($_GET[mode]){?>
        <a href="javascript:void(0)" onclick="javascript:formback();" class="ub">
        <img src="<?=SITE_PATH_ADM?>images/back.png" alt=""></a><?php }?>
        
        </div> 
      </div>
      <div class="cl"></div>
    </header> 
<div class="content">
<div class="div-tbl">
<div class="cl"></div>
	<? //$adm->h1_tag('Dashboard &rsaquo; Email Alerts Manager',((!$mode)?$others:$others2))?>
<?php $hedtitle = "Match Manager"; ?>  
    <?=$adm->alert()?>
      <div class="title"  id="innertit">
       <?$adm->heading(((!$mode)?'Match Manager':'Add/Update Match'))?>
        </div>
      <div class="tbl-contant"><?php if($mode){include("add.php");}else{include("manage.php");}?></div>  
       <div class="cl"></div>
       <?php include("../inc/paging.inc.php")?>
    </div>
  </div> 
<?php include("../inc/footer.inc.php")?></div>
</div>
<div class="cl"></div>
</div>
</div>
<script type="text/javascript">
$("#search").click(function(){
var match = $("#match").val();
var series =$("#seriess").val();
 var status =$("#status").val(); 
var ur = '?search=1'; 
if(match) ur +="&match="+trim(match); 
if(series) ur +="&series="+series; 
if(status) ur +="&status="+status;  
var red = "<?=SITE_PATH_ADM.CPAGE?>"+ur;
window.location = red; 
});
</script>
</body>
</html>
