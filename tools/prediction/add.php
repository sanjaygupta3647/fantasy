<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if($cms->is_post_back()){
	if($updateid){
		$cms->sqlquery("rs","prediction",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","prediction",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_prediction where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
    <tr>
		<td width="25%"  class="label">Prediction:</td>
		<td>
			<select  class="txt medium"  name="prediction" class="select" lang="R" title="Status">
				<option value="">Select</option>
				<option value="Team Win" <?=(($prediction=='Team Win')?'selected="selected"':'')?>>Team Win</option>
				<option value="Team Wins Toss" <?=(($prediction=='Team Wins Toss')?'selected="selected"':'')?>>Team Wins Toss</option>
				<option value="Runs scored in 1st over" <?=(($prediction=='Runs scored in 1st over')?'selected="selected"':'')?>>Runs scored in 1st over</option>
				<option value="Man of the Match" <?=(($prediction=='Man of the Match')?'selected="selected"':'')?>>Man of the Match</option>
				<option value="Total Score by (Team1)" <?=(($prediction=='Total Score by (Team1)')?'selected="selected"':'')?>>Total Score by (Team1)</option>
				<option value="Total Score by (Team2)" <?=(($prediction=='Total Score by (Team2)')?'selected="selected"':'')?>>Total Score by (Team2)</option>
				</select>
		</td>
    </tr>
	<tr>
		<td width="25%"  class="label">Prediction Points:</td>
		<td width="75%"><input type="text" name="prediction_points"  lang="R" title="team Name" class="txt medium" value="<?=$prediction_points?>" style="width: 17%;"/></td>
    </tr>
	<tr>
	  <td class="label">Status:<span>*</span></td>
	  <td><select  class="txt medium"  name="status" class="select" lang="R" title="Status">
	  <option value="Active" <?=(($status=='Active')?'selected="selected"':'')?>>Active</option>
	  <option value="Inactive" <?=(($status=='Inactive')?'selected="selected"':'')?>>Inactive</option>
	  </select>	  </td>
    </tr>
	 
    
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <input type="submit" name="Submit" class="uibutton  loading" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" /></td>
    </tr>	
  </table>
 