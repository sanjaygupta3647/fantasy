<?php 
if($reccnt>$pagesize){
$num_pages=$reccnt/$pagesize;
$qry_str=$_SERVER['argv'][0];

$m=$_GET;
unset($m['start']);

$qry_str = $cms->qry_str($m);

//echo "$qry_str : $p<br>";

//$j=abs($num_pages/10)-1;
$j=$start/$pagesize-5;
//echo("<br>$j");
if($j<0) {
	$j=0;
}
$k=$j+10;
if($k>$num_pages)	{
	$k=$num_pages;
}
$j=intval($j);
?>
 
<div class="data-footer">
	<div class="data-footer-right">
	<?php if($start!=0){ ?>
    <a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>">&laquo;Previous</a>
    <?php  } for($i=$j;$i<$k;$i++) {if(($pagesize*($i))!=$start){?>
    <a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$pagesize*($i)?>" class="link"><?=$i+1?></a>
    <?php  }  else {  ?>
  	 <a href="javascriot:void(0);" class="link"><?=$i+1?></a>
	<?php   } }?>
    <?php if($start+$pagesize < $reccnt){ ?>
    <a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>">Next&raquo; </a> </div>
    <?php } ?>
    </div>
</div>
<?php }?>