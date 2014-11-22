<?php defined('_JEXEC') or die('Restricted access');?>
<?php 
$series_id = $cms->getSingleresult("SELECT series_id FROM #_matches WHERE pid = '".$match_id."'");
if($cms->is_post_back()){ 
	if(isset($match_id)){ 
		$check = $cms->getSingleresult("select count(*) from #_match_summary where match_id = '".$match_id."' ");
		$_POST[match_id] = $match_id;
		if($check){
			$cms->sqlquery("rs","match_summary",$_POST,'match_id',$match_id);
			$adm->sessset('Record has been updated', 's');
		} else {  
			$cms->sqlquery("rs","match_summary",$_POST); 
			$adm->sessset('Record has been added', 's');  
		}
		$path = SITE_PATH_ADM.CPAGE."/?match_id=".$match_id;
	    $cms->redir($path, true);
	}else{
		$adm->sessset('There is something wrong', 'e'); 
	    $cms->redir($path, true);
	} 
}	
if(isset($match_id)){
	$rsAdmin=$cms->db_query("select * from #_match_summary where match_id='".$match_id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
	<?php 
		$rsMatches= $cms->db_query("SELECT * FROM #_matches WHERE pid='".$match_id."'");
		$arrMatches=$cms->db_fetch_array($rsMatches);  
		$team1name = $cms->getSingleresult("select name from #_team where pid = '".$arrMatches[team1]."' "); 
		$team2name = $cms->getSingleresult("select name from #_team where pid = '".$arrMatches[team2]."' "); 
		
		
	?>
	  
	<tr>
		<td width="20%"  class="label">Toss:</td>
		<td width="80%">
			<select name="toss" class="txt medium"  >
				 
				<option <?=($arrMatches[team1]==$toss)?'selected="selected"':''?> value="<?=$arrMatches[team1]?>">
					<?=$team1name?>
				</option>
				<option <?=($arrMatches[team2]==$toss)?'selected="selected"':''?> value="<?=$arrMatches[team2]?>">
					<?=$team2name?>
				</option>
				 
			</select>

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manage: &nbsp;&nbsp;
		[<a style="text-decoration:blink" href="<?=SITE_PATH."tools/batting/?match_id=".$match_id?>&team_id=<?=$arrMatches[team1]?>"><?=$team1name?> Batting</a>]  &nbsp; 

		[<a style="text-decoration:blink" href="<?=SITE_PATH."tools/batting/?match_id=".$match_id?>&team_id=<?=$arrMatches[team2]?>"><?=$team2name?> Batting</a>]  &nbsp; 

		[<a style="text-decoration:blink" href="<?=SITE_PATH."tools/balling/?match_id=".$match_id?>&team_id=<?=$arrMatches[team1]?>"><?=$team1name?> Balling</a>]  &nbsp; 

		[<a style="text-decoration:blink" href="<?=SITE_PATH."tools/balling/?match_id=".$match_id?>&team_id=<?=$arrMatches[team2]?>"><?=$team2name?> Balling</a>]

		</td>
		
    </tr>
	<tr>
		<td width="20%"  class="label">First Batting:</td>
		<td width="80%">
			<select name="first_batting" class="txt medium" > 
				<option <?=($arrMatches[team1]==$first_batting)?'selected="selected"':''?> value="<?=$arrMatches[team1]?>">
					<?=$team1name?>
				</option>
				<option <?=($arrMatches[team2]==$first_batting)?'selected="selected"':''?> value="<?=$arrMatches[team2]?>">
					<?=$team2name?>
				</option>
				 
			</select>
		</td> 
    </tr>

	 

	<tr>
		<td width="20%"  class="label">Winner team:</td>
		<td width="80%">
		<select name="winning_team" class="txt medium" > 
				<option value="0">Draw</option> 
				<option <?=($arrMatches[team1]==$winning_team)?'selected="selected"':''?> value="<?=$arrMatches[team1]?>">
					<?=$team1name?>
				</option>
				<option <?=($arrMatches[team2]==$winning_team)?'selected="selected"':''?> value="<?=$arrMatches[team2]?>">
					<?=$team2name?>
				</option>
				 
			</select>
		
		 </td> 
	</tr>

	<tr>
		<td width="20%"  class="label">Run In First Over :</td>
		<td width="80%"><input type="text" name="first_over_run"  title="over" class="txt medium" value="<?=$first_over_run?>" />	</td>
	</tr>

	<tr>
		<td width="20%"  class="label">Total Fours in the Match :</td>
		<td width="80%"><input type="text" name="total_fours"  title="over" class="txt medium" value="<?=$total_fours?>" />	</td>
	</tr>

	<tr>
		<td width="20%"  class="label">Total Sixes in the Match:</td>
		<td width="80%"><input type="text" name="total_six"  title="over" class="txt medium" value="<?=$total_six?>" />	</td>
	</tr>

	<tr> 
		<td width="20%"  class="label">Men of the match:</td>
		<td width="80%"  class="label">
			<select name="men_of_the_match" class="txt medium"   >
			 
			<?php 
				$rsPlayer=$cms->db_query("SELECT * FROM #_player WHERE teamId IN ('".$arrMatches[team1]."' , '".$arrMatches[team2]."') ORDER BY playerName ASC");
				while($arrPlayer=$cms->db_fetch_array($rsPlayer)){
			?>	 
				<option <?=($arrPlayer[pid]==$men_of_the_match)?'selected="selected"':''?> value="<?=$arrPlayer[pid]?>">
					<?=$arrPlayer[playerName]?>
				</option>
			<?php }	?>	 
			</select>
		</td>
	</tr>

    

	 <tr>
		
		<td width="20%"  class="label">How Winning Match:</td>
		<td width="80%"><input type="text" name="winning_status"  title="over" class="txt medium" value="<?=$winning_status?>" />	</td>
    </tr> 
	<tr>
	  <td  width="20%">&nbsp;</td>
	  <td>
	  <input type="submit" name="Submit" class="uibutton  loading" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" /></td>
    </tr>	 
</table>
	 