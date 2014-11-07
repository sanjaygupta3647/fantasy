<?php include("../../lib/opin.inc.php"); include("../inc/header.inc.php");?>
<div class="main">
 <!-- calender code -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script> 
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script> 

  <script>
    $(function() {
        $( "#startdate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
		 $( "#enddate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    });
  </script> 
  <!-- calender code -->
<header>
     
      <div class="hrd-right-wrap">
        <?php
		if(!$id && !$mode){
		 ?>
         <nav style="margin-top:10px;">
          <ul>
            <li style="margin:10px;">
			<input  placeholder="SERIES TITLE" list="browsers" type="text" id="title" name="title" value="<?=$_GET[title]?>">
			<?php  $namesq="select title from #_series group by title order by title";
					$namesqe=$cms->db_query($namesq);?>
					<datalist id="browsers"><?php 
					 while($na=$cms->db_fetch_array($namesqe)){  ?>
					<option value="<?=$na[title]?>">
                <?php }?></datalist>
			</li>
			<li style="margin:10px;">
			<input type="text" id="startdate" placeholder="START DATE" name="startdate" value="<?=$_GET[startdate]?>">
			</li>
			<li style="margin:10px;">
				<input type="text" placeholder="END DATE" id="enddate" name="enddate" value="<?=$_GET[enddate]?>">
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
<?php $hedtitle = "Series Manager"; ?>  
    <?=$adm->alert()?>
      <div class="title"  id="innertit">
       <?$adm->heading(((!$mode)?'Series Manager':'Add/Update Series'))?>
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
var title = $("#title").val();
var startdate =$("#startdate").val();
var enddate =$("#enddate").val(); 
var status =$("#status").val(); 
var ur = '?search=1'; 
if(title) ur +="&title="+trim(title); 
if(startdate) ur +="&startdate="+startdate; 
if(enddate) ur +="&enddate="+enddate; 
if(status) ur +="&status="+status;  
var red = "<?=SITE_PATH_ADM.CPAGE?>"+ur;
window.location = red; 
});
</script>
</body>
</html>
