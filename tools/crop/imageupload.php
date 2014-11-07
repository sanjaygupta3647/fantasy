<?php 
    include("../../lib/opin.inc.php"); 
	$validImage  = array("jpg","jpeg","png","gif");
	$err = ""; 
 	 if($_POST[delete]!='')
		 {
			 foreach($_POST[imgagesid] as $val)
		 		{
							$image_name =  $cms->getSingleresult("select image from #_images where id='".$val."'");
							@unlink(UP_FILES_FS_PATH."/orginal/".$image_name);	 
							$cms->db_query("delete from #_images where id='$val'");  
		 		} 
		 }
	 
     $pathimg = ($_GET[image])?$_GET[image]:"collection";
	 if($delid){
				$image_name =  $cms->getSingleresult("select image from #_images where id='".$delid."'");
				if(trim($image_name)!="")
				{  
							@unlink(UP_FILES_FS_PATH."/orginal/".$image_name);	 
							$cms->db_query("delete from #_images where id='$delid'"); 
				}
				$redir = SITE_PATH_ADM.CPAGE."/imageupload.php?imgid=upimg&image=".$_GET[image];
		        echo "<script>self.location='".$redir."'</script>";  
	}
	if($_POST[upload])
	{
     	$end = strtolower(end(explode(".",$_FILES['file1']['name']))); 
		if(!in_array($end,$validImage))
		{
			$redir = SITE_PATH_ADM.CPAGE."/imageupload.php?imgid=upimg&image=".$_GET[image];
			 $err = "You have uploaded an invalid file!";
			 if($mess!=""){ echo "<script>alert('".$mess."')</script>";  } 
			 
			/*  echo "<script>self.location='".$redir."'</script>";  */
		}
		if($err=="")
		{
		$data1 = getimagesize($_FILES['file1'][tmp_name]);  
		$mess = "";
		 
		
	    $path = UP_FILES_FS_PATH."/orginal";/* path for original image to be saved*/ 
 		if($_FILES[file1][name]){
		$_POST['image'] = $cms->uploadFile($path,$_FILES['file1']['name'],'file1');  
		$arr[image] = $_POST['image'];
		$arr[path] =  $pathimg;
		$arr[remark] =$remark;
		$cms->sqlquery("rs","images",$arr);  
		$img = $path."/".$_POST['image'];  
		$redir = SITE_PATH_ADM.CPAGE."/imageupload.php?imgid=upimg&image=".$_GET[image];
		echo "<script>self.location='".$redir."'</script>";  
		}
	}  
	}
$cls = 'class="active"';
$cls2 = 'class="active2"';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Image upload and crop</title>
   <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
   <script type="text/javascript" src="js/jquery.imgareaselect-0.3.min.js"></script>
    <script type="text/javascript" src="<?=SITE_PATH_ADM?>js/jquery.popupWindow.js.js" ></script> 
    <link rel="stylesheet" href="<?=SITE_PATH_ADM?>crop/css/style.css" />
    <link rel="stylesheet" href="<?=SITE_PATH_ADM?>css/style.css" />
</head> 
<body>

<div class="wrap-box">

  
   <?php
	//DEF_PAGE_SIZE 
	$start = intval($start);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "select * ";
	$sql = " from #_images where 1 ";
	if($_GET[name]!=""){
		$order_by == '' ? $order_by = "(image = '".$_GET[name]."')+'id'" : true;
	   }
	   else
	$order_by == '' ? $order_by = 'id' : true; 
	$order_by2 == '' ? $order_by2 = 'desc' : true;
	$sql_count = "select count(*) ".$sql; 
	$sql .= "order by $order_by $order_by2 ";
	$sql .= "limit $start, $pagesize ";
    $sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$reccnt = $cms->db_scalar($sql_count);
	  
    $cls = 'style="text-decoration:underline; color:#C60"';
    $m=$_GET;
    unset($m['image']); 
    $qry_str = $cms->qry_str($m);?>
  
 
  
  <div class="col-right">
  <div class="upload radius">
   <div class="section"> 
       <label> Upload Photo <small>Note- Only <?=implode("/",$validImage)?> extension file is supported.<br /> </small>
         </label>
         <div>
           <form name="photo" enctype="multipart/form-data" action="" method="post">
             <div id="FileUpload">
                <input type="file" name="file1" required="required"  size="24" id="BrowserHidden" onChange="getElementById('FileField').value = getElementById('BrowserHidden').value;" /><input type="submit" style="height: 28px; padding: 0 10px; margin: -1px 0 0 5px;" id="submit" name="upload" value="Upload" />
                <?php
	 if($err!=""){?><span style="color:#F00; float:right "><?=$err?></span> <?php }
	 ?>     <div id="BrowserVisible">
                  <input type="text" id="FileField" />
                </div>
               <img style="position:absolute; display:none;" src="<?=SITE_PATH_ADM?>images/ajax-loader.gif" height="32" id="ajaximg" /> 
              </div>
               
        
 <!--  <input type="file" name="file1" size="30" /> -->
	</form>   <?php  
			 /*?><span class="f_help"><span class="red">Error</span>Text custom help</span><?php */?></div>
        </div>
  </div> 
   <div class="contens radius"> 
  	<form name="move" action=""  method="post">
   
    <table style="background:#CCC"   class="data-tbl pop-win" > <? if($reccnt){?>
    <tr><td colspan="7">
       
     <p> 
      <input type="submit" onClick="return confirm('Are you sure to delete this image?');" name="delete" value="delete" /></p> 
     
    </td></tr>
    <tr class="tbl-head tbl-head155"> 
    <th>COUNT</th>
    <th><input type="checkbox"  id="imgid" /></th>
     <th> IMAGE</th> <th>INSERT</th><th>DELETE</th></tr>
    
    <?php if($reccnt){ $i = 1; while ($line = $cms->db_fetch_array($result)){@extract($line);?>
    <tr <?=$adm->even_odd($nums)?>>
 	 <td align="center"><?=$i?></td> 
    <td align="center"><input type="checkbox" name="imgagesid[]" value="<?=$id?>" class="imgclass" /></td>
   
    <? 
   
     $siz2 = @getimagesize(SITE_PATH."uploaded_files/orginal/".$image); ?>
     <td align="center">
     <div class="frm555"><img class="ins-image" src="<?=SITE_PATH."uploaded_files/orginal/".$image;?>" alt="<?=$i?>" height="45"  /></div>
     <br />(<?=$siz2[0]."X".$siz2[1]?>)
      </td> 
    <td align="center"><div class="ins-image" alt="<?=$i?>" style="cursor:pointer" id="<?=$i?>" ><?=$image?></div></td>
   
    <td align="center"><a onClick="return confirm('Are you sure to delete this image?');" href="<?=SITE_PATH_ADM."crop/imageupload.php?imgid=".$_GET[imgid]."&delid=".$id."&crph=".$crph."&crpw=".$crpw."&image=".$_GET[image]?>">delete</a></td> 
    </tr>
    <?php $i++; } }} else{?>
	
	<tr><td colspan="5"> No Image Uploaded!</td></tr>
	<? }?>
    </table>
    </form>
 
  </div>
   <?php include("../inc/paging.inc.php")?> 
  </div>
 
<div class="clear"></div>
</div>

</body>
<script type="text/javascript">
$(".ins-image").click(function(){
	 var getid = $(this).attr('alt'); 
	 var val = $("#"+getid).html();   
	 window.opener.parent.document.getElementById("<?=$imgid?>").value = val;
	  window.close() 
	});
	
$('.crpimg').popupWindow({ 
centerScreen:1,
scrollbars:1
}); 
</script>
<script type="text/javascript">
            $(document).ready(function(){   
			$('#submit').click(function(){ 
			$('#ajaximg').show();
			});
			$('#imgid').click(function(){  
			 if($('#imgid').attr('checked')) {
					 $('input:checkbox').attr('checked','checked');
				} else {
					  $('input:checkbox').removeAttr('checked');
				}
			  }); 
			 });
</script>	
</html>
