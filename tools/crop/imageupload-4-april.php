<?php 
    include("../../lib/opin.inc.php"); 
	$validImage  = array("jpg","jpeg","png","gif");
	$err = "";
		switch ($_GET[image]){
				case "gallery":
					$crpbigw = 977;
					$crpbigh = 350;
					$crpw = 125;
					$crph = 90;
					$n = "gal";
					 break;
				case "collection":
					$crpbigw = 481;
					$crpbigh = 409;
					$crpw = 179;
					$crph = 128; 
				
						 break;
				case "be-inspired":
					$crpbigw = 979;
					$crpbigh = 449;
					$crpw = 300;
					$crph = 190;
					$n = "be_ins";
					 break;
				case "news":
					$crpbigw = 186;
					$crpbigh = 160;
					$crpw = 186;
					$crph = 160;
					$n = "news";
					 break;
				case "brochures":
					$crpbigw = 142;
					$crpbigh = 145;
					$crpw = 142;
					$crph = 145;
					$n = "broch";
					break;
				case "category":
					$crpbigw = 238;
					$crpbigh = 114;
					$crpw = 142;
					$crph = 145;
					$n = "cate";
					break;
		         case "banner":
					$crpbigw = 977;
					$crpbigh = 183;
					$crpw = 178;
					$crph = 131;
					$n = "banner";
					 break;
				default:
				    $crpbigw = 400;
					$crpbigh = 550; 
					$crpw = 315;
					$crph = 200; 
					$n = "";
				}
	$remark = ($_GET[image])?$_GET[image]:'orginal';	
	if($_POST[movloc]){
	if(is_array($_POST[imgagesid]))
	{
		 foreach($_POST[imgagesid] as $val)
		 {
				if($val)@$cms->db_query("update #_images set path='".$_POST[movloc]."', remark='$remark' where id='$val'");   
		 }
	}
	else
	{
	  $err = 'Please choose atleast one image!';	
	}
	}
    $pathimg = ($_GET[image])?$_GET[image]:"orginal";
	 if($delid){
				$image_name =  $cms->getSingleresult("select image from #_images where id='".$delid."'");
				if(trim($image_name)!="")
				{  
							@unlink(UP_FILES_FS_PATH."/orginal/".$image_name);							 
							@unlink(UP_FILES_FS_PATH."/thumb/".$image_name);
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
		if($data1[0]<$crpbigw ||  $data[1]<$crpbigh)
		{
			$mess = "Best size for this is ".$crpbigw." X ".$crpbigh.". So the image may be distorted!";
		}
		/*if($mess!=""){ echo "<script>alert('".$mess."')</script>";  }*/
		
	    $path = UP_FILES_FS_PATH."/orginal";
		$thumpath = UP_FILES_FS_PATH."/thumb";  
 		if($_FILES[file1][name]){
		$_POST['image'] = $cms->uploadFile($path,$_FILES['file1']['name'],'file1');
		$img = $path."/".$_POST['image'];
		$data = getimagesize($img);
 		$width = $data[0]; 
 		$height = $data[1]; 
		$cms->make_thumb($path."/".$_POST['image'], $path."/".$n.$_POST['image'],$crpbigw,$crpbigh);	
		$arr[image] = $n.$_POST['image'];
		$arr[path] = $pathimg;
		$arr[remark] =$remark;
		$cms->sqlquery("rs","images",$arr);   
		$cms->make_thumb($path."/".$_POST['image'], $thumpath."/".$_POST['image'],$crpw,$crph);
		$cms->make_thumb($path."/".$arr[image], $thumpath."/".$arr[image],$crpw,$crph);
		$arr[image] = $_POST['image'];
		$arr[path] = "orginal";
		$arr[remark] =$remark;
		//$arr[path] = $pathimg;
		$cms->sqlquery("rs","images",$arr);  
		$redir = SITE_PATH_ADM.CPAGE."/imageupload.php?imgid=upimg&image=".$_GET[image];
		echo "<script>self.location='".$redir."'</script>";  
		}
	}  
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
          <label> Upload Photo <small>Note- Only <?=implode("/",$validImage)?> extension file is supported.<br /> </small>
         <strong> Best Size Large:(<?=$crpbigw."X".$crpbigh?>)<br /> Best Size Croped:(<?=$crpw."X".$crph?>) </strong></label>
         <div>
           <form name="photo" enctype="multipart/form-data" action="" method="post">
             <div id="FileUpload">
                <input type="file" name="file1" required="required"  size="24" id="BrowserHidden" onChange="getElementById('FileField').value = getElementById('BrowserHidden').value;" /><input type="submit" style="height: 28px; padding: 0 10px; margin: -1px 0 0 5px;" id="submit" name="upload" value="Upload" />
                <?php
	 if($err!=""){?><span style="color:#F00; float:right "><?=$err?></span> <?php }
	 ?>     <div id="BrowserVisible">
                  <input type="text" id="FileField" />
                </div>
               <img style="position:absolute; display:none;" src="<?=SITE_PATH?>images/ajax-loader.gif" height="32" id="ajaximg" /> 
              </div>
               
        
 <!--  <input type="file" name="file1" size="30" /> -->
	</form>
    <?php
	//DEF_PAGE_SIZE 
	$start = intval($start);
	$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	$columns = "select * ";
	$sql = " from #_images where path = '$pathimg' ";
	$order_by == '' ? $order_by = '(id+remark)' : true;
	$order_by2 == '' ? $order_by2 = 'desc' : true;
	$sql_count = "select count(*) ".$sql; 
	$sql .= "order by $order_by $order_by2 ";
	$sql .= "limit $start, $pagesize ";
    $sql = $columns.$sql;
	$result = $cms->db_query($sql);
	$reccnt = $cms->db_scalar($sql_count);
	?>
     
   
            <?php 
			$cls = 'style="text-decoration:underline; color:#C60"';
			$m=$_GET;
			unset($m['image']); 
			$qry_str = $cms->qry_str($m);
			 /*?><span class="f_help"><span class="red">Error</span>Text custom help</span><?php */?></div>
        </div>
  <div class="hr">	</div>
	<form name="move" action=""  method="post">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#CCC;"   class="data-tbl" >
    <tr><td colspan="7">
      <p><a <? if($pathimg=='orginal') echo $cls; ?> href="<?=$PHP_SELF?><?=$qry_str?>&image=orginal">Orginal</a>&nbsp;&nbsp;
        <a <? if($pathimg=='banner') echo $cls; ?> href="<?=$PHP_SELF?><?=$qry_str?>&image=banner">Banner</a>&nbsp;&nbsp;
        <a <? if($pathimg=='gallery') echo $cls; ?> href="<?=$PHP_SELF?><?=$qry_str?>&image=gallery">Gallery</a>&nbsp;&nbsp;
        <a <? if($pathimg=='collection') echo $cls; ?>  href="<?=$PHP_SELF?><?=$qry_str?>&image=collection">Collection</a>&nbsp;&nbsp;
        <a <? if($pathimg=='be-inspired') echo $cls; ?> href="<?=$PHP_SELF?><?=$qry_str?>&image=be-inspired">Be-inspired</a>&nbsp;&nbsp; 
        <a <? if($pathimg=='brochures') echo $cls; ?> href="<?=$PHP_SELF?><?=$qry_str?>&image=brochures">Brochures</a>&nbsp;&nbsp;
        <a <? if($pathimg=='category') echo $cls; ?> href="<?=$PHP_SELF?><?=$qry_str?>&image=category">Category</a>&nbsp;&nbsp;
        <a <? if($pathimg=='news') echo $cls; ?> href="<?=$PHP_SELF?><?=$qry_str?>&image=news">News</a>&nbsp;&nbsp;</p>
      <div class="alertMessage info SE" ><p>1. Please
        check the boxes and select the prefered location to move the images</p>
      <p>2. Click on the image which you want to use!</p></div>
    <select class="select" id="movloc" onChange="document.move.submit()"  name="movloc" style="float:right;">
    <option value="">---Select Location---</option>
    <option value="orginal">Orginal</option>
    <option value="collection">Collection</option>
    <option value="be-inspired">Be-inspired</option>
    <option value="banner">Banner</option>
    <option value="gallery">Gallery</option>
    <option value="brochures">Brochures</option>
    <option value="category">Category</option>
    <option value="news">News</option>
    </select>
      </p>
    
    </td></tr>
    <tr class="tbl-head tbl-head155"><th><input type="checkbox"  id="imgid" /></th><th>Used For</th><th>IMAGE</th><th>THUMB</th><th>INSERT</th><th>DELETE</th></tr>
    <?php if($reccnt){ $i = 1; while ($line = $cms->db_fetch_array($result)){@extract($line);?>
    <tr <?=$adm->even_odd($nums)?>> 
    <td align="center"><input type="checkbox" name="imgagesid[]" value="<?=$id?>" class="imgclass" /></td>
    <td align="center"><?=ucfirst($remark)?></td>
    <?php  $siz = @getimagesize(SITE_PATH."uploaded_files/orginal/".$image); ?>
     <td align="center"><img class="ins-image" src="<?=SITE_PATH."uploaded_files/orginal/".$image;?>" alt="<?=$i?>" height="45"  />
     <br />(<?=$siz[0]."X".$siz[1]?>)</td>
     <td align="center">
     <?php
	 $sizth = @getimagesize(SITE_PATH."uploaded_files/thumb/".$image);  
	 if(file_exists(UP_FILES_FS_PATH."/thumb/".$image)){?><img class="ins-image" alt="<?=$i?>" src="<?=SITE_PATH."uploaded_files/thumb/".$image;?>" height="45" /><br />(<?=$sizth[0]."X".$sizth[1]?>)<?php } ?><br /><a   href="<?=SITE_PATH_ADM."crop/upload_crop.php?imgid=".$_GET[imgid]."&id=".$id."&image=".$_GET[image]?>" class="crpimg">crop</a> 
	 
     </td>
    <td align="center"><div class="ins-image" alt="<?=$i?>" style="cursor:pointer" id="<?=$i?>" ><?=$image?></div></td>
   
    <td align="center"><a onClick="return confirm('Are you sure to delete this image?');" href="<?=SITE_PATH_ADM."crop/imageupload.php?imgid=".$_GET[imgid]."&delid=".$id."&crph=".$crph."&crpw=".$crpw."&image=".$_GET[image]?>">delete</a></td> 
    </tr>
    <?php $i++; } }?>
    </table>
    </form>
      <?php include("../inc/paging.inc.php")?>
    </div>
   

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
