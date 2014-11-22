<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("delete from #_matches where pid in ($id)");
		$cms->db_query("delete from #_batting where match_id in ($id)");
		$cms->db_query("delete from #_balling where match_id in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->createXmlFile();
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($cms->is_post_back()){
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("delete from #_matches where pid in ($str_adm_ids)");
				    $cms->db_query("delete from #_batting where match_id in ($str_adm_ids)");
					$cms->db_query("delete from #_balling where match_id in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					$cms->createXmlFile();
					break;
				case "Inactive":
					$cms->db_query("update #_matches set status = 'Inactive' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_matches set status = 'Active' where pid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	$cond = "";
	if($search){
		if($match) $cond .= " and title like '%".$match."%' " ;
		if($series){ 
			$series_id = $cms->getSingleresult("select pid from #_series where title = '$series'");
			$cond .= " and series_id = '$series_id' ";
		}  
		if($status) $cond .= " and status = '$status' " ;
	}
	$start = intval($start);
	$pagesize = DEF_PAGE_SIZE;
	$columns = "select * ";
	$sql = " from #_matches where 1 $cond ";
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
      <td width="6%" align="center"><?=$adm->orders('#',false)?></td>
      <td width="6%" align="center" valign="middle"><?=$adm->check_all()?></td>
      <td width="30%" align="center"><?=$adm->orders('Title',true)?></td>   
	  <td width="20%" align="center"><?=$adm->orders('Series',true)?></td> 
	  <td width="10%" align="center"><?=$adm->orders('Time',true)?></td>   
	  <td width="5%" align="center"><?=$adm->orders('Status',true)?></td>
      <td width="12%" align="center"><?=$adm->norders('Action')?></td>
    </tr>
    <?php if($reccnt){ $nums=1; while ($line = $cms->db_fetch_array($result)){@extract($line);?>
    <tr <?=$adm->even_odd($nums)?>>
    <td align="center"><?=$nums?></td>
    <td align="center"><?=$adm->check_input($pid)?></td>
    <td align="center">
	<b><?=$title?></b>&nbsp;  | &nbsp; 
	[<a href="<?=SITE_PATH."tools/match-summary/?match_id=".$pid?>">Summary</a>] &nbsp; 

	
	</td> 
	<td align="center"><?=$cms->getSingleresult("select title from #_series where pid = '$series_id'")?></td>
	 
     <td align="center" ><?=date("d M, Y",strtotime($match_date))?></td>
     <td align="center" class="<?=strtolower($status)?>"><?=$status?></td>
	<td align="center"><?=$adm->action(SITE_PATH_ADM.CPAGE."?mode=add",$pid)?></td>
    </tr>
    <?php $nums++;}}else{ echo $adm->rowerror(7);}?>   
  </table>
