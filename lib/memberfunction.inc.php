<?php
class ADMIN_DAL {  
	private $var;
	
	public function adminsbox(){
		return '';
	}
	
	public function adminebox(){
		return '';
	}
	
	public function admincids($val){
		$arr = explode(",",$val);
		$newarr = array();
		foreach($arr as $k => $v) {
			if($v)
				$newarr[] = $v;
		}
		return $newarr;
	}
	
	public function sessset($val, $msg=""){
		$_SESSION['sessmsg'] = $val;
		$_SESSION['alert'] = $msg;
	}
	
	public function adminpublish($val){
		if($val == 'Active'){
			return "Deactivate";
		} else {
			return "Activate";
		}
	}
	public function secure(){
		if (!$_SESSION["ses_adm_id"] and !$_SESSION["ses_adm_usr"]){
			header('Location: '.SITE_PATH_MEM.'login.php');
			exit;	 
		}
	}
	
	public function alert(){
		if($_SESSION['alert']=='e'){
			echo $this->error();
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='w'){
			echo $this->warning();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
		if($_SESSION['alert']=='s'){
			echo $this->success();	
			unset($_SESSION['sessmsg']);$_SESSION['sessmsg']='';
		}
	}
	
	
	public function error() {
		if($_SESSION['sessmsg']){
			return '<div class="alertMessage error SE" id="cls"><div class="text"><strong>'.$_SESSION['sessmsg'].'</strong></div><div class="close"><a href="javascript:void(0);" onclick="javascript:closemsg(\'cls\');"><img src="'.SITE_PATH_MEM.'images/close-btn.png" alt="Close" title="Close" width="10" height="9" border="0" /></a></div></div>';	
		}
	}
	
	public function warning() {
		if($_SESSION['sessmsg']){
			return '<div class="tool-tip" id="cls"><div class="text"><strong>'.$_SESSION['sessmsg'].'</strong></div><div class="close"><a href="javascript:void(0);" onclick="javascript:closemsg(\'cls\');"><img src="'.SITE_PATH_MEM.'images/close-btn.png" alt="Close" title="Close" width="10" height="9" border="0" /></a></div></div>';	
		}	
	}
	
	public function success() {
		if($_SESSION['sessmsg']){
			return '<div class="alertMessage success SE" id="cls"><div class="text"><strong>'.$_SESSION['sessmsg'].'</strong></div><div class="close"><a href="javascript:void(0);" onclick="javascript:closemsg(\'cls\');"><img src="'.SITE_PATH_MEM.'images/close-btn.png" alt="Close" title="Close" width="10" height="9" border="0" /></a></div></div>';	
		}	
	}
	
	public function rowerror($n) {
		return '<tr class="grey"><td align="center" colspan="'.$n.'"><b>Sorry! No record in databse.</b></td></tr>';	
	} 
	
	public function even_odd($vars){
			if($vars%2==1){
				return ' class="grey"';		
			}
	}
	
	public function orders($vars, $files=''){
		return $vars;
		//return '<a href="'.(($files)?$PHP_SELF:'javascript:void(0);').'">'.$vars.'</a>';
	}
	public function norders($vars){
		return $vars;
	}
	
	public function check_all(){
		return '<input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)">';
	}
	
	public function check_input($vars){
		return '<input name="arr_ids[]" type="checkbox" id="arr_ids[]" value="'.$vars.'">';
	}
	
	public function action($vars, $ids, $tags=''){
		return '<a href="'.$vars.'&id='.$ids.'"><img src="'.SITE_PATH_MEM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>&nbsp;&nbsp;<a href="'.SITE_PATH_MEM.(($tags)?$tags:CPAGE).'?id='.$ids.'&action=del&view=true" onclick="return confirm(\'Do you want delete this record?\');"><img src="'.SITE_PATH_MEM.'images/delete-icon.png" alt="Delete record" title="Delete record"/></a>';
	}
	public function cataction($vars, $ids, $tags=''){
		return '<a href="'.$vars.'?id='.$ids.'"><img src="'.SITE_PATH_MEM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>
		&nbsp;<a href="'.SITE_PATH_MEM.(($tags)?$tags:CPAGE).'?id='.$ids.'&action=del&view=true" onclick="return confirm(\'Do you want delete this record?\');"><img src="'.SITE_PATH_MEM.'images/delete-icon.png" alt="Delete record" title="Delete record"/></a>';
	}
	public function action_($vars, $ids){
		return '<a href="'.$vars.'&id='.$ids.'"><img src="'.SITE_PATH_MEM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>&nbsp;<img src="'.SITE_PATH_MEM.'images/lock.png" alt="Lock Page" title="Lock Page"/>';
	}
	
	public function action_e($vars, $ids){
		return '<a href="'.$vars.'&id='.$ids.'"><img src="'.SITE_PATH_MEM.'images/icon_edit.png" alt="Edit record" title="Edit record"/></a>';
	}
	
	public function h1_tag($vars, $others='&nbsp;'){
		return '<h1><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="50%" align="left">'.$vars.'</td><td width="50%">'.$others.'</td></tr></table></h1>';
	}
	
	public function heading($vars){
		return '<h2>'.$vars.'</h2>';
	}
	public function get_editor($fld, $vals, $path='', $w='900', $h='350'){
		return '<script type="text/javascript">
				window.onload = function(){
					var editor=CKEDITOR.replace(\''.$fld.'\',{
			        uiCoor : \'#9AB8F3\',
					width : \''.$w.'px\',
					height : \''.$h.'px\'
    			} );
				CKFinder.setupCKEditor( editor, \'/lib/ckfinder/\' );};</script><textarea name="'.$fld.'" id="'.$fld.'"  rows=""  cols="" class="textareas">'.$vals.'</textarea>';
	}
	
	public function get_editor_s($fld, $vals, $w='45', $h='7'){
		return '<textarea cols="'.$w.'" id="'.$fld.'" name="'.$fld.'" rows="'.$h.'">'.$vals.'</textarea>
		<script type="text/javascript">
		//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( \''.$fld.'\',
				{
					extraPlugins : \'uicolor\',
					toolbar :
					[
						[ \'Bold\', \'Italic\', \'-\', \'NumberedList\', \'BulletedList\', \'-\', \'Link\', \'Unlink\' ],
						[ \'UIColor\' ]
					]
				});

		//]]>
		</script>';
	}
	public function baseurl($vals){
		$vals = str_replace(" ", "-",trim(strtolower($vals)));
		$vals = str_replace("/", "-",$vals);
		$vals = str_replace("(", "-",$vals);
		$vals = str_replace(")", "-",$vals);
		$vals = str_replace("&", "-",$vals);
		$vals = str_replace("#", "-",$vals);
		$vals = str_replace("---", "-",$vals);
		$vals = str_replace("--", "-",$vals);
		return $vals;
	}
	
				
}
?>