<div class="tab-pane active" id="home2"><?php
$date = date('Y-m-d h:i:s');
$result = $cms->db_query("select series_id,url,title,match_date,team1,team2 from #_matches where status='Active' and match_date > '$date' 
order by match_date asc  ");
$total_match = mysql_num_rows($result);
if($total_match){
	$i = 1;
	while($arrAdmin=$cms->db_fetch_array($result)){extract($arrAdmin);?>
		<table class="table table-bordered">
			<thead>
			  <tr><?php 
				$img1  = $cms->getSingleresult("select image from #_team where pid ='$team1'");
				$img2  = $cms->getSingleresult("select image from #_team where pid ='$team2'"); 
			    ?>
				<td id="blenk">
				<img width="56" height="54" src="<?=SITE_PATH?>/uploaded_files/orginal/<?=$img1?>">
				&nbsp;&nbsp;  <span>Vs</span>  &nbsp;&nbsp;
				<img width="56" height="54" src="<?=SITE_PATH?>/uploaded_files/orginal/<?=$img2?>"></td> 
				<td align="center"><?=$title?> <br/><?=$match_date?> GMT </td>
				  <td align="center"> <?=$match_date?> GMT </td> 
				  <td align="center"> 
				  <input type="hidden" id="countdown<?=$i?>" value="<?=date("Y/m/d h:i:s", strtotime($match_date))?>" />
				  <span id="time_<?=$i?>"></span><br/>
				  <a href="<?=SITE_PATH?>predict/<?=$url?>" 
				  style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; 
				  margin-top: 16px; float: left;">Predict</a></td>
			  </tr>
			</thead>
  		</table>
	
	<?php	$i++;
	}
}?>
				
				
  
   
</div>
