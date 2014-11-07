<?php
include("../../lib/opin.inc.php");
	$getImageSiteDetail  = $cms->getImageSiteDetail($_GET[image]); 
	$crpw= $getImageSiteDetail[2];
	$crph= $getImageSiteDetail[3];
	$n= $getImageSiteDetail[4];
					 
$upload_dir = UP_FILES_FS_PATH."/orginal"; 	
$small = UP_FILES_FS_PATH."/thumb/"; 			// The directory for the images to be saved in
$upload_path = $upload_dir."/";				// The path to where the image will be saved
//$large_image_name = $imgName; 		// New name of the large image
//$thumb_image_name = $imgName; 	// New name of the thumbnail image
$max_file = "1148576"; 						// Approx 1MB
$max_width = "500";							// Max width allowed for the large image
$thumb_width = ($crpw)?$crpw:"250"; 						// Width of thumbnail image
$thumb_height = ($crph)?$crph:"320";						// Height of thumbnail image  
$imageMain =  $cms->getSingleresult("select image from #_images where id = '$id'"); 
if($imageMain!="")
{ 
 $large_image_location =$upload_path.$imageMain; 
 $thumb_image_location =$small.$imageMain; 
 $thumb_image_name =  $imageMain; 
 $large_image_name = $imageMain; 
}
//Image functions
//You do not need to alter these functions
function resizeImage($image,$width,$height,$scale) {
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	$source = imagecreatefromjpeg($image);
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$image,90);
	chmod($image, 0777);
	return $image;
}
//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	$source = imagecreatefromjpeg($image);
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	imagejpeg($newImage,$thumb_image_name,90);
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}
//You do not need to alter these functions
function getHeight($image) {
	$sizes = @getimagesize($image);
	$height = $sizes[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$sizes = @getimagesize($image);
	$width = $sizes[0];
	return $width;
} 
if(!is_dir($upload_dir)){
	mkdir($upload_dir, 0777);
	chmod($upload_dir, 0777);
}
 
//Check to see if any images with the same names already exist
if (file_exists($large_image_location)){
	if(file_exists($thumb_image_location)){
		$thumb_photo_exists = "<img src=\"".$small.$imageMain."\" alt=\"Thumbnail Image\"/>";
	}else{
		$thumb_photo_exists = "";
	}
   	$large_photo_exists = "<img src=\"".$upload_path.$imageMain."\" alt=\"Large Image\"/>";
} else {
   	$large_photo_exists = "";
	$thumb_photo_exists = "";
}
 $large_photo_exists = "<img src=\"".$large_image_location."\" alt=\"Large Image\"/>";
if (isset($_POST["upload"])) { 
	//Get the file information
	$userfile_name = $_FILES['image']['name'];
	$userfile_tmp = $_FILES['image']['tmp_name'];
	$userfile_size = $_FILES['image']['size'];
	$filename = basename($_FILES['image']['name']);
	$file_ext = substr($filename, strrpos($filename, '.') + 1);
	
	//Only process if the file is a JPG and below the allowed limit
	if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
		if (($file_ext!="jpg") && ($userfile_size > $max_file)) {
			$error= "ONLY jpeg images under 1MB are accepted for upload";
		}
	}else{
		$error= "Select a jpeg image for upload";
	}
	//Everything is ok, so we can upload the image.
	if (strlen($error)==0){ 
		if (isset($_FILES['image']['name'])){ 
			move_uploaded_file($userfile_tmp, $large_image_location);
			chmod($large_image_location, 0777);
			mysql_query(" insert into images set image = '$imgName' ")or die(mysql_error());
			$width = getWidth($large_image_location);
			$height = getHeight($large_image_location);
			//Scale the image if it is greater than the width set above
			if ($width > $max_width){
				//$scale = $max_width/$width;
				$scale = 1;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}else{
				$scale = 1;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}
			//Delete the thumbnail file so the user can create a new one
			if (file_exists($thumb_image_location)) {
				 unlink($thumb_image_location);
			}
		}
		//Refresh the page to show the new uploaded image
		header("location:".$_SERVER["PHP_SELF"]);
		exit();
	}
}

if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
	//Get the new coordinates to crop the image.
	$x1 = $_POST["x1"];
	$y1 = $_POST["y1"];
	$x2 = $_POST["x2"];
	$y2 = $_POST["y2"];
	$w = $_POST["width"];
	$h = $_POST["height"];
	//Scale the image to the thumb_width set above
	//$scale = $thumb_width/$w;
	$scale = 1;
	$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
	//Reload the page again to view the thumbnail
	//header("location:".$_SERVER["PHP_SELF"]); 
	//exit();
	?>
	 <script type="text/javascript">
	   window.opener.location.reload();
		window.close();
	</script><?php
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en-us" />
	<title></title>
     <link rel="stylesheet" href="<?=SITE_PATH_ADM?>crop/css/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js" type="text/javascript"></script>
    <script src="js/cropper.js" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8">
		function onEndCrop( coords, dimensions ) {
			$( 'x1' ).value = coords.x1;
			$( 'y1' ).value = coords.y1;
			$( 'x2' ).value = coords.x2;
			$( 'y2' ).value = coords.y2;
			$( 'width' ).value = dimensions.width;
			$( 'height' ).value = dimensions.height;
		}
		
		// example with a preview of crop results, must have minimumm dimensions
		Event.observe( 
			window, 
			'load', 
			function() { 
				new Cropper.ImgWithPreview( 
					'testImage',
					{ 
						minWidth: <?=$thumb_width?>, 
						minHeight: <?=$thumb_height?>,
						ratioDim: { x: <?=$thumb_width?>, y: <?=$thumb_height?> },
						displayOnInit: true, 
						onEndCrop: onEndCrop,
						previewWrap: 'previewArea'
					} 
				) 
			} 
		);
	</script>
	<style type="text/css">
		label { 
			clear: left;
			/* margin-left: 50px; */
			float: left;
			width: 5em;
		}
		
		#testWrap {
			width: 500px;
			float: left;
			/* margin: 20px 0 0 20px; */ /* Just while testing, to make sure we return the correct positions for the image & not the window */
		}
		
		#previewArea {
			margin: 20px 0 0 20px;
			float: left;
		}
		
		#results {
			clear: both;
		}
	</style>
</head>
<body>	
 <div class="div-tbl">
        <div class="title">
          <div class="fl"> Crop Image </div>
          <div class="tbl-search">
        
          </div>
          <div class="cl"></div>
        </div>
        <div class="tbl-contant">
         <div id="testWrap" style="min-height:180px;" >
		<img src="<?=SITE_PATH."uploaded_files/orginal/".$imageMain;?>" alt="test image" id="testImage"   />
	</div>
       <div class="cl"></div>
       <form name="thumbnail" action="" method="post">
      
        <div class="section">
         
 			<input type="hidden" name="x1" id="x1" />
		 	<input type="hidden" name="y1" id="y1" />
			<input type="hidden" name="x2" id="x2" /> 
            <input type="hidden" name="y2" id="y2" />
            <label>Width:</label>
            <div><input type="text" readonly="readonly" class="txt small" name="width" id="width" /></div>
 		</div> 
            
            
             <div class="section">
            <label>Height:</label>
            <div><input type="text" readonly="readonly" class="txt small" name="height" id="height" /></div>
        
        </div> 
        
         <div class="section last"> <div><input type="submit" name="upload_thumbnail" value=" Crop Image " id="save_thumb" class="uibutton loading" /></div></div>
        </form>
        </div></div> 
	   
      <div style="clear:both;"></div>
	
   <div style="clear:both;"></div>
     <br />
	
	<div   id="previewArea" style="display:none;"></div>
	
	     
	
</body>
</html>