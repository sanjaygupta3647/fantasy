<?php 
function ret($txt)
{
	return $name = str_replace('_',' ',trim($txt));
}
function formvalid()
{
	return ' onsubmit="return formvalid(this);" ';
}

function FilterALLHTML($document){

	$text = strip_tags($document);

	$text =  str_replace('&nbsp;','',$text);

	return $text;

}

function page_info($page){
	$pageInfo = array();
	$pageInfo[1] = get_static_content('title',$page);
	$pageInfo[2] = get_static_content('keyword',$page);
	$pageInfo[3] = get_static_content('description',$page);
	$pageInfo[4] = get_static_content('heading',$page);
	$pageInfo[5] = get_static_content('body',$page);
	return $pageInfo;
}

function headingimg($val,$size='35'){
	return "heading/".str_replace(" ","-",$val)."-".$size.".jpg";
}

function hitcount($id){
	$as="aaa".$id;
	if($_SESSION[$as]==''){
		mysql_query("update ".tb_Prefix."auction set hits=(hits+1) where aid='".$id."'");
		$_SESSION[$as]='bdnow';
	}
}
function get_static_name($page_id) 
{
	$sql="select pagename from ".tb_Prefix."pages where page_id = '$page_id'";
	return $rs=db_scalar($sql);
}

function protect_admin_page(){
	if ($_SESSION['logrec'][0]=='' and $_SESSION['logrec'][2]=='' and $_SESSION['sess_admin_login_id']==''){
		header('Location:login.php');
		exit;	 
	}
}
function protect_admin_page2($page){
	$_SESSION["pageses"]=$page;
	if ($_SESSION['logrec'][0]=='' and $_SESSION['logrec'][2]==''){
		header('Location:login.php');
		exit;	 
	}
}

function error_msg(){
	if($_SESSION['sessionMsg']){
		$aaa=$_SESSION['sessionMsg'];
		$_SESSION['sessionMsg']="";
		return '<div class="red">'.$aaa.'</div>';
		
	}
}
function error_msg1(){
	if($_SESSION['sessionMsg']){
		return $_SESSION['sessionMsg'];
		$_SESSION['sessionMsg']="";
	}
}
function validate_user()
{
	if($_SESSION['UID']=='')
	{
		$_SESSION['msg'] = 'Restricted Page. Login First.<br>';
		redir('login.php?back='.$_SERVER[REQUEST_URI]);
	}
}

function ms_redirect($file, $exit=true, $sess_msg='')
{
	header("Location: $file");
	exit();
	
}

function status_dropdown($name, $sel_value)
{
	$arr = array( "Active" => 'Active', 'Inactive' => 'Inactive');
	return array_dropdown($arr, $sel_value, $name);
}

function yes_no_dropdown($name, $sel_value)
{
	$arr = array( "Yes" => 'Yes', 'No' => 'No');
	return array_dropdown($arr, $sel_value, $name);
}
function display_session_msg()
{
	echo "<p class=msg>". $_SESSION['sessionMsg'] . "</p>";
	unset($_SESSION['sessionMsg']);
}
function display_msg()
{
	if(isset($_SESSION['msg']) && $_SESSION['msg'] == '')
	{ 
		echo "<p class=msg>". $_SESSION['msg'] . "</p>";
		unset($_SESSION['msg']);
	}	
}

function myadds($text)
{
	
}


function display_session($session_msg)
{
	if(isset($_SESSION[$session_msg]) && $_SESSION[$session_msg] != '')
	{	
		$arr = explode("<br>",$_SESSION[$session_msg]);
		echo "<ul>";
		for($i=0;$i<=(count($arr)-1);$i++)
		{
			if($arr[$i])
			echo "<li>". $arr[$i] . "</li>";
		}
		echo "</ul>";
		unset($_SESSION[$session_msg]);
	}
}

function readmyfile($path)
{
	$text='';
	$fp = @fopen($path,"r");
	while (!@feof($fp))
	{
		$buffer = @fgets($fp, 4096);
		$text.= $buffer;
	}
	@fclose($fp);
	return $text;
}
if(!function_exists("send_mail"))
{
	function send_mail($email_to,$subject,$message,$from_email,$from_name='',$html=false)
	{
		 if($from_name == '') $from_name=$from_email;
		 if($html==true) 
		{
			 $headers = "Content-type: text/html; charset=iso-8859-1\r\n";
		 }
		 else 
		{
		 $headers = "Content-type: text/plain; charset=iso-8859-1\r\n";
		 }
		$headers .= "From: $from_email \r\n";
		 @mail($email_to,$subject,$message,$headers);
	}

} 

function get_config_value($config_id)
{
	$sql_config="select config_value from sp_config where config_id='$config_id'";
	return db_scalar($sql_config);	
}
function folder($fldr){
	$fldr1=strtolower($fldr);
	$fldr1=str_replace("'","-",$fldr1); 
	$fldr1=str_replace(",","-",$fldr1); 
	$fldr1=str_replace(" ","-",$fldr1); 
	$fldr1=str_replace(".","-",$fldr1); 
	return str_replace("_","-",$fldr1); 
}

function fullurl($path='', $id='', $title){
	$sql = db_query("select pid, name from ".tb_Prefix."categories where id='".$id."'");
	$row = db_fetch_array($sql);
	if($row[pid]){
		$sql2 = db_query("select name from ".tb_Prefix."categories where id='".$row[pid]."'");
		$row2 = db_fetch_array($sql2);
		return $path.folder($row2[name])."/".$id."-".folder($row[name])."/".refile($title);
	}else{
		return $row[name];
	}
}
function headerurl($path='', $file){
	return $path.folder($file).".php";
}
function fullurl5($path='', $id=''){
	$sql = db_query("select pid, name from ".tb_Prefix."categories where id='".$id."'");
	$row = db_fetch_array($sql);
	if($row[pid]){
		$sql2 = db_query("select name from ".tb_Prefix."categories where id='".$row[pid]."'");
		$row2 = db_fetch_array($sql2);
		return $path.folder($row2[name]).ROOT.folder($row[name])."-".$id.ROOT;
	}else{
		return $row[name].ROOT;
	}
}
function unfolder($fldr){
	$fldr1=str_replace("-"," ",$fldr); 
	return ucfirst($fldr1);
}
function cdir($tag, $dname, $sesval=''){
	$dirPath ="../".folder($dname);
	if($tag=='rn'){
		rename("../".$sesval,$dirPath);
	} else if($tag=='cr'){
		$rs = @mkdir($dirPath); 
		chmod($dirPath,0777);
		cpy($dirPath);
	}	
}
function cpy($drn){
	$root1="../import";
	if ($handle = opendir($root1)){
		while (false !== ($file = readdir($handle))) {
			if($file!='.' and $file!='..' and $file!='Thumbs.d'){
				copy($root1."/".$file, $drn."/".$file);
			}
		}		
		closedir($handle);
	}	
}

function delf($drn){
	$sq12 = db_query("select name from ".tb_Prefix."categories where id='".$drn."'");
	$row12 = db_fetch_array($sq12);
	@extract($row12);
	$root1="../".folder($name);
	if ($handle2 = opendir($root1)){
		while (false !== ($file41 = readdir($handle2))) {
			if($file41!='.' and $file41!='..'){	
				unlink($root1."/".$file41);
			}
		}		
		closedir($handle2);
	}
	rmdir($root1);
}
function num_sub_categories($catid){
	$rtmp = db_query("select count(*) from ".tb_Prefix."categories  where cat_parent_id='$catid'");
	$rwtmp = mysql_fetch_row($rtmp);
	return $rwtmp[0];
}
function check_item_in_cat($catId)
{
	$sqlCat="select * from ".tb_Prefix."categories where cat_parent_id='".$catId."'";
	$rsCat=db_query($sqlCat);	
	$tempId="";
	while($arrCat=mysql_fetch_array($rsCat))
	{
		$tempId.=$arrCat[cat_id].",";
	}
	$tempId=substr($tempId,0,strlen($tempId)-1);
	if($tempId!='')
	{
		/*$sqlItem="select * from ".tb_Prefix."banner where banner_catid in ($tempId)";
		$rsItem=db_query($sqlItem);
		if(mysql_num_rows($rsItem)>0)
		{
			return true;
		}
		else
		{
			return false;
		}*/
	}
}
function check_item_cat($catId)
{
	if($catId!='')
	{
		/*$sqlItem="select * from ".tb_Prefix."banner where banner_catid ='".$catId."' and status='Active'";
		$rsItem=db_query($sqlItem);
		if(mysql_num_rows($rsItem)>0)
		{
			return true;
		}
		else
		{
			return false;
		}*/
	}
}
function delete_sub_categories($catid)
{
	
	$rs = db_query("SELECT * FROM ".tb_Prefix."categories WHERE subcat='".$catid."'");
	if (mysql_num_rows($rs)>0)
	{
		while ($rw = mysql_fetch_array($rs))
		{
			 
			delete_sub_categories($rw["subcat"]); 
			db_query("DELETE FROM ".tb_Prefix."categories WHERE subcat='".$rw["subcat"]."'");
		}
	}
	db_query("DELETE FROM ".tb_Prefix."categories WHERE id='".$catid."'");
} 

function item_count_cat($catId,$subCat='')
{
		if($subCat=='')
		{
			$sqlCat="select * from ".tb_Prefix."categories where cat_parent_id='".$catId."'";
			$rsCat=db_query($sqlCat);	
			$tempId="";
			while($arrCat=mysql_fetch_array($rsCat))
			{
			$tempId.=$arrCat[cat_id].",";
			}
			$tempId=substr($tempId,0,strlen($tempId)-1);
			if($tempId!='')
			{
				$sqlCat="select count(*) as cnt from ".tb_Prefix."banner where banner_catid in($tempId)";
				$rsCat=db_query($sqlCat);
				$arrCat=mysql_fetch_array($rsCat);
				$varreturn=$arrCat["cnt"];
			}
			else
			{
				$varreturn=0;
			}
		}
		else 
		{
			$sqlCat="select count(*) as cnt from ".tb_Prefix."banner where banner_catid='".$catId."'";
			$rsCat=db_query($sqlCat);
			$arrCat=mysql_fetch_array($rsCat);
			$varreturn=$arrCat["cnt"];
		}
		return $varreturn;
}
function category_breadcrumbs($cat_id)
{
	
	
	$linkclass = 'bread1';
	$normalclass = 'bread2';
	
	$self = $_SERVER['PHP_SELF'];
	$break = "&nbsp;&raquo;&nbsp;";
	
	$root = "<a class=h1 href='$self'>Main Categories</a>"; 	
	if ($cat_id == '0')
	{	
		$str = $root;		
	}	
	else
	{	
		$rs1 = db_query("SELECT catname,subcat from ".tb_Prefix."categories where id = '$cat_id' ");
		$rw1 = mysql_fetch_array($rs1);
		$lk1 = "<span class=h1>$rw1[cat_name]</span>";  
		$parent = $rw1[cat_parent_id];  
		if ($parent != '0')
		{ 
			
			while ($parent != 0)
			{ 
				$rs2 = db_query("SELECT catname,subcat,id from ".tb_Prefix."categories where id = '$parent' ");
				$rw2 = mysql_fetch_array($rs2);
				
				$lk2 = "<a class=h1 href='$self?CategoryId=$rw2[cat_id]&show=product'>$rw2[cat_name]</a>".$break.$lk2;
				
				$parent = $rw2[cat_parent_id];
			}	
			
		} 
		$str = $root.$break.$lk2.$lk1; 
	}
	
	echo "<p align=left style='padding-left:10px'>$str</p>";
	
	
}
function get_cat_combo($name,$sel_value)
{
	$sql="select * from tf_category where cat_status='Active'";
	$rs=db_query($sql);
	$num=mysql_num_rows($rs);	
	
	$combo="";
	if($num>0)
	{
		$combo.="<select name='$name' class=textbox>";
		$combo.="<option value=''>----Select Category----</option>";	
		while($arr=mysql_fetch_array($rs))
		{
			@extract($arr);
			if($sel_value==$cat_id) { $sel="selected"; } else { $sel=""; }
			$combo.="<option value='".$cat_id."' $sel>".$cat_name."</option>";	
		}
		$combo.="</select>";
	}
	return $combo;
}
function get_cat_name($id)
{
	if($id!='')
	 {
		$sql="select catname from ".tb_Prefix."categories where status='Active' and id='$id'";
		return $rs=db_scalar($sql);
	} 
	else 
	{
		//return "All Product";
	}
}

function get_user_combo($name,$sel_value)
{
	$sql="select * from fa_users where user_status='Active'";
	$rs=db_query($sql);
	$num=mysql_num_rows($rs);	
	
	$combo="";
	if($num>0)
	{
		$combo.="<select name='$name' class=textbox style=height:20px;>";
		$combo.="<option value=''>----Select User----</option>";	
		while($arr=mysql_fetch_array($rs))
		{
			@extract($arr);
			if($sel_value==$user_id) { $sel="selected"; } else { $sel=""; }
			$combo.="<option value='".$user_id."' $sel>".$user_name."</option>";	
		}
		$combo.="</select>";
	}
	return $combo;
}


function get_country_combo($name,$sel_value,$extra = '')
{
	$sql="select * from ".tb_Prefix."country order by country asc";
	$rs=db_query($sql);
	$num=mysql_num_rows($rs);	
	
	$combo="";
	if($num>0)
	{
		$combo.="<select name='$name' $extra>";
		$combo.="<option value=''>----Select Country----</option>";	
		while($arr=mysql_fetch_array($rs))
		{
			@extract($arr);
			if($sel_value==$country) { $sel="selected"; } else { $sel=""; }
			$combo.="<option value='".$country."' $sel>".$country."</option>";	
		}
		$combo.="</select>";
	}
	return $combo;
}

function get_state_combo($name,$sel_value,$extra)
{
	$sql="select * from tf_state order by name asc";
	$rs=db_query($sql);
	$num=mysql_num_rows($rs);	
	
	$combo="";
	if($num>0)
	{
		$combo.="<select name='$name' id='$name' $extra>";
		$combo.="<option value=''>----Select State----</option>";	
		while($arr=mysql_fetch_array($rs))
		{
			@extract($arr);
			if($sel_value==$name) { $sel="selected"; } else { $sel=""; }
			$combo.="<option value='".$name."' $sel>".$name."</option>";	
		}
		$combo.="</select>";
	}
	return $combo;
}
function get_state_combo_short($name,$sel_value,$extra)
{
	$sql="select * from fa_state order by name asc";
	$rs=db_query($sql);
	$num=mysql_num_rows($rs);	
	
	$combo="";
	if($num>0)
	{
		$combo.="<select name='$name' $extra>";
		$combo.="<option value=''>----Select State----</option>";	
		while($arr=mysql_fetch_array($rs))
		{
			@extract($arr);
			if($sel_value==$short_name) { $sel="selected"; } else { $sel=""; }
			$combo.="<option value='".$short_name."' $sel>".$name."</option>";	
		}
		$combo.="</select>";
	}
	return $combo;
}
function randomString($length)
{
	$key_chars = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
	$rand_max  = strlen($key_chars) - 1;
	
	for ($i = 0; $i < $length; $i++)
	{
		$rand_pass .= substr($key_chars, rand($i, $rand_max), 1);
	}
	return $rand_pass;
}
function get_yn_combo($name,$sel_value){
	$combo.="<select name='$name'>";
	if($sel_value=='Yes'){
		$sel='selected="selected"';
	}else{
		$sel1='selected="selected"';
	}
	$combo.="<option value='Yes' ".$sel.">Yes</option>";	
	$combo.="<option value='No' ".$sel1.">No</option>";	
	$combo.="</select>";
	return $combo;
}

function get_static_content($key,$pname){
	return $rs=db_scalar("select ".$key." from ".tb_Prefix."pages where pname='$pname'");
}
function menuname3($id, $val=''){
	return '<a href="#">'.db_scalar("select menu from ".tb_Prefix."pages where page_id='$id'").'</a>';
}
function menuname($id, $val=''){
	if(!$val){
		//$val2='onMouseOut="SDDM_deactivate('.$id.');" onMouseOver="SDDM_activate('.$id.');"';
	}
	return '<a href="'.db_scalar("select pname from ".tb_Prefix."pages where page_id='$id'").'.php" '.$val2.'>'.db_scalar("select menu from ".tb_Prefix."pages where page_id='$id'").'</a>';
}
function menuname2($a){
	return folder(db_scalar("select pname from ".tb_Prefix."pages where page_id='$a'"));
}
function menuname4(){
	$link = db_scalar("select link from ".tb_Prefix."knowledgecafe where id=1");
	return '<a href="'.$link.'" target="_blank">'.db_scalar("select menuname from ".tb_Prefix."knowledgecafe where id=1").'</a>';
}
function get_state_content($val){
	$sql="select state_ab from ".tb_Prefix."state where (state_name='$val')";
	return $rs=db_scalar($sql);
}

function convert_flv($srcFile,$destFile){
	//echo $srcFile = dirname(__FILE__)."/".$srcFile;	
	$srcFile = $srcFile;	
	//$destFile = dirname(__FILE__)."/".$destFile;
	$destFile = $destFile;
	
	$ffmpegPath = "/usr/bin/ffmpeg";
	//$ffmpegPath = "C:/ffmpeg1/ffmpeg";
	
	//$flvtool2Path = "/usr/local/bin/ffmpeg";

	$info = execOutput($ffmpegPath . " -i " . $srcFile);
	 
	// Create our FFMPEG-PHP class
	//$ffmpegObj = new ffmpeg_movie($srcFile);
	// Save our needed variables
	$srcWidth = $info['video']['dimensions']['width'];
	$srcWidth -= $srcWidth % 2; // output frame width must be even number
	$srcHeight = $info['video']['dimensions']['height'];
	$srcHeight -= $srcHeight % 2; // output frame height must be even number
	$srcFPS = $info['video']['frame_rate'];
	//$srcAB = intval($ffmpegObj->getAudioBitRate()/1000);
	$srcAB = 64; // use 64kbps for FLV, doesn't matter what the original video had, it will downsample
	//$srcAR = $ffmpegObj->getAudioSampleRate();
	$srcAR = 22050; // same for audio sample rate.
	// Call our convert using exec()

	$srcAC = 2; // output FLV should have two audio channels

	$out = array();
	exec($ffmpegPath . " -i " . $srcFile . " -ac " . $srcAC . " -ar " . $srcAR . " -ab " . $srcAB . " -f flv -s " . $srcWidth . "x" . $srcHeight . "   " . $destFile.' 2>&1', $out, $error);
	
	return implode("<br>", $out);
}


function execOutput($command) {
    $output = array();
	//echo $command;
	 
    exec($command.' 2>&1', $output);
	
	$data = array();
	
    $buffer = implode("\r\n", $output);
	
	preg_match('/Stream(.*): Video: (.*)/', $buffer, $matches);
	if(count($matches) > 0)
	{
		$data['video'] 						= array();
// 					get the dimension parts
// print_r($matches);
		preg_match('/([0-9]{1,5})x([0-9]{1,5})/', $matches[2], $dimensions_matches);
// 					print_r($dimensions_matches);
		$dimensions_value = $dimensions_matches[0];
		$data['video']['dimensions'] 	= array(
			'width' 					=> floatval($dimensions_matches[1]),
			'height' 					=> floatval($dimensions_matches[2])
		);
// 					get the framerate
		preg_match('/([0-9\.]+) (fps|tb)\(r\)/', $matches[0], $fps_matches);
		$data['video']['frame_rate'] 	= floatval($fps_matches[1]);
		$fps_value = $fps_matches[0];
// 					get the ratios
		preg_match('/\[PAR ([0-9\:\.]+) DAR ([0-9\:\.]+)\]/', $matches[0], $ratio_matches);
		if(count($ratio_matches))
		{
			$data['video']['pixel_aspect_ratio'] 	= $ratio_matches[1];
			$data['video']['display_aspect_ratio'] 	= $ratio_matches[2];
		}
// 					work out the number of frames
		if(isset($data['duration']) && isset($data['video']))
		{
// 						set the total frame count for the video
			$data['video']['frame_count'] 						= ceil($data['duration']['seconds'] * $data['video']['frame_rate']);
// 						set the framecode
			$frames												= ceil($data['video']['frame_rate']*($data['duration']['timecode']['seconds']['excess']/10));
			$data['duration']['timecode']['frames'] 			= array();
			$data['duration']['timecode']['frames']['exact']  	= $data['duration']['timecode']['rounded'].'.'.$frames;
			$data['duration']['timecode']['frames']['excess'] 	= $frames;
			$data['duration']['timecode']['frames']['total'] 	= $data['video']['frame_count'];
		}
// 					formats should be anything left over, let me know if anything else exists
		$parts 							= explode(',', $matches[2]);
		$other_parts 					= array($dimensions_value, $fps_value);
		$formats = array();
		foreach($parts as $key=>$part)
		{
			$part = trim($part);
			if(!in_array($part, $other_parts))
			{
				array_push($formats, $part);
			}
		}
		$data['video']['pixel_format'] 	= $formats[1];
		$data['video']['codec'] 		= $formats[0];
	}
// 	match the audio stream info
	preg_match('/Stream(.*): Audio: (.*)/', $buffer, $matches);
	if(count($matches) > 0)
	{
// 					setup audio values
		$data['audio'] = array(
			'stereo'		=> -1, 
			'sample_rate'	=> -1, 
			'sample_rate'	=> -1
		);
		$other_parts = array();
// 					get the stereo value
		preg_match('/(stereo|mono)/i', $matches[0], $stereo_matches);
		if(count($stereo_matches))
		{
			$data['audio']['stereo'] 		= $stereo_matches[0];
			array_push($other_parts, $stereo_matches[0]);
		}
// 					get the sample_rate
		preg_match('/([0-9]{3,6}) Hz/', $matches[0], $sample_matches);
		if(count($sample_matches))
		{
			$data['audio']['sample_rate'] 	= count($sample_matches) ? floatval($sample_matches[1]) : -1;
			array_push($other_parts, $sample_matches[0]);
		}
// 					get the bit rate
		preg_match('/([0-9]{1,3}) kb\/s/', $matches[0], $bitrate_matches);
		if(count($bitrate_matches))
		{
			$data['audio']['bitrate'] 		= count($bitrate_matches) ? floatval($bitrate_matches[1]) : -1;
			array_push($other_parts, $bitrate_matches[0]);
		}
// 					formats should be anything left over, let me know if anything else exists
		$parts 							= explode(',', $matches[2]);
		$formats = array();
		foreach($parts as $key=>$part)
		{
			$part = trim($part);
			if(!in_array($part, $other_parts))
			{
				array_push($formats, $part);
			}
		}
		$data['audio']['codec'] 		= $formats[0];
	}	
	
	
	return $data;	
}

function get_order($type)
{
	if($type=="drop")
	{
		$sql="select max(cat_drop_order)+1 as MaxOrder from ".tb_Prefix."categories where cat_parent_id!='0'";
	} 
	else 
	{
		$sql="select max(cat_order)+1 as MaxOrder from ".tb_Prefix."categories where cat_parent_id!='0'";
	}
	$rs=db_query($sql);
	$arr=mysql_fetch_array($rs);
	return $arr["MaxOrder"];
}


function option_categories1($match=0,$type,$parent=0,$space='',$matcharr=0,$optlabel=1)
{
	 
	// displays only <option> tags
	// use this function inside <select> tag
	
	// $matcharr = 0 if $match is not a array else $matcharr = 1 
	 
	$catSql="SELECT * FROM ".tb_Prefix."categories WHERE subcat='".$parent."' and typed='".$type."'";
	$rs = db_query($catSql);
	while($rw = mysql_fetch_array($rs))
	{		
		
			
				
				$arr=explode(",",$match);

				if(is_array($match)) {
				if(in_array($rw[cat_id],$arr))
				//if ($rw[Id]==$match)
					$sel = 'selected'; 
				else $sel = '';
				} else {
					if ($rw[id]==$match)
					$sel = 'selected'; 
				else $sel = '';
				}
				echo "<option value='".$rw['id']."' $sel>".$rw['catname']."</option>";
			
	
			
	}
}


function option_categories($match=0,$type,$parent=0,$space='',$matcharr=0,$optlabel=1)
{
	 
	// displays only <option> tags
	// use this function inside <select> tag
	
	// $matcharr = 0 if $match is not a array else $matcharr = 1 
	 
	$catSql="SELECT * FROM ".tb_Prefix."categories WHERE cat_parent_id='".$parent."' and type='".$type."'  order by cat_name";
	$rs = db_query($catSql);
	while($rw = mysql_fetch_assoc($rs))
	{		
		
			$arr=explode(",",$match);
			if(in_array($rw[cat_id],$arr))
			//if ($rw[Id]==$match)
				$sel = 'selected'; 
			else $sel = '';
				
		if ($parent==0)
		{
			if ($optlabel=='1')
			{
				//echo "<optgroup label='&nbsp;$rw[cat_name]' selected></optgroup>";
				echo "<option value='$rw[cat_id]' style='color:#000000;font:bold 12px arial;font-style:italic'  $sel>$rw[cat_name]</option>";
			}
			else
			{	
				echo "<option value='$rw[cat_id] style='color:#000000;font:bold 12px arial;font-style:italic' $sel>$rw[cat_name]--------------------------------------------</option>";
			}
		}
		else
		{
			echo "<option value='$rw[cat_id]' $sel>$space$rw[cat_name]</option>";
		}		
			$space_new = $space.' - ';
			option_categories($match,$type,$rw[cat_id],$space_new,$matcharr,$just);
		
			
	}
}

function main_option_categories($match=0,$domainid,$parent=0,$space='',$matcharr=0,$optlabel=1)
{
	 
	// displays only <option> tags
	// use this function inside <select> tag
	
	// $matcharr = 0 if $match is not a array else $matcharr = 1 
	 
	$catSql="SELECT * FROM ".tb_Prefix."categories WHERE cat_parent_id='".$parent."' and type='".$domainid."'  order by cat_name";
	$rs = db_query($catSql);
	while($rw = mysql_fetch_array($rs))
	{		
		
			$arr=explode(",",$match);
			if(in_array($rw[cat_id],$arr))
			//if ($rw[Id]==$match)
				$sel = 'selected'; 
			else $sel = '';
				
		if ($parent==0)
		{
			if ($optlabel=='1')
			{
				//echo "<optgroup label='&nbsp;$rw[cat_name]' selected></optgroup>";
				echo "<option value='$rw[cat_id]'  $sel>$rw[cat_name]</option>";
			}
			else
			{	
				echo "<option value='$rw[cat_id] $sel>$rw[cat_name]--------------------------------------------</option>";
			}
		}
		else
		{
			echo "<option value='$rw[cat_id]' $sel>$space$rw[cat_name]</option>";
		}		
			$space_new = $space.' - ';
			//option_categories($match,$domainid,$rw[cat_id],$space_new,$matcharr,$just);
		
			
	}
}

function uploadFile($PATH,$URLPATH) {
	checkpath($PATH);

	$PATH = $PATH.'/';

	$ext=getextention($URLPATH);

	$FILENAME=time()."_".mt_rand(1,1000).".".$ext;


	//$FILENAME = renamefile($PATH,$fname);

	$file=$PATH.$FILENAME;
	
	
	$uploaded="TRUE";
	copy($URLPATH,$file);
	return $FILENAME;
}

function uploadFile1($PATH,$FILENAME,$FILEBOX)
{
	
	checkpath($PATH);

	$PATH = $PATH.'/';

	$ext=getextention($FILENAME);

	$FILENAME=time()."_".mt_rand(1,1000).".".$ext;


	//$FILENAME = renamefile($PATH,$fname);

	$file=$PATH.$FILENAME;
	
	
	$uploaded="TRUE";
	global $_FILES;
    if (! @file_exists($file))
    {

		if ( isset( $_FILES[$FILEBOX] ) )
        {
			if (is_uploaded_file($_FILES[$FILEBOX]['tmp_name']))
            {
				move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
            }else{
				$uploaded="FALSE";
            }
        }
    } //end of if @fileexists
	return $FILENAME;
}


function checkpath($PATH)
{
	if(!is_dir($PATH))
	{
		mkdir($PATH,0777);
	}
}

 function getextention($fname)
{
	$fext=explode(".",$fname);
	$ext=$fext[count($fext)-1];
	return $ext;
}

function bannerup($dname)
{
	$nnpath1 = '../uploaded_files';
	if(!is_dir($nnpath1))
	{
		mkdir($nnpath1, 0777);
	}
	$nnpath = '../uploaded_files/'.$dname;
	if(!is_dir($nnpath)){
			mkdir($nnpath, 0777);
	}
	return $nnpath;
}

function uploadpath($dname)
{
	$nnpath1 = 'uploaded_files';
	if(!is_dir($nnpath1))
	{
		mkdir($nnpath1, 0777);
	}
	
	$nnpath = 'uploaded_files/'.$dname;
	if(!is_dir($nnpath))
	{
			mkdir($nnpath, 0777);
	}
	
	return $nnpath;
}
function getdomain($domainid)
{
	return db_scalar("select domain from ".tb_Prefix."domain where id='".$domainid."'");
}

function change_order($cat_id,$question_id,$new_order,$id,$type,$is_ques_page=0)
{		

if($type=='cat_list')
{
	$table_name = tb_Prefix."categories";
	$col1       = "cat_order";
	$col2       = "cat_id";
	$id_head    = "";
	$id_head_value = "";
} 
elseif($type=='cat_drop_list')
{
	$table_name = tb_Prefix."categories";
	$col1       = "cat_drop_order";
	$col2       = "cat_id";
	$id_head    = "";
	$id_head_value = "";
}

	$sql = " select $col1 from $table_name where $col2='$id' ";
	$order_old=db_scalar($sql);

	if(intval($order_old)>intval($new_order))
	{
		$sql= "select $col1,$col2 from $table_name where $col1 >='$new_order' and $col1<'$order_old' ";
		if($id_head_value!='' && $id_head!='') { 
			$sql .= " and $id_head ='$id_head_value' ";
		}
		$sql .= " order by $col1 asc ";
		$result=db_query($sql);
		while($line = mysql_fetch_array($result))
		{
			$orderx = $line[$col1];
			$idx	 = $line[$col2];
			$orderx++;
			$sql="update $table_name set $col1='$orderx' where $col2= '$idx'";
			db_query($sql);
		}
	}
	else
	{
		$sql= "select $col1,$col2 from $table_name where $col1>$order_old  and $col1<=$new_order ";
		if($id_head_value!='' && $id_head!='') { 
			$sql .= " and $id_head ='$id_head_value' ";
		}
		$sql .= " order by $col1 asc ";
		$result=db_query($sql);
		while($line = mysql_fetch_array($result))
		{
			$orderx  = $line[$col1];
			$idx	 = $line[$col2];
			$orderx--;
			$sql="update $table_name set $col1='$orderx' where $col2= '$idx'";
			db_query($sql);
		}
	}
	$sql= "update $table_name set $col1='$new_order' where $col2='$id'";
	db_query($sql);
}
function get_newsletter($id)
{
	return db_scalar("select email from ".tb_Prefix."newsletter where id='".$id."'");
}


function get_country($cc)
{
	return db_scalar("select cn from ".tb_Prefix."country where cc='".$cc."'");
}

function getimg($id, $fol, $arr = '',$typeid='0', $type='')
{
	$upath = uploadpath($fol);
	$tt = ($type)?" and testimonial='".$type."'":"";
	$ttt = ($typeid)?" and autoid='".$typeid."'":"";
	$sql = db_query("select * from ".tb_Prefix."testimonial where status='Active' and type='".$id."' and type_id='0' ".$tt.$ttt."");
	$ii = array();
	while($ro = db_fetch_array($sql)) {
		$sql1 = db_query("select * from ".tb_Prefix."testimonial where status='Active' and img!='' and type='".$id."' and type_id='".$ro['autoid']."' ".(($typeid)?"":"and name='photo0'"));
		
		while($ro1 = db_fetch_array($sql1)) {
			$ii[$ro1['autoid']] = $ro1['img'];
		}
	}
	$getarr = array();
	foreach($ii as $k => $v)
	{
		if($v != '' && file_exists($upath.'/'.$v))
		{
			$getarr[$k] = ($upath.'/'.$v);
		}
		
	}
	for($im=0;$im<=(count($ii)-1);$im++)
	{
		if($ii[$im] != '' && file_exists($upath.'/'.$ii[$im]))
		{
			$img = ($upath.'/'.$ii[$im]);
			break;
		}
		
	}
	if($img == '')
	{
		$img = 'images/1px.jpg';
	}
	if($arr == '')
		return $img;
	else
		return $getarr;
}
function store_Image($tmp_name, $filename, $path)
{
	$filename = getFilename($filename);
	$PATH = $path.'/';
	list($wi,$hi)=getimagesize($tmp_name);
	$image = new SimpleImage();
	$image->load($tmp_name);
	if($wi > 1600 || $hi > 1600)
	{
		$image->resizeToWidth(1600,1600);
	}
	$image->save($PATH.$filename);
	return $filename;
}

function getartimg($id,$fol,$type='')
{
	$upath = uploadpath($fol);
	$imgsql = getSingleresult("select img from ".tb_Prefix."articals where status='Active' and type='".$fol."'");
	if($imgsql != '' && file_exists($upath.'/'.$imgsql))
	{
		if($type == '')
			$img = show_thumb($upath.'/'.$imgsql,'100','100');
		else
			$img = show_thumb($upath.'/'.$imgsql,'170','231');
	}
	else
	{
		$img = "images/1px.jpg";
	}
	return $img;
}

function getanscount($qid)
{
	$num = getSingleresult("select count(*) from ".tb_Prefix."questions where type='answer' and qid='".$qid."'");
	return ($num)?$num:'#';
}

function fileexists($path,$file)
{
	if(file_exists($path.'/'.$file) && $file)
	{
		$img = $path.'/'.$file;
	}
	else
	{
		$img = "images/1px.jpg";
	}
	return $img;
}
function getpages()
{
	
	foreach($_GET as $val)
	{
		
	}
}
function ago($timestamp){
        $difference = time() - $timestamp;

        if($difference < 60)
            return $difference." second";
        else{
            $difference = round($difference / 60);
            if($difference < 60)
                return $difference." minute";
            else{
                $difference = round($difference / 60);
                if($difference < 24)
                    return $difference." hours";
                else{
                    $difference = round($difference / 24);
                    if($difference < 7)
                        return $difference." days";
                    else{
                        $difference = round($difference / 7);
                        return $difference." weeks";
                    }
                }
            }
        }
    }
function show_photo($nid,$width,$height,$name='no',$css='picborderpink',$extra='')
{
	$upath = 'uploaded_files/users';
	$sql_check = db_query("select * from ".tb_Prefix."testimonial where type='user' and type_id='".$nid."'");
	$row_check = db_fetch_array($sql_check);
	//print_r($row_check);
	if(file_exists($upath.'/'.$row_check['img']) && $row_check['img'])
	{
		echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" align=\"center\">
		  <tr>
			<td align='center'><img src='".show_thumbOld($upath.'/'.$row_check['img'],$width,$height)."' style='padding:5px;".$extra."' class='".$css."' id='userimg' border='0'>
		</td>
		  </tr>";
		  if($name=='yes')
		{
		  echo "<tr>
		 	<td>
		<center class='text14blue'><b>".getSingleresult("select username from ".tb_Prefix."users where id='".$nid."'")."</b></center></td> 
		  </tr>";
		  }
		 echo "</table>";

	}
	else
	{
		echo "<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\" align=\"center\">
		  <tr>
			<td align='center'><img src='".show_thumbOld($upath.'/nophoto.jpg',$width,$height)."' style='padding:5px;".$extra."' id='userimg' class='picborderpink' border='0'>
		</td>
		  </tr>";
		  if($name=='yes')
		{
		  echo "<tr>
		 	<td>
		<center class='text14blue'><b>".getSingleresult("select username from ".tb_Prefix."users where id='".$nid."'")."</b></center></td> 
		  </tr>";
		  }
		 echo "</table>";
	}

} 

function getgallery($galleryId)
{
	return getSingleresult("select name from ".tb_Prefix."images where type='album' and id='".$galleryId."'");
}

function formtype($name,$value='',$type='input',$extra=' class="textbox"',$extra1='')
{
	
	if($type != 'textarea')
	{
		if($value)
			$val = " value='".$value."'";
		return "<input type='".$type."' name='".$name."' ".$val." ".$extra.">";
	}
	else
	{
		return "<textarea cols='30' rows='5' name='".$name."' ".$extra1.">".$value."</textarea>";
	}
}

function txttoimg($txt,$size=15)
{
	return SITE_PATH."text-to-image.php?text=".$txt."&size=".$size."&color=3E3E3E";
}
function boxstart($heading)
{
return '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="4"><img src="images/heading-curve2.jpg" alt="curve" width="4" height="30" /></td>
                    <td class="heading-bg"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="heading-text">'.$heading.'</td>
                        </tr>
                    </table></td>
                    <td width="4"><img src="images/heading-curve1.jpg" alt="curve" width="4" height="30" /></td>
                  </tr>
                </table>';
}
function boxend()
{
	return '</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12"><img src="images/body-curve3.jpg" width="12" height="12"></td>
        <td height="12" background="images/body-bottomline.jpg"><img src="images/body-bottomline.jpg" width="1" height="12"></td>
        <td width="12"><img src="images/body-curve4.jpg" width="12" height="12"></td>
      </tr>
    </table></td>
  </tr>
</table>
';
}

function ps($val)
{
	return ($val)?$val:"N/A";
}

function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        //CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

function repl($txt)
{
	return $name = trim(str_replace('_',' ',$txt));
}

function create_pagename($txt)
{
	$name = str_replace(' ','_',$txt);
	$allowed = "/[^a-z0-9\\_]/i";
 	$name = preg_replace($allowed,"",$name);
	$name = $name.'.html';
	return $name;
}


function create_page($page){
		if($page){
			$name =$page.'.php';
			$cont = filee('<?php include("header.inc.php") ?>','<?php include("left.inc.php") ?>','<?=$arr_pd[4]?>','<?=$arr_pd[5]?>','<?php include("footer.inc.php") ?>');
			$fp = fopen(SITE_FS_PATH.'/'.$name,'w');
			fwrite($fp, $cont);
			fclose($fp);
		}
}
function filee($header,$left, $head,$content,$footer){
	return preg_replace("/\{([^\{]{1,100}?)\}/e","$$1",file_get_contents(SITE_FS_PATH.'/includes/filecreate.txt'));
}

function banner_show($pagname,$pgloc,$limit='1')
{
	if($limit == '1')
			$order = " order by rand()";
	$sql = db_query("select * from ".tb_Prefix."banner where status='Active' and banner_catid like '%".$pagname."%'  and banner_pgloc like '%".$pgloc."%' ".$order." limit 0,".$limit);
	while($row = db_fetch_array($sql))
	{
		
		if($row['banner_name'] && file_exists("uploaded_files/banner/".$row['banner_name']))
		{
			echo "<a href='".make_url($row['banner_link'])."' target='_blank'><img src='"."uploaded_files/banner/".$row['banner_name']."' border=0></a>";
			if($limit > 1)
				echo "<br><br>";
		}
	}

}

function getuserdata($id)
{
	$sql = "select * from ".tb_Prefix."users where id='".$id."'";
	$result = db_query($sql);
	$row = db_fetch_array($result);
	return $row;
}

function curl($txt,$fol='',$id='')
{
	$name = str_replace(' ','-',trim($txt));
	$allowed = "/[^a-z0-9\\_-]/i";
 	$name = preg_replace($allowed,"",$name);
	$name = strtolower($name);

	$name1 = str_replace(' ','-',trim($fol));
	$allowed1 = "/[^a-z0-9\\_-]/i";
 	$name1 = preg_replace($allowed1,"",$name1);
	$name1 = strtolower($name1);

	return SITE_PATH.(($id)?$id.'-':"").(($name1)?$name1.'-':"").(($name)?$name.'':"").'.htm';
}
function cpname($txt,$rep='-')
{
	$txt = strtolower($txt);
	$name = str_replace(' ',$rep,$txt);
	$allowed = "/[^a-z0-9\\_-]/i";
 	$name = preg_replace($allowed,"",$name);
	$name = $name;
	return $name;
}

function easyquery($tablename,$where="1=1",$extra='',$key='*') {
	
	$sql = "select $key from ".tb_Prefix."$tablename where $where $extra";

	$result = db_query($sql);

	return $result;
}

function fetch_meta($url)
{
	$myarr = array();
	
	$content = '';
	if(($fp = @fopen($url, 'r')) === false) {

	} else {
	while( !feof($fp) ) {
		$buffer = trim( fgets($fp, 4096) );
		$content .= $buffer;
	}
	
	$image_regex_src_url = '/<img[^>]*'.

	'src=[\"|\'](.*)[\"|\'][^>]*width=[\"|\'](.*)[\"|\'][^>]*height=[\"|\'](.*)[\"|\']\ /Ui';

	preg_match_all($image_regex_src_url, $content, $out, PREG_PATTERN_ORDER);

	$images_url_array = $out[1];

	$images_height_array = $out[2];

	$images_width_array = $out[3];
	
	//print_r($images_url_array); //&& ($images_width_array[$i]<50 && $images_width_array[$i]>500)
	$n = 1;
	for($i=0;$i<=count($images_url_array);$i++)
	{
		
		if(($images_height_array[$i]>50 && $images_height_array[$i]<500) && ($images_width_array[$i]>50 && $images_width_array[$i]<500) && (substr($images_url_array[0],-3) == 'jpg' || substr($images_url_array[0],-3) == 'gif') && ((int)$images_height_array[$i] && (int)$images_width_array[$i])) {
		$imgurl = parse_url($images_url_array[$i]);
		$img_url1 = parse_url($url);
		$img_url = 'http://'.(($imgurl['host'])?$imgurl['host']:$img_url1['host'])."/".$imgurl['path'];
		$myarr['img'.$n] = $img_url;//.$images_height_array[$i].",".$images_width_array[$i]."<br>";
		$n++;
		}
	}


	$start = "<title>";
	$end = "<\/title>";
	
	preg_match("/$start(.*)$end/",$content,$match);

	$myarr['title'] = $match[1];
	$metatag = get_meta_tags($url);
	$myarr['keywords'] = $metatag['keywords'];
	$myarr['description'] = $metatag['description'];
	}
	return $myarr;
}

function get_tag()
{
	$s = db_query("select keywords from ".tb_Prefix."blog where status='Active'");
	$tagarr = array();
	while($r = db_fetch_array($s))
	{
		$ex = explode(",",$r['keywords']);
		foreach($ex as $k => $v) {
			if($v && !in_array($v,$tagarr)) 
				$tagarr[] = $v;
		}
	}
	$s1 = db_query("select keywords from ".tb_Prefix."testimonial where status='Active'");
	
	while($r1 = db_fetch_array($s1))
	{
		$ex1 = explode(",",$r1['keywords']);
		foreach($ex1 as $k1 => $v1) {
			if($v1 && !in_array($v1,$tagarr)) 
				$tagarr[] = $v1;
		}
	}
	if(count($tagarr)) {
		return  array_rand(array_flip($tagarr),count($tagarr));
	} else {
		return array();
	}
}
/*function cfile($path,$page, $id,$fexe){
	return $path.encode($id)."-".$page.$fexe;
}*/
function cfile($path,$page){
	return $pg=$path."page.php?pn=".enco($page, 'e');
}
function cfile2($path,$page){
	return $pg=$path."page.php?pn=".enco($page, 'e')."&tag=true";
}
/*function cfile2($path,$page, $id,$fexe){
	return $path.$id."-".$page.$fexe;
}
*/
function pageid($str, $file=''){
	$s1=explode("-", $str);
	if(!$file){
		return encode($s1[0], 'd');
	}else if($file=='i'){
		return $s1[0];
	}else{
		return compage($str);
	}	
}
function compage($str){
	$s1=explode("-", $str);	
	for($k=1; $k<sizeof($s1); $k++){
		$as[].=$s1[$k];
	}
	return implode("-",$as);
}
function pid($str){
	$sq2 = db_query("select page_id from ".tb_Prefix."pages where pname='".trim($str)."'");
	$row2 = db_fetch_array($sq2);
	return $row2[page_id];
}
function encode($a, $d=''){
	if($d=='d'){
		$a1=substr($a, 0, 4);
		$a2=substr($a,-4);
		$a11=explode($a1, $a);
		$a12=explode($a2, $a11[1]);
		return $a12[0];
	}else{
		return rand(1000, 9999).$a.rand(1000, 9999);
	}
}
function enco($p, $a=''){
	if($a=='e'){
		return base64_encode($p);
	}else{
		return base64_decode($p);
	}	
}
?>