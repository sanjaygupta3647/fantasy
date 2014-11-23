<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if($img=='del'){
	$imagetodel=$cms->getSingleresult("select image from #_gift where pid='".$id."' "); 
	if($imagetodel){
	@unlink(UP_FILES_FS_PATH."/orginal/".$imagetodel);	
	}
	$cms->db_query("update  #_gift set image = '' where pid='".$id."' ");
	$adm->sessset('Image deleted', 's');
	$red = SITE_PATH_ADM.CPAGE."?mode=add&id=".$id;
	$cms->redir($red, true);
}
if($cms->is_post_back()){
	$path = UP_FILES_FS_PATH."/orginal";
	if($_FILES[image][name]){
		$ext=end(explode('.',$_FILES[image][name]));
		$imgname=rand().rand().'.'.$ext; 
		$bool = move_uploaded_file($_FILES[image][tmp_name],$path.'/'.$imgname); 
		$_POST[image] = $imgname; 
		//$cms->make_thumb_gd($path."/".$_POST['image'], $path."/".$_POST['image'],560,300); 
	}
	if($updateid){
		$cms->sqlquery("rs","gift",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","gift",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_gift where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
    <tr>
		<td width="25%"  class="label">Gift Name :</td>
		<td width="75%"><input type="text" name="giftName"  lang="R" title="team Name" class="txt medium" value="<?=$giftName?>" style="width:30%;"/></td>
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
            <td valign="top" class="label">Image:</td>
            <td valign="top"><input size="24" type="file" name="image" title="Image"  /></td>
     </tr>
	<tr>
		<td width="25%"  class="label">Get Points:</td>
		<td width="75%"><input type="text" name="get_points"  lang="R" title="team Name" class="txt medium" value="<?=$get_points?>" style="width: 17%;"/></td>
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
 