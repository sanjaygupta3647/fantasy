<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
 if($img=='del'){
	$imagetodel=$cms->getSingleresult("select image from #_series where pid='".$id."' "); 
	if($imagetodel){
	@unlink(UP_FILES_FS_PATH."/orginal/".$imagetodel);	
	}
	$cms->db_query("update  #_series set image = '' where `image`='".$img."'");
	$adm->sessset('Image deleted', 's');
	$red = SITE_PATH_ADM.CPAGE."?mode=add&id=".$id;
	$cms->redir($red, true);
} 
if($cms->is_post_back()){
	$cms->createXmlFile();
	$path = UP_FILES_FS_PATH."/orginal";
	if($_FILES[image][name]){
		$ext=end(explode('.',$_FILES[image][name]));
		$imgname=rand().rand().'.'.$ext; 
		$bool = move_uploaded_file($_FILES[image][tmp_name],$path.'/'.$imgname); 
		$_POST[image] = $imgname; 
		//$cms->make_thumb_gd($path."/".$_POST['image'], $path."/".$_POST['image'],560,300); 
	} 
	$_POST[url] = $adm->baseurl($title)."-live-streaming";  
	if($d<10) {$d = "0".$d;   }
	if($m<10) {$m = "0".$m;  }
	$_POST[series_sdate] = $y."-".$m."-".$d;
	if($d2<10) {$d2 = "0".$d2;   }
	if($m2<10) {$m2 = "0".$m2;  }
	$_POST[series_edate] = $y2."-".$m2."-".$d2;
	if($updateid){
		$cms->sqlquery("rs","series",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","series",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_series where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
   
   <tr>
      <td width="25%"  class="label">Title:</td>
      <td width="75%"><input type="text" name="title"  lang="R" title="Series Title" class="txt medium" value="<?=$title?>" /></td>
    </tr>
	 <tr  class="grey_">
      <td width="25%" valign="top" class="label">Meta Title:</td>
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

   <tr>
      <td width="25%"  class="label">Place:</td>
      <td width="75%"><input type="text" name="place"  lang="R" title="Place" class="txt medium" value="<?=$place?>" /></td>
   </tr>
   <tr>
      <td width="25%"  class="label">Start Date:</td>
      <td width="75%">Day:<select name="d">
	  <?php
	  for($i=1; $i<=31;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$d)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select>
	  
 	  Month:<select name="m">
	  <?php
	  for($i=1; $i<=12;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$m)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select>
	  Year:<select name="y">
	  <?php
	  $cr = date('Y');
	  $next = $cr+5;
	  for($i=$cr; $i<=$next;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$y)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select></td>
   </tr>
   <tr>
      <td width="25%"  class="label">End Date:</td>
      <td width="75%">Day:<select name="d2">
	  <?php
	  for($i=1; $i<=31;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$d2)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select>
	  
 	  Month:<select name="m2">
	  <?php
	  for($i=1; $i<=12;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$m2)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select>
	  Year:<select name="y2">
	  <?php
	  $cr = date('Y');
	  $next = $cr+5;
	  for($i=$cr; $i<=$next;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$y2)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select></td>
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
      <td width="75%"><input type="text"  class="txt medium" style="width:60px"  name="priority" id="meta_title" value="<?=($priority)?$priority:'0.80'?>" /></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <input type="submit" name="Submit" class="uibutton  loading" value="&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;" /></td>
    </tr>	
  </table>
 