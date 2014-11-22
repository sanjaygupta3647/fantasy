<?php  
$rsCheck = $cms->db_query("select * from #_pages where url = '".$items[1]."'");
if(mysql_num_rows($rsCheck)){
	$rs=$cms->db_fetch_array($rsCheck); extract($rs);
}
$metaTitle = $meta_title;
$metaIntro = $meta_description;
$metaKeyword = $meta_keyword;
?>
<div class="container">
<div class="row" style="margin-top: 40px;">

<div class="col-md-12">
            <h2 class="right-line"><?=$title?></h2>
            <?=$body?>
        </div>



</div>






</div>