<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("delete from #_prediction where pid in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("delete from #_prediction where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_prediction set status = 'Inactive' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_prediction set status = 'Active' where pid in ($str_adm_ids)");
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
	$sql = " from #_prediction where 1 ";
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
      <td width="10%" align="center"><?=$adm->orders('#',false)?></td>
      <td width="10%" align="center" valign="middle"><?=$adm->check_all()?></td>
      <td width="20%" align="center"><?=$adm->orders('Prediction',true)?></td>   
	  <td width="15%" align="center"><?=$adm->orders('Prediction Points',true)?></td>
	  
	  <td width="12%" align="center"><?=$adm->norders('Prediction Open Till')?></td>
	  <td width="12%" align="center"><?=$adm->norders('Time')?></td>

	  <td width="15%" align="center"><?=$adm->orders('Status',true)?></td>
      <td width="12%" align="center"><?=$adm->norders('Action')?></td>
    </tr>
    <?php if($reccnt){ $nums=1; while ($line = $cms->db_fetch_array($result)){@extract($line);?>
    <tr <?=$adm->even_odd($nums)?>>
    <td align="center"><?=$nums?></td>
    <td align="center"><?=$adm->check_input($pid)?></td>
    <td align="center"><?=$prediction?></td>
    <td align="center"><?=$prediction_points?></td>
	<td align="center"><?=ucfirst($prediction_before_after)?></td>
	<td align="center"><?=$minutes?> Minutes</td>
	<td align="center" class="<?=strtolower($status)?>"><?=$status?></td>
	<td align="center"><?=$adm->action(SITE_PATH_ADM.CPAGE."?mode=add",$pid)?></td>
    </tr>
    <?php $nums++;}}else{ echo $adm->rowerror(7);}?>   
  </table>
