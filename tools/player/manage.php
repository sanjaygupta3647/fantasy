<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("delete from #_player where pid in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("delete from #_player where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_player set status = 'Inactive' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_player set status = 'Active' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	$start = intval($start);
	$pagesize = DEF_PAGE_SIZE;
	$columns = "select * ";
	$sql = " from #_player where 1 ";
	$order_by == '' ? $order_by = 'pid' : true;
	$order_by2 == '' ? $order_by2 = 'desc' : true;
	$sql_count = "select count(*) ".$sql; 
	$sql .= "order by $order_by $order_by2 ";
	$sql .= "limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$reccnt = $cms->db_scalar($sql_count);
?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="data-tbl">
    <tr class="t-hdr">
      <td width="3%" align="center"><?=$adm->orders('#',false)?></td>
      <td width="3%" align="center" valign="middle"><?=$adm->check_all()?></td>
      <td width="10%" align="center"><?=$adm->orders('Player Name',true)?></td>   
	  <td width="8%" align="center"><?=$adm->orders('Player Image',true)?></td>   
	  <td width="10%" align="center"><?=$adm->orders('Team ID',true)?></td>   
	  <td width="8%" align="center"><?=$adm->orders('Team Image',true)?></td>   
	  <td width="5%" align="center"><?=$adm->orders('Age',true)?></td>   
	  <td width="10%" align="center"><?=$adm->orders('Player Profile',true)?></td>   
	  <td width="6%" align="center"><?=$adm->orders('Status',true)?></td>
      <td width="5%" align="center"><?=$adm->norders('Action')?></td>
    </tr>
    <?php if($reccnt){ $nums=1; while ($line = $cms->db_fetch_array($result)){@extract($line);?>
    <tr <?=$adm->even_odd($nums)?>>
    <td align="center"><?=$nums?></td>
    <td align="center"><?=$adm->check_input($pid)?></td>
    <td align="center"><?=$playerName?></td>
	<td align="center"><?php
	 if($playerImage and is_file($_SERVER['DOCUMENT_ROOT'].SITE_SUB_PATH."uploaded_files/orginal/".$playerImage)==true){?>
		<img src="<?=SITE_PATH?>uploaded_files/orginal/<?=$playerImage?>" height="75">
	 <?}else echo "N/A"; 
	 ?></td>
     <td align="center" ><?php  $teamName = $cms->getSingleresult("SELECT name FROM #_team WHERE pid = '".$teamId."'"); ?><?=$teamName?></td>
	 <td align="center"><?php
	 $teamImage = $cms->getSingleresult("SELECT image FROM #_team WHERE pid = '".$teamId."'");
	 if($teamImage and is_file($_SERVER['DOCUMENT_ROOT'].SITE_SUB_PATH."uploaded_files/orginal/".$teamImage)==true){?>
		<img src="<?=SITE_PATH?>uploaded_files/orginal/<?=$teamImage?>" height="75">
	 <?}else echo "N/A"; 
	 ?></td>
	 <td align="center" ><?=$age?></td>
	 <td align="center" ><?=$playerProfile?></td>
     <td align="center" class="<?=strtolower($status)?>"><?=$status?></td>
	<td align="center"><?=$adm->action(SITE_PATH_ADM.CPAGE."?mode=add",$pid)?></td>
    </tr>
    <?php $nums++;}}else{ echo $adm->rowerror(7);}?>   
  </table>
