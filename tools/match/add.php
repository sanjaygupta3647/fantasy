<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
  
if($cms->is_post_back()){
	//$cms->createXmlFile();
	$_POST[title] = $_POST[match_num]." ".$_POST[type]." - ".$cms->getSingleresult("select name from #_team where pid='".$_POST[team1]."'")." vs ".$cms->getSingleresult("select name from #_team where pid='".$_POST[team2]."'");
	
	if($d<10) {$d = "0".$d;   }
	if($m<10) {$m = "0".$m;  }
	if($m<10) {$h = "0".$h;  }
	if($m<10) {$minutes = "0".$minutes;  }
	$_POST[match_date] = $y."-".$m."-".$d." ".$h.":".$minutes.":"."00";
	$_POST[show_default] = (int)$_POST[show_default];
	if($updateid){
		$cms->sqlquery("rs","matches",$_POST,'pid',$updateid);
		$adm->sessset('Record has been updated', 's');
	}else{ 
		$cms->sqlquery("rs","matches",$_POST);
		$updateid = mysql_insert_id();
		$adm->sessset('Record has been added', 's'); 
	}
	$up[url] = $adm->baseurl($_POST[title])."-live-streaming-$updateid";
	$cms->sqlquery("rs","matches",$up,'pid',$updateid);

	$path = SITE_PATH_ADM.CPAGE."?mode=add&id=".$updateid;
	$cms->redir($path, true);
}	
if(isset($id)){
	$rsAdmin=$cms->db_query("select * from #_matches where pid='".$id."'");
	$arrAdmin=$cms->db_fetch_array($rsAdmin);
	@extract($arrAdmin);
}
?>
 
  <table width="100%" border="0" align="left" cellpadding="4" cellspacing="1" class="frm-tbl2">
   <tr>
      <td width="25%"  class="label">Select Series:</td>
      <td width="75%"><select name="series_id" class="txt medium"  lang="R">
	  				<option value="0">----Select---</option>
	  				<?php
					$curdate = date("Y-m-d");
					$rsAdmin2=$cms->db_query("select pid,title from #_series where status='Active' and series_edate >= '$curdate'  order by title");
					while($arrAdmin2=$cms->db_fetch_array($rsAdmin2)){?>
					<option value="<?=$arrAdmin2[pid]?>" <?php if($arrAdmin2[pid]==$series_id) echo'selected="selected"';?>><?=$arrAdmin2[title]?></option>
					<?php 
					}
					?></select>
	</td>
    </tr>
     
   <tr>
      <td width="25%"  class="label">Title:</td>
      <td width="75%">
	  Match Number:<select name="match_num" class="txt medium">
	  <option value="" <?php if(''==$match_num)echo'selected="selected"';?>>---None---</option>
	  <option value="1st" <?php if('1st'==$match_num)echo'selected="selected"';?>>1st</option>
	  <option value="2nd" <?php if('2nd'==$match_num)echo'selected="selected"';?>>2nd</option>
	  <option value="3rd" <?php if('3rd'==$match_num)echo'selected="selected"';?>>3rd</option> 
	  <?php 
	  for($i=4; $i<=20;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  <option value="21st" <?php if('21st'==$match_num)echo'selected="selected"';?>>21st</option>
	  <option value="22nd" <?php if('22nd'==$match_num)echo'selected="selected"';?>>22nd</option>
	  <option value="23rd" <?php if('23rd'==$match_num)echo'selected="selected"';?>>23rd</option> 
	  <?php 
	  for($i=24; $i<=30;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  <option value="31st" <?php if('31st'==$match_num)echo'selected="selected"';?>>31st</option>
	  <option value="32nd" <?php if('32nd'==$match_num)echo'selected="selected"';?>>32nd</option>
	  <option value="33rd" <?php if('33rd'==$match_num)echo'selected="selected"';?>>33rd</option> 
	  <?php 
	  for($i=34; $i<=40;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  <option value="41st" <?php if('41st'==$match_num)echo'selected="selected"';?>>41st</option>
	  <option value="42nd" <?php if('42nd'==$match_num)echo'selected="selected"';?>>42nd</option>
	  <option value="43rd" <?php if('43rd'==$match_num)echo'selected="selected"';?>>43rd</option> 
	  <?php 
	  for($i=44; $i<=50;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  <option value="51st" <?php if('51st'==$match_num)echo'selected="selected"';?>>51st</option>
	  <option value="52nd" <?php if('52nd'==$match_num)echo'selected="selected"';?>>52nd</option>
	  <option value="53rd" <?php if('53rd'==$match_num)echo'selected="selected"';?>>53rd</option> 
	  <?php 
	  for($i=54; $i<=60;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  <option value="61st" <?php if('61st'==$match_num)echo'selected="selected"';?>>61st</option>
	  <option value="62nd" <?php if('62nd'==$match_num)echo'selected="selected"';?>>62nd</option>
	  <option value="63rd" <?php if('63rd'==$match_num)echo'selected="selected"';?>>63rd</option> 
	  <?php 
	  for($i=64; $i<=70;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  <option value="71st" <?php if('71st'==$match_num)echo'selected="selected"';?>>71st</option>
	  <option value="72nd" <?php if('72nd'==$match_num)echo'selected="selected"';?>>72nd</option>
	  <option value="73rd" <?php if('73rd'==$match_num)echo'selected="selected"';?>>73rd</option> 
	  <?php 
	  for($i=74; $i<=80;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	   <option value="81st" <?php if('81st'==$match_num)echo'selected="selected"';?>>81st</option>
	  <option value="82nd" <?php if('82nd'==$match_num)echo'selected="selected"';?>>82nd</option>
	  <option value="83rd" <?php if('83rd'==$match_num)echo'selected="selected"';?>>83rd</option> 
	  <?php 
	  for($i=84; $i<=90;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  <option value="91st" <?php if('91st'==$match_num)echo'selected="selected"';?>>91st</option>
	  <option value="92nd" <?php if('92nd'==$match_num)echo'selected="selected"';?>>92nd</option>
	  <option value="93rd" <?php if('93rd'==$match_num)echo'selected="selected"';?>>93rd</option> 
	  <?php 
	  for($i=94; $i<=100;$i++){
		  $j = $i."th";
	  ?><option value="<?=$j?>" <?php if($j==$match_num)echo'selected="selected"';?>><?=$j?></option><?php
	  }
	  ?>
	  </select>
	  Match Type:<select name="type" class="txt medium"> 
	  <option value="ODI" <?php if($type=='ODI')echo'selected="selected"';?>>ODI</option>
	  <option value="Test" <?php if($type=='Test')echo'selected="selected"';?>>Test</option>
	  <option value="T20" <?php if($type=='T20')echo'selected="selected"';?>>T20</option>
	  <option value="Semi Final T20" <?php if($type=='Semi Final T20')echo'selected="selected"';?>>Semi Final T20</option>
	  <option value="Qualifier T20" <?php if($type=='Qualifier T20')echo'selected="selected"';?>>Qualifier T20</option>
	  <option value="Eliminator T20" <?php if($type=='Eliminator T20')echo'selected="selected"';?>>Eliminator T20</option>
	  <option value="Final T20" <?php if($type=='Final T20')echo'selected="selected"';?>>Final T20</option>
	  <option value="Final ODI" <?php if($type=='Final ODI')echo'selected="selected"';?>>Final ODI</option>
	  <option value="Quarter-Final ODI" <?php if($type=='Quarter-Final ODI')echo'selected="selected"';?>>Quarter-Final ODI</option>
	  <option value="Semi-Final ODI" <?php if($type=='Semi-Final ODI')echo'selected="selected"';?>>Semi-Final ODI</option>
	  </select>
	  Team1:<select name="team1" class="txt medium"> 
	  <?php
	  $rsAdmin2=$cms->db_query("select * from #_team where status='Active' order by name");
	  while($arrAdmin2=$cms->db_fetch_array($rsAdmin2)){@extract($arrAdmin2);
	  ?><option value="<?=$pid?>" <?php if($pid==$team1)echo'selected="selected"';?>><?=$name?></option><?php
	  }
	  ?>
	  </select>
	  <strong> vs </strong>
	   Team2:<select name="team2" class="txt medium"> 
	  <?php
	  $rsAdmin2=$cms->db_query("select * from #_team where status='Active' order by name");
	  while($arrAdmin2=$cms->db_fetch_array($rsAdmin2)){@extract($arrAdmin2);
	  ?><option value="<?=$pid?>" <?php if($pid==$team2)echo'selected="selected"';?>><?=$name?></option><?php
	  }
	  ?>
	  </select>
	  
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
   <tr>
      <td width="25%"  class="label">Place:</td>
      <td width="75%"><input type="text" name="place"  lang="R" title="Place" class="txt medium" value="<?=$place?>" /></td>
   </tr>
   <tr>
      <td width="25%"  class="label">Match Time:</td>
      <td width="75%">Day:<select name="d" class="txt medium">
	  <?php
	  for($i=1; $i<=31;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$d)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select>
	  
 	  Month:<select name="m" class="txt medium">
	  <?php
	  for($i=1; $i<=12;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$m)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select>
	  Year:<select name="y" class="txt medium">
	  <?php
	  $cr = date('Y');
	  $next = $cr+5;
	  for($i=$cr; $i<=$next;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$y)echo'selected="selected"';?>><?=$i?></option><?php
	  }
	  ?>
	  </select>
	  Hours:<select name="h" class="txt medium">
	  <?php 
	  for($i=0; $i<=24;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$h)echo'selected="selected"';?>><?=($i<10)?"0".$i:$i?></option><?php
	  }
	  ?>
	  </select>
	  Minutes:<select name="minutes" class="txt medium">
	  <?php 
	  for($i=0; $i<=60;$i++){
	  ?><option value="<?=$i?>" <?php if($i==$minutes)echo'selected="selected"';?>><?=($i<10)?"0".$i:$i?></option><?php
	  }
	  ?>
	  </select>

	  </td>
   </tr>
   <tr>
      <td width="25%"  class="label">Default Message:</td>
	  <?
	  if(!$id){
		$ch = 'checked="checked"';
	  }
	  else{
		 if($show_default){
			$ch = 'checked="checked"';
		  }
	  }
	  ?>
      <td width="75%"><input type="checkbox" name="show_default" <?=$ch?>  value="1" /> Check To Show Default Message</td>
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
 