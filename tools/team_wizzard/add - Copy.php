<?php defined('_JEXEC') or die('Restricted access');?>
<?php 
$series_id = $cms->getSingleresult("SELECT series_id FROM #_matches WHERE pid = '".$match_id."'");
if($cms->is_post_back()){ 
	if($updateid){
		$cms->sqlquery("rs","match_summary",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	} else { 
		$arrNew = array();
		$arrNew[toss] 						= $_POST[toss];
		$arrNew[men_of_the_match] 			= $_POST[men_of_the_match];
		$arrNew[total_run_team1] 			= $_POST[total_score_team1];
		$arrNew[total_run_team2] 			= $_POST[total_score_team2];
		$arrNew[run_in_first_over_team1] 	= $_POST[run_in_first_over1];
		$arrNew[total_wicket_team1] 		= $_POST[total_wicket_team1];
		$arrNew[total_wicket_team2] 		= $_POST[total_wicket_team2];
		$arrNew[run_in_first_over_team2] 	= $_POST[run_in_first_over2];
		$arrNew[total_fours] 				= $_POST[total_fours];
		$arrNew[total_six] 					= $_POST[total_six];
		 
		$arrNew[winning_team] 				= $_POST[winning_team];
		$arrNew[winning_status] 			= $_POST[winning_status];
		$arrNew[match_id] 					= $match_id;
		$arrNew[series_id] 					= $series_id;
	    if(count($_POST[player_id])){
			foreach($_POST[player_id] as $key=>$val){
				$arrBatsmen = array();
				$arrBowler = array();
				$arrBatsmenTeam1 = array();
				$arrBowlerTeam2 = array();
				
				//Batsmen Table Team1
				$arrBatsmen[player_id] 		= $val;
				$arrBatsmen[player_status] 	= $_POST[status_batsmen][$key];
				$arrBatsmen[player_run] 	= $_POST[run][$key];
				$arrBatsmen[palyer_ball] 	= $_POST[ball][$key];
				$arrBatsmen[player_fours] 	= $_POST[fours][$key];
				$arrBatsmen[player_six] 	= $_POST[six][$key];
				$arrBatsmen[match_id] 		= $match_id;
				$arrBatsmen[series_id] 		= $series_id;
				//Bowler Table Team2
				$arrBowler[player_id] 				= $_POST[player_id1][$key];
				$arrBowler[bowler_over] 			= $_POST[ovr][$key];
				$arrBowler[bowler_over_maiden] 		= $_POST[maidens][$key];
				$arrBowler[bowler_over_runs] 		= $_POST[runs][$key];
				$arrBowler[bowler_over_wicket] 		= $_POST[wickets][$key];
				$arrBowler[bowler_over_wide_ball] 	= $_POST[wides][$key];
				$arrBowler[bowler_over_no_ball] 	= $_POST[noballs][$key];
				$arrBowler[bowler_over_economy] 	= $_POST[economy_rate][$key];
				$arrBowler[match_id] 				= $match_id;
				$arrBowler[series_id] 				= $series_id;
				//Batsmen Table Team2
				$arrBatsmenTeam1[player_id] 		= $_POST[player_id2][$key];
				$arrBatsmenTeam1[player_status] 	= $_POST[status_batsmen1][$key];
				$arrBatsmenTeam1[player_run] 		= $_POST[run1][$key];
				$arrBatsmenTeam1[palyer_ball] 		= $_POST[ball1][$key];
				$arrBatsmenTeam1[player_fours] 		= $_POST[fours1][$key];
				$arrBatsmenTeam1[player_six] 		= $_POST[six1][$key];
				$arrBatsmenTeam1[match_id] 			= $match_id;
				$arrBatsmenTeam1[series_id] 		= $series_id;
				//Bowler Table Team1
				$arrBowlerTeam2[player_id] 				= $_POST[player_id3][$key];
				$arrBowlerTeam2[bowler_over] 			= $_POST[ovrs1][$key];       
				$arrBowlerTeam2[bowler_over_maiden] 	= $_POST[maidens1][$key];
				$arrBowlerTeam2[bowler_over_runs] 		= $_POST[runs1][$key];
				$arrBowlerTeam2[bowler_over_wicket] 	= $_POST[wickets1][$key];
				$arrBowlerTeam2[bowler_over_wide_ball] 	= $_POST[wideballs1][$key];
				$arrBowlerTeam2[bowler_over_no_ball] 	= $_POST[noballs1][$key];
				$arrBowlerTeam2[bowler_over_economy] 	= $_POST[economyrate1][$key];
				$arrBowlerTeam2[match_id] 				= $match_id;
				$arrBowlerTeam2[series_id] 				= $series_id;
				if($arrBatsmen[player_id] 	!= 0){
					$cms->sqlquery("rs","batsmen",$arrBatsmen);
					$updateid = mysql_insert_id();
					$adm->sessset('Record has been added', 's'); 
				}
				if($arrBowler[player_id] 	!= 0){
					$cms->sqlquery("rs","bowlers",$arrBowler);
					$updateid = mysql_insert_id();
					 $adm->sessset('Record has been added', 's');
				}
				if($arrBatsmenTeam1[player_id] != 0){
					$cms->sqlquery("rs","batsmen",$arrBatsmenTeam1);
					$updateid = mysql_insert_id();
					 $adm->sessset('Record has been added', 's');
				}
				if($arrBowlerTeam2[player_id] 	!= 0){
					$cms->sqlquery("rs","bowlers",$arrBowlerTeam2);
					$updateid = mysql_insert_id();
					$adm->sessset('Record has been added', 's'); 
				}
			}
		}
		if($arrBatsmen[match_id] 	!= 0){
			$cms->sqlquery("rs","match_summary",$arrNew);
			$updateid = mysql_insert_id();
			$adm->sessset('Record has been added', 's'); 
		}
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($match_id)){
	$rsAdmin=$cms->db_query("select * from #_match_summary where match_id='".$match_id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
	<?php $rsMatches= $cms->db_query("SELECT * FROM #_matches WHERE pid='".$match_id."'");
		$arrMatches=$cms->db_fetch_array($rsMatches); print_r($arrMatches);	?>
	  
	<tr>
		<td width="20%"  class="label">Toss:</td>
		<td width="25%">
			<select name="toss" class="txt medium" >
				<option value="">
					Select
				</option>
				<option <?=($arrMatches[team1]==$toss)?'selected="selected"':''?> value="<?=$arrMatches[team1]?>">
					<?=$arrMatches[team1]?>
				</option>
				<option <?=($arrMatches[team2]==$toss)?'selected="selected"':''?> value="<?=$arrMatches[team2]?>">
					<?=$arrMatches[team2]?>
				</option>
				 
			</select>
		</td>
		<td width="25%"  class="label">Men of the match:</td>
		<td width="25%"  class="label">
			<select name="men_of_the_match" class="txt medium"   >
			<option value="">
					Select
				</option>
			<?php
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE playTeams IN ('".$arrMatches[team1]."' , '".$arrMatches[team2]."') ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){
			?>	 
				<option <?=($arrPlayer[playerName]==$men_of_the_match)?'selected="selected"':''?> value="<?=$arrPlayer[playerName]?>">
					<?=$arrPlayer[playerName]?>
				</option>
			<?php }	?>	 
			</select>
		</td>
    </tr>
	<tr>
		<td width="25%"  class="label">Score: Team - <?=$arrMatches[team1]?></td>
		<td width="25%"><input type="text" name="total_score_team1"  title="over" class="txt medium" value="<?=$total_run_team1?>" />	</td>
		<td width="25%"  class="label">Wickets: Team - <?=$arrMatches[team1]?></td>
		<td width="25%"><input type="text" name="total_wicket_team1"  title="over" class="txt medium" value="<?=$total_wicket_team1?>" />	</td>
	 
    </tr>
	<tr>
		<td width="25%"  class="label">Score: Team - <?=$arrMatches[team2]?></td>
		<td width="25%"><input type="text" name="total_score_team2"  title="over" class="txt medium" value="<?=$total_run_team2?>" />	</td>
		<td width="25%"  class="label">Wickets: Team - <?=$arrMatches[team2]?></td>
		<td width="25%"><input type="text" name="total_wicket_team2"  title="over" class="txt medium" value="<?=$total_wicket_team2?>" />	</td>
	 
    </tr>
	<tr>
		<td width="25%"  class="label">Run First over: Team - <?=$arrMatches[team1]?></td>
		<td width="25%"><input type="text" name="run_in_first_over1"  title="over" class="txt medium" value="<?=$run_in_first_over_team1?>" />	</td>
		<td width="25%"  class="label">Run First over: Team - <?=$arrMatches[team2]?></td>
		<td width="25%"><input type="text" name="run_in_first_over2"  title="over" class="txt medium" value="<?=$run_in_first_over_team2?>" />	</td>
	</tr>
	<tr>
		<td width="25%"  class="label">Total Fours in the Match :</td>
		<td width="25%"><input type="text" name="total_fours"  title="over" class="txt medium" value="<?=$total_fours?>" />	</td>
		<td width="25%"  class="label">Total Sixes in the Match:</td>
		<td width="25%"><input type="text" name="total_six"  title="over" class="txt medium" value="<?=$total_six?>" />	</td>
	</tr>
	<tr>
		<td width="25%"  class="label">Winner team:</td>
		<td width="25%">
		<select name="winning_team" class="txt medium" >
				<option value="">
					Select
				</option>
				<option <?=($arrMatches[team1]==$winning_team)?'selected="selected"':''?> value="<?=$arrMatches[team1]?>">
					<?=$arrMatches[team1]?>
				</option>
				<option <?=($arrMatches[team2]==$winning_team)?'selected="selected"':''?> value="<?=$arrMatches[team2]?>">
					<?=$arrMatches[team2]?>
				</option>
				 
			</select>
		
		 </td>
		<td width="25%"  class="label">How Winning Match:</td>
		<td width="25%"><input type="text" name="winning_status"  title="over" class="txt medium" value="<?=$winning_status?>" />	</td>
    </tr>
	 
</table>
	<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
	  	<tr style="font-size: 18px;color: gray;">
			<?php $teamId = $cms->getSingleresult("select teamId from #_player where playTeams ='".$arrMatches[team1]."'");?>
			<?php $teamName = $cms->getSingleresult("select name from #_team where pid='".$teamId ."'");?>
			<td width="25%"  class="label">Team: <?=$teamName?></td>
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
	<?php 
		$qr = $cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team1]."' ORDER BY playerName ASC LIMIT 11");
		while($playerArr = $cms->db_fetch_array($qr)) {
	?>
	<tr>
		
		<td width="25%"  class="label">
		    <input type="hidden" name="team1" value="<?=$arrMatches[team1]?>">
			<select name="player_id[]" class="txt medium" style="margin-left: 24px;width: 85%;">
			<option value="">
					Select
				</option>
			<?php
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team1]."' ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){
			?>	 
				<option <?=$arrPlayer[pid]?> value="<?=$arrPlayer[pid]?>">
					<?=$arrPlayer[playerName]?>
				</option>
			<?php }	?>	 
			</select>
		</td>
		<td>
			<select class="txt medium" name="status_batsmen[]" title="Status" style=" width: 20%;margin-left: 62px;">
				<option value="Still to Bat">Still to Bat</option>
				<option value="Not Out">Not Out</option>
				<option value="Out">Out</option>
				<option value="Retired Hurt">Retired Hurt</option>
			</select>	
			<input type="text" name="run[]" title="Run" class="txt medium" value="" style="width: 10%;margin-left: 84px;text-align: center;">
			<input type="text" name="ball[]" title="Ball" class="txt medium" value="" style="width: 10%;margin-left: 51px;text-align: center;">
			<input type="text" name="fours[]" title="4's" class="txt medium" value="" style="width: 10%;margin-left: 46px;text-align: center;">
			<input type="text" name="six[]" title="6's" class="txt medium" value="" style="width: 10%;margin-left: 41px;text-align: center;">
		</td>
	</tr>
	 <?php } ?>
	 
  </table>
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
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
		$qr = $cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team2]."'  ORDER BY playerName ASC LIMIT 11");
		while($playerArr = $cms->db_fetch_array($qr)) {
			?>
	<tr>
		
		<td width="25%"  class="label">
			<input type="hidden" name="team2" value="<?=$arrMatches[team2]?>">
			<select name="player_id1[]" class="txt medium" style="margin-left: 7%;width: 85%;">
			<option value=""> Select </option><?php 
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team2]."' ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){?> 
					<option value="<?=$arrPlayer[pid]?>"><?=$arrPlayer[playerName]?></option><?php }	?> 
			</select>
		</td>
		<td>
			<input type="text" name="ovr[]"  title="over" value="<?=$bowler_over?>" class="txt medium" style="width: 11%;text-align: center;"/>
			<input type="text" name="maidens[]"  title="maiden" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="runs[]"  title="run" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="wickets[]"  title="wicket" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="wides[]"  title="wide" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="noballs[]"  title="no" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="economy_rate[]"  title="economy rate" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
		</td>
		
	</tr>
	 <?php }	?>	
	 	
  </table>
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2" style="margin-top: 23px;">
	  
		<tr style="font-size: 18px;color: gray;">
			<?php $teamId = $cms->getSingleresult("select teamId from #_player where playTeams='".$arrMatches[team2]."'");?>
			<?php $teamName = $cms->getSingleresult("select name from #_team where pid='".$teamId ."'");?>
			<td width="25%"  class="label">Team: <?=$teamName?></td>
		</tr>
		 
		<tr style="font-size: 15px;color: aliceblue;font-family: inherit;">
			<th width="25%" class="heading">Batsmen Name:</th>
			<th width="25%" class="heading">Status:</th>
			<th width="13%" class="heading">Run:</th>
			<th width="13%" class="heading">Ball:</th>
			<th width="12%" class="heading">4's:</th>
			<th width="12%" class="heading">6's:</th>
			 
		</tr>
	</table>
	<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
   
	<?php 
		$qr = $cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team2]."'  ORDER BY playerName ASC LIMIT 11");
		while($playerArr = $cms->db_fetch_array($qr)) {
			?>
	<tr>
		
		<td width="25%"  class="label">
			<select name="player_id2[]" class="txt medium" style="margin-left: 24px;width: 85%;">
			<option value="">
					Select
				</option>
			<?php
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team2]."' ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){
			?>	 
				<option value="<?=$arrPlayer[pid]?>">
					<?=$arrPlayer[playerName]?>
				</option>
			<?php }	?>	 
			</select>
		</td>
		<td>
			<select class="txt medium" name="status_batsmen[]" title="Status" style=" width: 20%;margin-left: 62px;">
				<option value="Still to Bat">Still to Bat</option>
				<option value="Not Out">Not Out</option>
				<option value="Out">Out</option>
				<option value="Retired Hurt">Retired Hurt</option>
			</select>	
			<input type="text" name="run[]" title="Run" class="txt medium" value="" style="width: 10%;margin-left: 84px;text-align: center;">
			<input type="text" name="ball[]" title="Ball" class="txt medium" value="" style="width: 10%;margin-left: 51px;text-align: center;">
			<input type="text" name="fours[]" title="4's" class="txt medium" value="" style="width: 10%;margin-left: 46px;text-align: center;">
			<input type="text" name="six[]" title="6's" class="txt medium" value="" style="width: 10%;margin-left: 41px;text-align: center;">
		</td>
		
	</tr>
	 
	 <?php }	?>	 
  </table>
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
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
    <?php 
		$qr = $cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team1]."'  ORDER BY playerName ASC LIMIT 11");
		while($playerArr = $cms->db_fetch_array($qr)) {
			?>
	<tr>
		
		<td width="25%"  class="label">
			<select name="player_id3[]" class="txt medium" style="margin-left: 7%;width: 85%;">
			<option value="">
					Select
				</option>
			<?php
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE playTeams='".$arrMatches[team1]."' ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){
			?>	 
				<option value="<?=$arrPlayer[pid]?>">
					<?=$arrPlayer[playerName]?>
				</option>
			<?php }	?>	 
			</select>
		</td>
		<td>
			<input type="text" name="ovrs1[]"  title="over" class="txt medium" value=" " style="width: 11%;text-align: center;"/>
			<input type="text" name="maidens1[]"  title="maiden" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="runs1[]"  title="run" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="wickets1[]"  title="wicket" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="wideballs1[]"  title="wide" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="noballs1[]"  title="no" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
			<input type="text" name="economyrate1[]"  title="economy rate" class="txt medium" value="" style="width: 11%;margin-left: 12px;text-align: center;"/>
		 
		</td>
		 <?php } ?>
	</tr>
	 
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <input type="submit" name="Submit" class="uibutton  loading" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" /></td>
    </tr>	
  </table>
 