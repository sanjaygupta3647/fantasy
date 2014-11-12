<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if($img=='del'){
	$imagetodel=$cms->getSingleresult("select image from #_player where pid='".$id."' "); 
	if($imagetodel){
	@unlink(UP_FILES_FS_PATH."/orginal/".$imagetodel);	
	}
	$cms->db_query("update  #_player set image = '' where `image`='".$img."'");
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
		$cms->sqlquery("rs","player",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","player",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_player where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
    <tr>
      <td width="25%"  class="label">Player Name:</td>
      <td width="75%"><input type="text" name="playerName"  lang="R" title="Player Name" class="txt medium" value="<?=$playerName?>" /></td>
    </tr>
	 <?php	  
	  if($playerImage and is_file($_SERVER['DOCUMENT_ROOT'].SITE_SUB_PATH."uploaded_files/orginal/".$playerImage)==true){?>
					  <tr>
						<td valign="top" class="label">&nbsp;</td>
						<td valign="top"><img src="<?=SITE_PATH?>uploaded_files/orginal/<?=$playerImage?>" width="100"> &nbsp;<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add&id=<?=$id?>&img=del">Delete Image</a> &nbsp;
						</td>
					  </tr>
	  <?php 
	  }?>
	 <tr>
            <td valign="top" class="label">Player Image:</td>
            <td valign="top"><input size="24" type="file" name="playerImage" title="Player Image"  /></td>
     </tr>
   <tr>
      <td width="25%"  class="label">Select team:</td>
      <td width="75%"><select name="teamId" class="txt medium"  lang="R">
	  				<?php
					$rsAdmin2=$cms->db_query("select pid,name from #_team where status='Active'");
					while($arrAdmin2=$cms->db_fetch_array($rsAdmin2)){?>
					<option value="<?=$arrAdmin2[pid]?>" <?php if($arrAdmin2[pid]==$district_id) echo'selected="selected"';?>><?=$arrAdmin2[name]?></option>
					<?php 
					}
					?></select>
	</td>
    </tr> 
     <?php	  
	  if($image and is_file($_SERVER['DOCUMENT_ROOT'].SITE_SUB_PATH."uploaded_files/orginal/".$image)==true){?>
					  <tr>
						<td valign="top" class="label">&nbsp;</td>
						<td valign="top"><img src="<?=SITE_PATH?>uploaded_files/orginal/<?=$image?>" width="100"> &nbsp;<a href="<?=SITE_PATH_ADM.CPAGE?>?mode=add&id=<?=$id?>&img=del">Delete Image</a> &nbsp;
						</td>
					  </tr>
	  <?php 
	  }?>
	 
     <tr>
      <td width="25%"  class="label">Age:</td>
      <td width="75%"><input type="text" name="age"  lang="R" title="age" class="txt medium" value="<?=$age?>" /></td>
    </tr>
	<tr>
	  <td class="label">Player Profile:<span>*</span></td>
	   <td><select  class="txt medium"  name="playerProfile" class="select" lang="R" title="Player Profile">
	  <option value="Active" <?=(($playerProfile=='Batsman')?'selected="selected"':'')?>>Batsman</option>
	  <option value="Inactive" <?=(($playerProfile=='Bowler')?'selected="selected"':'')?>>Bowler</option>
	  <option value="Inactive" <?=(($playerProfile=='All Rounder')?'selected="selected"':'')?>>All Rounder</option>
	  <option value="Inactive" <?=(($playerProfile=='Wicket Keeper/Batsman')?'selected="selected"':'')?>>Wicket Keeper/Batsman</option>
	  <option value="Inactive" <?=(($playerProfile=='Caption/Bowler')?'selected="selected"':'')?>>Caption/Bowler</option>
	  <option value="Inactive" <?=(($playerProfile=='Caption/All Rounder')?'selected="selected"':'')?>>Caption/All Rounder</option>
	  <option value="Inactive" <?=(($playerProfile=='Caption/Wicket Keeper')?'selected="selected"':'')?>>Caption/Wicket Keeper</option>
	  <option value="Inactive" <?=(($playerProfile=='Caption/Batsman')?'selected="selected"':'')?>>Caption/Batsman</option>
	  <option value="Inactive" <?=(($playerProfile=='Caption/Wicket Keeper/Batsman')?'selected="selected"':'')?>>Caption/Wicket Keeper/Batsman</option>
	  </select>	  </td>
    </tr>
	
     <tr>
      <td width="25%" valign="top"  class="label">Team's Play :</td>
      <td width="75%"><textarea name="playTeams" cols="80" rows="5" ><?=$playTeams?></textarea></td>
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
 