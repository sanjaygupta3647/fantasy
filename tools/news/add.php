<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
  
if($cms->is_post_back()){
	$cms->createXmlFile(); 
	$_POST[url] = $adm->baseurl($_POST[metatitle]);
	$path = UP_FILES_FS_PATH."/orginal";
	if($_FILES[image][name]){
		$ext=end(explode('.',$_FILES[image][name]));
		$imgname=rand().rand().'.'.$ext; 
		$bool = move_uploaded_file($_FILES[image][tmp_name],$path.'/'.$imgname); 
		$_POST[image] = $imgname;  
	} 
	if($updateid){
		$cms->sqlquery("rs","news",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","news",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_news where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
   
   <tr>
      <td width="25%"  class="label">Title:</td>
      <td width="75%">
	  <input type="text"  class="txt medium"  name="title" id="title" value="<?=$title?>" /> 
	  </td>
    </tr>
	 <tr  class="grey_">
      <td width="25%" valign="top" class="label">Meta title:</td>
      <td width="75%"><input type="text"  class="txt medium"  name="metatitle" id="meta_title" value="<?=$metatitle?>" /></td>
    </tr>
    
   <tr>
      <td width="25%" valign="top"  class="label">Meta Description :</td>
      <td width="75%"><textarea name="metadesc" cols="80" rows="5" id="metadesc"><?=$metadesc?></textarea></td>
    </tr>
	<tr  class="grey_">
	  <td valign="top" class="label">Meta Keywords :</td>
	
	  <td><textarea name="metakey" cols="80" rows="5" id="metakey"><?=$metakey?></textarea></td>
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
 
     <tr  class="">
	  <td valign="top" class="label">Description :</td>
	
	  <td>
	  <?=$adm->get_editor('body',stripslashes($body))?>
	 </td>
    </tr>
	<tr>
	  <td class="label">Status:<span>*</span></td>
	  <td><select  class="txt medium"  name="status" class="select" lang="R" title="Status">
	  <option value="Active" <?=(($status=='Active')?'selected="selected"':'')?>>Active</option>
	  <option value="Inactive" <?=(($status=='Inactive')?'selected="selected"':'')?>>Inactive</option>
	  </select>	  </td>
    </tr>
	 
    <tr  class="grey_">
      <td width="25%" valign="top" class="label">Set XML Priority:</td>
      <td width="75%"><input type="text"  class="txt medium" style="width:60px"  name="priority" id="meta_title" value="<?=($priority)?$priority:'0.64'?>" /></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <input type="submit" name="Submit" class="uibutton  loading" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" /></td>
    </tr>	
  </table>
 