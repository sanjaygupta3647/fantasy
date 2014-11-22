<?php defined('_JEXEC') or die('Restricted access'); 
 if($cms->is_post_back()){ 
	$check = $cms->getSingleresult("select count(*) from #_batting where match_id='".$match_id."' and team_id = '$team_id'");
	if($check){
		$cms->db_query("delete from #_batting where match_id='".$match_id."' and team_id = '$team_id' ");
	}
	foreach($_POST[player_id] as $key=>$val){
		if($val){
			$arrbatting = array();  
			$arrbatting[player_id] 		= $val;
			$arrbatting[team_id] 		= $team_id;
			$arrbatting[status] 	= $_POST[status][$key];
			$arrbatting[runs] 	= $_POST[run][$key];
			$arrbatting[ball] 	= $_POST[ball][$key];
			$arrbatting[fours] 	= $_POST[fours][$key];
			$arrbatting[six] 	= $_POST[six][$key];
			$arrbatting[match_id] 		= $match_id;  
			$cms->sqlquery("rs","batting",$arrbatting);
			$updateid = mysql_insert_id();
			$adm->sessset('Record has been added', 's'); 
		} 
	} 
	$path = SITE_PATH_ADM.CPAGE."?match_id=".$match_id."&team_id=".$team_id;
	$cms->redir($path, true);
} 
?> 
	 
	<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
	  	<tr style="font-size: 18px;color: gray;"> 
			<?php $teamName = $cms->getSingleresult("select name from #_team where pid='".$team_id ."'");?>
			<td colspan="6"  class="label">Batting Team: <?=$teamName?>(<?=$cms->getSingleresult("select title from #_matches where pid = '$match_id'")?>)</td>
		</tr>
		<tr style="font-size: 15px;color: aliceblue;font-family: inherit;">
			<th width="25%" class="heading">Batsmen Name:</th>
			<th width="25%" class="heading">Status:</th>
			<th width="13%" class="heading">Run:</th>
			<th width="13%" class="heading">Ball:</th>
			<th width="12%" class="heading">4's:</th>
			<th width="12%" class="heading">6's:</th>
			 
	</table>
	<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
	<?php  $team = $team_id;
		$qr = $cms->db_query("SELECT * FROM #_player WHERE teamId='".$team."' ORDER BY playerName limit 11 ");
		$i = 0;
		while($playerArr = $cms->db_fetch_array($qr)) {
		$status = ''; $runs = ''; $ball = ''; $fours = ''; $six = '';$player_id = '';
		$bat = $cms->db_query("SELECT * FROM #_batting WHERE match_id='".$match_id."' and team_id='".$team_id."' ORDER BY pid asc limit $i, 1 ");
		$i++;
		if(mysql_num_rows($bat)){
			$r = $cms->db_fetch_array($bat); extract($r);
		} 
	?>
	<tr>
		
		<td width="25%"  class="label"> 
			<select name="player_id[]" class="txt medium" style="margin-left: 24px;width: 85%;">
			<option value="">
					Select
				</option>
			<?php
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE teamId='".$team."' ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){
			?>	 
				<option <?=($arrPlayer[pid]==$player_id)?'selected="selected"':''?> <?=$arrPlayer[pid]?> value="<?=$arrPlayer[pid]?>">
					<?=$arrPlayer[playerName]?>
				</option>
			<?php }	?>	 
			</select>
		</td>
		<td>
			<select class="txt medium" name="status[]" title="Status" style=" width: 20%;margin-left: 62px;">
				<option value="Still to Bat" <?=($status=='Still to Bat')?'selected="selected"':''?> >Still to Bat</option>
				<option value="Not Out" <?=($status=='Not Out')?'selected="selected"':''?>>Not Out</option>
				<option value="Out" <?=($status=='Out')?'selected="selected"':''?> >Out</option>
				<option value="Retired Hurt" <?=($status=='Retired Hurt')?'selected="selected"':''?>>Retired Hurt</option>
			</select>	
			<input type="text" name="run[]" title="Run" class="txt medium" value="<?=$runs?>" style="width: 10%;margin-left: 84px;text-align: center;">
			<input type="text" name="ball[]" title="Ball" class="txt medium" value="<?=$ball?>" style="width: 10%;margin-left: 51px;text-align: center;">
			<input type="text" name="fours[]" title="4's" class="txt medium" value="<?=$fours?>" style="width: 10%;margin-left: 46px;text-align: center;">
			<input type="text" name="six[]" title="6's" class="txt medium" value="<?=$six?>" style="width: 10%;margin-left: 41px;text-align: center;">
		</td>
	</tr>
	 <?php } ?>
	 
   
	 
	<tr>
	   
	  <td colspan="6">
	  <input type="submit" name="Submit" class="uibutton  loading" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" />
	  </td>
    </tr>	
  </table>
 