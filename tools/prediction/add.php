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
				<?php
					foreach($predictionlist as $val){?>
						<option value="<?=$val?>" <?=(($prediction==$val)?'selected="selected"':'')?>><?=$val?></option>
					<?php
					}
				?> 
				</select>
		</td>
    </tr>
	<tr  class="">
	  <td valign="top" class="label">Description :</td>
	
	  <td>
	  <?=$adm->get_editor('body',stripslashes($body))?>
	 </td>
    </tr>
	<tr>
		<td width="25%"  class="label">Prediction Points:</td>
		<td width="75%"><input type="text" name="prediction_points"  lang="R" title="team Name" class="txt medium" value="<?=$prediction_points?>" style="width: 17%;"/></td>
    </tr>
	
	<tr>
	  <td class="label">Prediction Open Till:<span>*</span></td>
	  <td>
		  <select  class="txt medium"  name="prediction_before_after" class="select" lang="R" title="Status">
			<option value="before" <?=(($prediction_before_after=='before')?'selected="selected"':'')?>>Before</option>
			<option value="after" <?=(($prediction_before_after=='after')?'selected="selected"':'')?>>After</option>
		  </select>	  
	  </td>
    </tr>

	<tr>
	  <td class="label">Time:<span>*</span></td>
	  <td>
		  <select  class="txt medium"  name="minutes" class="select" lang="R" title="Time"> 
			<?php
				for($i=0; $i<=1000; $i++){?>
					<option value="<?=$i?>" <?=(($minutes==$i)?'selected="selected"':'')?>><?=$i?> Minutes</option>
				<?php
				}
			?> 
		  </select>	  
	  </td>
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
 