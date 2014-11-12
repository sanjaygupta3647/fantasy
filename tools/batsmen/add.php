<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if($img=='del'){
	$imagetodel=$cms->getSingleresult("select image from #_batsmen where pid='".$id."' "); 
	if($imagetodel){
	@unlink(UP_FILES_FS_PATH."/orginal/".$imagetodel);	
	}
	$cms->db_query("update  #_batsmen set image = '' where `image`='".$img."'");
	$adm->sessset('Image deleted', 's');
	$red = SITE_PATH_ADM.CPAGE."?mode=add&id=".$id;
	$cms->redir($red, true);
}
if($cms->is_post_back()){
 
	$path = UP_FILES_FS_PATH."/orginal";
	if($_FILES[playerImage][name]){
		$ext=end(explode('.',$_FILES[playerImage][name]));
		$imgname=rand().rand().'.'.$ext; 
		$bool = move_uploaded_file($_FILES[playerImage][tmp_name],$path.'/'.$imgname); 
		$_POST[playerImage] = $imgname; 
		//$cms->make_thumb_gd($path."/".$_POST['image'], $path."/".$_POST['image'],560,300); 
	} 
	if($updateid){
		$cms->sqlquery("rs","batsmen",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","batsmen",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_batsmen where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
  <tr>
		<td width="25%"  class="label">Select team:</td>
		<td width="75%">
			<select name="team_id" class="txt medium"  lang="R">
	  			<?php
					$rsAdmin2=$cms->db_query("select pid,name from #_team where status='Active'");
					while($arrAdmin2=$cms->db_fetch_array($rsAdmin2)){
				?>
					<option value="<?=$arrAdmin2[pid]?>" <?php if($arrAdmin2[pid]==$district_id) echo'selected="selected"';?>>
						<?=$arrAdmin2[name]?>
					</option>
				<?php }	?>
			</select>
		</td>
    </tr> 
    <tr>
      <td width="25%"  class="label">Player Name:</td>
      <td width="25%">
		<input type="text" name="player_name"  lang="R" title="" class="txt medium" value="<?=$player_name?>" /></td>
    </tr>
	 <tr>
      <td width="25%"  class="label">Player Status:</td>
      <td width="75%"><input type="text" name="player_status"  lang="R" title="" class="txt medium" value="<?=$player_status?>"/></td>
    </tr>
	 <tr>
      <td width="25%"  class="label">Player Run:</td>
      <td width="75%"><input type="text" name="player_run"  lang="R" title="" class="txt medium" value="<?=$player_run?>" style="width: 20%;"/></td>
    </tr>
	 <tr>
      <td width="25%"  class="label">Balls Played:</td>
      <td width="75%"><input type="text" name="palyer_ball"  lang="R" title="" class="txt medium" value="<?=$palyer_ball?>" style="width: 20%;"/></td>
    </tr>
	 <tr>
      <td width="25%"  class="label">Total Fours:</td>
      <td width="75%"><input type="text" name="player_fours"  lang="R" title="" class="txt medium" value="<?=$player_fours?>" style="width: 20%;"/></td>
    </tr>
	 <tr>
      <td width="25%"  class="label">Total Six's:</td>
      <td width="75%"><input type="text" name="player_six"  lang="R" title="" class="txt medium" value="<?=$player_six?>" style="width: 20%;"/></td>
    </tr>
	<tr>
      <td width="25%"  class="label">Strike Rate:</td>
      <td width="75%"><input type="text" name="player_strike_rate"  lang="R" title="" class="txt medium" value="<?=$player_strike_rate?>" style="width: 20%;"/></td>
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
 