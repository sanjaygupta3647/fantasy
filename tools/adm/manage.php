<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php 
	if($action=='del'){
		$cms->db_query("delete from #_administrator where aid in ($id)");
		$adm->sessset('Record has been deleted', 'e');
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	if($cms->is_post_back()) {
		if($arr_ids) {
			$str_adm_ids = implode(",",$arr_ids);
			switch ($_POST['action']){
				case "delete":
					$cms->db_query("delete from #_administrator where aid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Delete', 'e');
					break;
				case "Inactive":
					$cms->db_query("update #_administrator set astatus = 'Inactive' where aid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Inactive', 'e');
					break;
				case "Active":
					$cms->db_query("update #_administrator set astatus = 'Active' where aid in ($str_adm_ids)");
					$adm->sessset(count($arr_ids).' Item(s) Active', 's');
					break;
				default:
			}
		}
		$cms->redir(SITE_PATH_ADM.CPAGE, true);
		exit;
	}
	$start = intval($start);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "select * ";
	$sql = " from #_administrator where `atype`!='su' ";
	$order_by == '' ? $order_by = 'aid' : true;
	$order_by2 == '' ? $order_by2 = 'desc' : true;
	$sql_count = "select count(*) ".$sql; 
	$sql .= "order by $order_by $order_by2 ";
	$sql .= "limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$reccnt = $cms->db_scalar($sql_count);
?>
<div class="internal-data">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="data-tbl">
    <tr class="t-hdr">
      <td width="4%" align="center"><?=$adm->orders('#',false)?></td>
      <td width="4%" align="center" valign="middle"><?=$adm->check_all()?></td>
      <td width="27%" align="center"><?=$adm->orders('Username/Pwd',true)?></td>
      <td width="22%" align="center"><?=$adm->orders('Name',true)?></td>
      <td width="24%" align="center"><?=$adm->orders('Email id',true)?></td>
      <td width="9%" align="center"><?=$adm->orders('Status',true)?></td>
      <td width="10%" align="center"><?=$adm->norders('Action')?></td>
    </tr>
    <?php if($reccnt){ $nums=1; while ($line = $cms->db_fetch_array($result)){@extract($line);?>
    <tr <?=$adm->even_odd($nums)?>>
    <td align="center"><?=$nums?></td>
    <td align="center"><?=$adm->check_input($aid)?></td>
        <td align="center"><?=$ausername."/".base64_decode($apassword)?></td>
    <td align="center"><?=$afname." ".$alname?></td>
    <td align="center"><?=$aemail?></td>
    <td align="center" class="<?=strtolower($astatus)?>"><?=$astatus?></td>
    <td align="center"><?=$adm->action(SITE_PATH_ADM.CPAGE."?mode=add",$aid)?></td>

    </tr>
    <?php $nums++;}}else{ echo $adm->rowerror(7);} ?>   
  </table>
</div>