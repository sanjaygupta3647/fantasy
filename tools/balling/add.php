<?php defined('_JEXEC') or die('Restricted access'); 
 if($cms->is_post_back()){  
	if(count($_POST[player_id])){
		$check = $cms->getSingleresult("select count(*) from #_balling where match_id='".$match_id."' and team_id = '$team_id'");
		if($check){
			$cms->db_query("delete from #_balling where match_id='".$match_id."' and team_id = '$team_id' ");
		}
		foreach($_POST[player_id] as $key=>$val){ 
			$arrBowler = array(); 
			//Bowler Table Team2
			$arrBowler[player_id] 				= $_POST[player_id][$key];
			$arrBowler[over] 			= $_POST[ovr][$key];
			$arrBowler[maiden] 		= $_POST[maidens][$key];
			$arrBowler[runs] 		= $_POST[runs][$key];
			$arrBowler[wicket] 		= $_POST[wickets][$key];
			$arrBowler[wides] 	= $_POST[wides][$key];
			$arrBowler[noballs] 	= $_POST[noballs][$key];
			$arrBowler[economy] 	= $_POST[economy][$key];
			$arrBowler[match_id] 				= $match_id;
			$arrBowler[team_id] 		= $team_id; 
			if($arrBowler[player_id] 	!= 0){
				$cms->sqlquery("rs","balling",$arrBowler);
				$adm->sessset('Record has been added', 's');
			} 
		}
	} 
	$path = SITE_PATH_ADM.CPAGE."?match_id=".$match_id."&team_id=".$team_id;
	$cms->redir($path, true);
}	
 
?>
 
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
  <tr style="font-size: 18px;color: gray;"> 
			<?php $teamName = $cms->getSingleresult("select name from #_team where pid='".$team_id ."'");?>
			<td colspan="6"  class="label">Balling Team: <?=$teamName?>(<?=$cms->getSingleresult("select title from #_matches where pid = '$match_id'")?>)</td>
		</tr>
		<tr style="font-size: 15px;color: aliceblue;font-family: inherit;">
			<th width="25%" class="heading">Bowler Name:</th>
			<th width="11%" class="heading">Over:</th>
			<th width="11%" class="heading">Maiden:</th>
			<th width="10%" class="heading">Run:</th>
			<th width="11%" class="heading">Wicket:</th>
			<th width="11%" class="heading">Wide Ball:</th>
			<th width="10%" class="heading">No Ball:</th>
			<th width="11%" class="heading">Economy Rate:</th>
		</tr>
	</table>
	<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">

     <input type="hidden" name="team2" value="<?=$arrMatches[team2]?>">
	  <?php 
	    $team = $team_id;
		$qr = $cms->db_query("SELECT * FROM #_player WHERE teamId='".$team."'  ORDER BY playerName ASC LIMIT 11");
		$i = 0;
		while($playerArr = $cms->db_fetch_array($qr)) {
			$over = ''; $maiden = ''; $runs = ''; $wicket = ''; $wides = ''; $noballs = ''; $wides = ''; $player_id = '';$economy = '';
			$bat = $cms->db_query("SELECT * FROM #_balling WHERE match_id='".$match_id."' and team_id='".$team_id."' ORDER BY pid asc limit $i, 1 ");
			$i++;
			if(mysql_num_rows($bat)){
				$r = $cms->db_fetch_array($bat); extract($r);
			}
			?>
		
	   <tr>
		
		<td width="25%"  class="label">   
			<select name="player_id[]" class="txt medium" style="margin-left: 7%;width: 85%;">
			<option value=""> Select </option><?php 
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE teamId='".$team."' ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){?> 
					<option <?=($arrPlayer[pid]==$player_id)?'selected="selected"':''?> value="<?=$arrPlayer[pid]?>"><?=$arrPlayer[playerName]?></option><?php }	?> 
			</select>
		</td>
		<td>
			<input type="text" name="ovr[]"  title="over" value="<?=$over?>" class="txt medium" style="width: 11%;text-align: center;"/>
			<input type="text" name="maidens[]"  title="maiden" class="txt medium" value="<?=$maiden?>" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="runs[]"  title="run" class="txt medium" value="<?=$runs?>" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="wickets[]"  title="wicket" class="txt medium" value="<?=$wicket?>" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="wides[]"  title="wide" class="txt medium" value="<?=$wides?>" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="noballs[]"  title="no" class="txt medium" value="<?=$noballs?>" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="economy[]"  title="economy rate" class="txt medium" value="<?=$economy?>" style="width: 11%;margin-left: 12px;text-align: center;"/>
		</td>
		
	</tr>
	 <?php }	?>	
	 	
  
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <input type="submit" name="Submit" class="uibutton  loading" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" /></td>
    </tr>	
  </table>
 