<?php 
include("../../lib/opin.inc.php"); 
    if($delid){
				$image_name =  $cms->getSingleresult("select image from #_images where id='".$delid."'");
				if(trim($image_name)!="")
				{  
							@unlink(UP_FILES_FS_PATH."/orginal/".$image_name);							 
							@unlink(UP_FILES_FS_PATH."/thumb/".$image_name);
							$cms->db_query("delete from #_images where id='$delid'");
							 
				}
		}
	$path = UP_FILES_FS_PATH."/orginal";
 		if($_FILES[file1][name]){
		$_POST['image'] = $cms->uploadFile($path,$_FILES['file1']['name'],'file1'); 
		$arr[image] = $_POST['image'];
		$cms->sqlquery("rs","images",$arr);  
	}  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Romford image upload and crop</title>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect-0.3.min.js"></script>
    <script type="text/javascript" src="<?=SITE_PATH_ADM?>js/jquery.popupWindow.js.js" ></script> 
    <link rel="stylesheet" href="<?=SITE_PATH_ADM?>css/style.css" />
</head>
<body  >
  <div class="div-tbl">
        <div class="title">
          <div class="fl"> Album Gallery </div>
          <div class="tbl-search">
       <!--      <input class="search-txt" value="Search" name="" type="text"   onclick="if(this.value=='Search'){this.value=''}" onblur="if(this.value==''){this.value='Search'}">
            <input type="image"   name="" src="images/search-icon.png" class="search-btn" > -->
            <div class="cl"></div>
          </div>
          <div class="cl"></div>
        </div>
        <div class="tbl-contant">
        <div class="section">
          <label> Upload Photo <small>Note- Only Jpeg/Jpg extension file is supported.</small></label>
         <div>
           <form name="photo" enctype="multipart/form-data" action="" method="post">
             <div id="FileUpload">
                <input type="file" name="file1"  size="24" id="BrowserHidden" onchange="getElementById('FileField').value = getElementById('BrowserHidden').value;" />
                <div id="BrowserVisible">
                  <input type="text" id="FileField" />
                </div>
              </div>
               
              
 <!--  <input type="file" name="file1" size="30" /><input type="submit" name="upload" value="Upload" /> -->
	</form>
    <?php
	$start = intval($start);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "select * ";
	$sql = " from #_images where 1 ";
	$order_by == '' ? $order_by = 'id' : true;
	$order_by2 == '' ? $order_by2 = 'desc' : true;
	$sql_count = "select count(*) ".$sql; 
	$sql .= "order by $order_by $order_by2 ";
	$sql .= "limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$reccnt = $cms->db_scalar($sql_count);
	?>
    
   
            <span class="f_help"><span class="red">Error</span>Text custom help</span></div>
        </div>
  <div class="hr">	</div>
	
    <table width="100%" cellpadding="0" cellspacing="0" border="0"   class="data-tbl" >
    <tr class="tbl-head tbl-head155"><th>ID</th><th>IMAGE</th><th>THUMB</th><th>INSERT</th><th>CROP</th><th>DELETE</th></tr>
    <?php if($reccnt){ while ($line = $cms->db_fetch_array($result)){@extract($line);?>
    <tr <?=$adm->even_odd($nums)?>>
    <td align="center"><?=$id?></td>
    <td align="center"><img src="<?=SITE_PATH."uploaded_files/orginal/".$image;?>" height="45"  /></td>
     <td align="center">
     <?php
	 if(file_exists(UP_FILES_FS_PATH."/thumb/".$image)){?><img src="<?=SITE_PATH."uploaded_files/thumb/".$image;?>" height="45" /><?php } else echo "NA";
	 ?>
     </td>
    <td align="center"><div class="ins-image" style="cursor:pointer"><?=$image?></div></td>
    <td align="center"><a href="<?=SITE_PATH_ADM."crop/upload_crop.php?imgid=".$_GET[imgid]."&id=".$id."&crph=".$crph."&crpw=".$crpw?>" class="crpimg">crop</a></td>
    <td align="center"><a onclick="return confirm('Are you sure to delete this image?');" href="<?=SITE_PATH_ADM."crop/imageupload.php?imgid=".$_GET[imgid]."&delid=".$id."&crph=".$crph."&crpw=".$crpw?>">delete</a></td> 
    </tr>
    <?php } }?>
    </table>
    </div>
</div>
 
</body>
<script type="text/javascript">
$(".ins-image").click(function(){
	 var val = $(this).html(); 
	 window.opener.parent.document.getElementById("<?=$imgid?>").value = val;
	 window.close() 
	});
	
$('.crpimg').popupWindow({ 
centerScreen:1,
scrollbars:1
}); 
</script>
</html>
