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
		<td width="75%"><input type="text" name="prediction"  lang="R" title="team Name" class="txt medium" value="<?=$prediction?>" /></td>
    </tr>
	<tr>
		<td width="25%"  class="label">Prediction Points:</td>
		<td width="75%"><input type="text" name="prediction_points"  lang="R" title="team Name" class="txt medium" value="<?=$prediction_points?>" /></td>
    </tr>
	<tr>
		<td width="25%"  class="label">Prediction Gift:</td>
		<td width="75%"><input type="text" name="prediction_gift"  lang="R" title="team Name" class="txt medium" value="<?=$prediction_gift?>" /></td>
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
 