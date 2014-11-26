<div class="tab-pane active" id="home2"><?php

/*$result = $cms->db_query("select series_id,url,title,match_date,team1,team2 from #_matches where status='Active' and match_date > '$date' 
order by match_date asc  ");
$total_match = mysql_num_rows($result);*/


$date = date('Y-m-d H:i:s');
$Obj=new Paging("select pid,series_id,url,title,match_date,team1,team2 from pro_matches where status='Active' and match_date > '$date' 
order by match_date asc ");
$Obj->setLimit(10);//set record limit per page
$limit=$Obj->getLimit();
$offset=$Obj->getOffset($_REQUEST["page"]); 
 
$sql="select pid,series_id,url,title,match_date,team1,team2 from pro_matches where status='Active' and match_date > '$date' 
order by match_date asc   limit $offset, $limit";
$searchexe = $cms->db_query($sql);
$total_match21 = mysql_num_rows($searchexe);

if($total_match21){
	$i = 1;
	while($arrAdmin=$cms->db_fetch_array($searchexe)){extract($arrAdmin);?>
		<table class="table table-bordered">
			<thead>
			  <tr><?php 
				  $img1  = $cms->getSingleresult("select image from #_team where pid ='$team1'");
				  $img2  = $cms->getSingleresult("select image from #_team where pid ='$team2'"); 
			    ?>
				<td id="blenk" width="30%">
				<img width="56" height="54" src="uploaded_files/orginal/<?=$img1?>">
				&nbsp;&nbsp;  <span>Vs</span>  &nbsp;&nbsp;
				<img width="56" height="54" src="uploaded_files/orginal/<?=$img2?>"></td> 
				<td align="center" width="40%"><a href="<?=SITE_PATH?>predict/<?=$url?>/<?=$pid?>"><?=$title?></a> <br/><?=$match_date?> GMT </td>
				  <!--<td align="center"> <?=$match_date?> GMT </td> -->
				  <td align="center"> 
				  <input type="hidden" id="countdown<?=$i?>" value="<?=date("Y/m/d H:i:s", strtotime($match_date))?>" />
				  <span style="float: left;" id="time_<?=$i?>"></span> 
				  </td>
			  </tr>
			</thead>
  		</table>
	
	<?php	$i++;
	}
}?>
				
				
  
<div class="pag_no"><?php $Obj->getPageNo(); ?></div>   
</div>
