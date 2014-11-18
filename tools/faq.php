<?php include("../lib/opin.inc.php")?>
<?php 
if($cms->is_post_back()){
	$cms->sqlquery("rs","faq",$_POST,'id',1);
	$adm->sessset('Record has been updated', 's');
	$cms->redir(SITE_PATH_ADM."faq.php", true);
}
$rsAdmin=$cms->db_query("SELECT * FROM #_faq WHERE id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin);
?>
<?php include_once "inc/header.inc.php"; ?>
 <div class="main">
   <header>
     
      <div class="hrd-right-wrap">
        <?php /*?><nav>
          <ul>
            <li> <a href="<?=SITE_PATH_ADM?>"></a> </li>
            <li> <a href="<?=SITE_PATH_ADM?>catalog/collections.php">Products</a> </li>
            <li> <a href="<?=SITE_PATH_ADM?>catalog/manage-category.php">Category</a> </li>
            <li> <a href="<?=SITE_PATH_ADM?>setting.php?mode=true">Setting</a> </li>
           <!-- <li> <a href="">System</a> </li>-->
          </ul>
        </nav><?php */?>
        
        <div class="brdcm" id="hed-tit"></div>
          
      </div>
      <div class="cl"></div>
    </header> 
    <div class="content"> 
    <?php $hedtitle = "Dashboard &rsaquo; FAQ"; ?>  
     
    <div class="internal-box"><?=$adm->alert()?>
      <div class="title">
         FAQ 
      </div>
      <div class="tbl-contant">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="frm-tbl2">
        <tr class="grey">
			<td width="18%" align="left" valign="middle">FAQ Details:*</td>
			<td>
				<?=$adm->get_editor('faq',stripslashes($faq))?>
			</td>
		</tr>
		<tr class="grey">
		  <td class="label">Status:<span>*</span></td>
		  <td><select  class="txt medium"  name="status" class="select" lang="R" title="Status">
		  <option value="Active" <?=(($status=='Active')?'selected="selected"':'')?>>Active</option>
		  <option value="Inactive" <?=(($status=='Inactive')?'selected="selected"':'')?>>Inactive</option>
		  </select>	  </td>
		</tr>
		
		  <td align="left" valign="middle">&nbsp;</td>
		  <td><input type="submit" name="Submit" class="uibutton  loading" value="Submit" /></td>
		  </tr>
       </table>
      </div>
      <div class="internal-rnd-footer"></div>
    </div>
  </div>  
    <? include"inc/footer.inc.php"; ?>
  </div>
  <div class="cl"></div>
</div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
</html>
