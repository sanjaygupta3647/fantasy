<?php 
if($reccnt>$pagesize){
	$num_pages=$reccnt/$pagesize;
	$qry_str=$_SERVER['argv'][0];
	
	$m=$_GET;
	unset($m['start']);
	
	$qry_str = $cms->qry_str($m);
	
	$j=$start/$pagesize-5;

	if($j<0) {
		$j=0;
	}
	$k=$j+10;
	if($k>$num_pages){
		$k=$num_pages;
	}
	$j=intval($j);
?>
<div class="pagination">
<div class="total">Showing <?=(($start)?$start:'1')?> of <?=$reccnt?></div>
<?php /*?><select class="select-txt" name="" onchange="location.href='<?=SITE_PATH_ADM."components/index.php?compp=".$comp."&qtag=pgn&totpaging="?>'+this.value+'';">
<option value="25" <?=(($_SESSION["totpaging"]==25)?' selected="selected"':'')?>>25</option>
<option value="50" <?=(($_SESSION["totpaging"]==50)?' selected="selected"':'')?>>50</option>
<option value="100" <?=(($_SESSION["totpaging"]==100)?' selected="selected"':'')?>>100</option>
<option value="All">All</option>
</select><?php */?>
<div class="paging">
	<?php if($start!=0){ ?>
	<a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>">&laquo; Previeous</a>
    <?php  } for($i=$j;$i<$k;$i++) {if(($pagesize*($i))!=$start){?>
    <a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$pagesize*($i)?>"><?=$i+1?></a>
    <?php  }  else {  ?>
  	<a href="javascript:void(0);" class="active"><?=$i+1?></a>
	<?php   } }?>
    <?php if($start+$pagesize < $reccnt){ ?>
    <a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>">Next&raquo; </a> 
    <?php } ?>
</div>
<div class="cl"></div>
</div>
<?php }?>