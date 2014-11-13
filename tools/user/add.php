<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
if($cms->is_post_back()){
	if($updateid){
		$cms->sqlquery("rs","user",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","user",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_user where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
<table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
    <tr>
		<td width="25%"  class="label">User Name:</td>
		<td width="75%"><input type="text" name="userName"  lang="R" title="team Name" class="txt medium" value="<?=$userName?>" style="width: 17%;"/></td>
    </tr>
	<tr>
		<td width="25%"  class="label">Email Id:</td>
		<td width="75%"><input type="text" name="emailId"  lang="R" title="team Name" class="txt medium" value="<?=$emailId?>" style="width: 17%;"/></td>
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
 