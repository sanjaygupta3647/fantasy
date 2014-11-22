<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if($cms->is_post_back()){   
	if($updateid){ 
		$uids =  $cms->sqlquery("rs","pages",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	} else { 
		$_POST[submitdate] = time();
		$uids = $cms->sqlquery("rs","pages",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's');
	}
	$url = $adm->baseurl($_POST[heading].'-'.$updateid);
	$cms->db_query("update #_pages set url = '".$url."' where `pid` ='$updateid' "); 
	$cms->redir(SITE_PATH_ADM.CPAGE, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_pages where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
     
    <tr>
      <td  class="label">Parent:</td>
      <td>
	  <select name="parent" class="txt" title="Page">
	  <option value="0">----Select----</option> <?php    
	    $chekc=$cms->db_query("select pid,heading from #_pages where status='Active'");
			if(mysql_num_rows($chekc)){
			while($rs=$cms->db_fetch_array($chekc)){?> 
			<option value="<?=$rs[pid]?>" <?=($parent==$rs[pid])?'selected="selected"':''?>> <?=$rs[heading]?>  </option>
		  <?php }  
		}?>
		
	  </select></td>
    </tr>
     
	 
    <tr>
      <td width="25%"  class="label">Heading:<span>*</span></td>
      <td width="75%"><input type="text" name="heading" class="txt medium"  lang="R" title="Heading" value="<?=$heading?>" /></td>
    </tr>

	<tr>
      <td width="25%"  class="label">Title:<span>*</span></td>
      <td width="75%"><input type="text" name="title" class="txt medium"  lang="R" title="Title" value="<?=$title?>" /></td>
    </tr>

    <tr  class="grey_">
      <td width="25%" valign="top" class="label">Meta title:</td>
      <td width="75%"><textarea name="meta_title" cols="80" rows="5" id="meta_title"><?=$meta_title?></textarea></td>
    </tr>
    
   <tr>
      <td width="25%" valign="top"  class="label">Meta keywords :</td>
      <td width="75%"><textarea name="meta_keyword" cols="80" rows="5" id="meta_keyword"><?=$meta_keyword?></textarea></td>
    </tr>
	<tr  class="grey_">
	  <td valign="top" class="label">Meta description :</td>
	
	  <td><textarea name="meta_description" cols="80" rows="5" id="meta_description"><?=$meta_description?></textarea></td>
    </tr> 
	
    <tr class="grey_">
	  <td  width="25%"  class="label">Full description:</td>
	  <td width="75%"><?=$adm->get_editor('body', $cms->removeSlash($body))?></td>
    </tr>

	<tr class="grey_">
	  <td class="label">Header Nevigation:<span>*</span></td>
	  <td><select name="hnav"  class="txt" lang="R" title="Nevigation">
	  <option value="yes" <?=(($hnav=='yes')?'selected="selected"':'')?>>Yes</option>
	  <option value="no" <?=(($hnav=='no')?'selected="selected"':'')?>>No</option>
	  </select>	  </td>
    </tr>

	<tr class="grey_">
	  <td class="label">Footer Nevigation:<span>*</span></td>
	  <td><select name="fnav"  class="txt" lang="R" title="Nevigation">
	  <option value="no" <?=(($fnav=='no')?'selected="selected"':'')?>>No</option>
	  <option value="yes" <?=(($fnav=='yes')?'selected="selected"':'')?>>Yes</option>
	  
	  </select>	  </td>
    </tr>

	 <tr class="grey_">
	  <td class="label">Status:<span>*</span></td>
	  <td><select name="status"  class="txt" lang="R" title="Status">
	  <option value="Active" <?=(($status=='Active')?'selected="selected"':'')?>>Active</option>
	  <option value="Inactive" <?=(($status=='Inactive')?'selected="selected"':'')?>>Inactive</option>
	  </select>	  </td>
    </tr> 
     
	<tr>
	  <td>&nbsp;</td>
	  <td> 
	  <input type="submit" name="Submit" class="uibutton  loading"  value="Submit" /></td>
    </tr>	
  </table>
 
