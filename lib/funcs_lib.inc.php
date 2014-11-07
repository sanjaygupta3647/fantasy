<?php
class DAL {  
	//public function __construct(){} 
	private $var;
	public function connect_db() {
		global $ARR_CFGS;
		if (!isset($GLOBALS['dbcon'])) {
			$GLOBALS['dbcon'] =	mysql_connect($ARR_CFGS["db_host"], $ARR_CFGS["db_user"], $ARR_CFGS["db_pass"]);
			mysql_select_db($ARR_CFGS["db_name"]) or die("Could not connect to database. Please check configuration and ensure MySQL is running.");
		}
	}
	public function db_query_($sql, $dbcon2 = null) {
		if($dbcon2=='') {
			if(!isset($GLOBALS['dbcon'])) {
				$this->connect_db();
			}
			$dbcon2	= $GLOBALS['dbcon'];
		}
		$time_before_sql = $this->checkpoint();
		$result	= mysql_query($sql,	$dbcon2) or	die($this->db_error($sql));
		return $result;
	}
	
	public function db_query($sql, $dbcon2 = null) {
		$sql = str_replace("#_", tb_Prefix, $sql);
		if($dbcon2=='') {
			if(!isset($GLOBALS['dbcon'])) {
				$this->connect_db();
			}
			$dbcon2	= $GLOBALS['dbcon'];
		}
		$time_before_sql = $this->checkpoint();
		$result	= mysql_query($sql,	$dbcon2) or	die($this->db_error($sql));
		return $result;
	}
	
	public function db_fetch_array($rs) {
		$array	= mysql_fetch_array($rs);
		return $array;
	}
	
	
	public function db_scalar($sql, $dbcon2 = null) {
		if($dbcon2=='') {
			if(!isset($GLOBALS['dbcon'])) {
				$this->connect_db();
			}
			$dbcon2	= $GLOBALS['dbcon'];
		}
		$result	= $this->db_query($sql, $dbcon2);
		if ($line =	$this->db_fetch_array($result)) {
			$response =	$line[0];
		}
		return $response;
	}
	
	
	public function getSingleresult($sql, $dbcon2 = null) {
		if($dbcon2=='') {
			if(!isset($GLOBALS['dbcon'])) {
				$this->connect_db();
			}
			$dbcon2	= $GLOBALS['dbcon'];
		}
		$result	=$this->db_query($sql, $dbcon2);
		if ($line =	$this->db_fetch_array($result)) {
			$response =	$line[0];
		}
		return $response;
	}
	public function sqlquery_($rs='exe',$tablename,$arr,$update='',$id='',$update2='',$id2='') {
	
		$sql = $this->db_query_("DESC $tablename");
		$row = mysql_fetch_array($sql);
		if($update == '')
			$makesql = "insert into ";
		else
			$makesql = "update " ;
		$makesql .= "$tablename set ";
	
		$i = 1;
		while($row = mysql_fetch_array($sql)) {
			if(array_key_exists($row['Field'], $arr)) {
	
	
				if($i != 1)
					$makesql .= ", ";
	
				//$makesql .= $row['Field']."='".$this->ms_addslashes((is_array($arr[$row['Field']]))?implode(":",$arr[$row['Field']]):$arr[$row['Field']])."'";
				
				$makesql .= $row['Field']."='".addslashes((is_array($arr[$row['Field']]))?implode(":",$arr[$row['Field']]):$arr[$row['Field']])."'";
				
				
				$i++;
			}
	
		}
		if($update)
			$makesql .= " where ".$update."='".$id."'".(($update2 && $id2)?" and ".$update2."='".$id2."'":"");
		if($rs == 'show') {
			echo $makesql;
			exit;
		}
		else {
			$this->db_query_($makesql);
		}
		return ($update)?$id:mysql_insert_id();
	}
	
	public function sqlquery($rs='exe',$tablename,$arr,$update='',$id='',$update2='',$id2='') {
	
		$sql = $this->db_query("DESC ".tb_Prefix."$tablename");
		$row = mysql_fetch_array($sql);
		if($update == '')
			$makesql = "insert into ";
		else
			$makesql = "update " ;
		$makesql .= tb_Prefix."$tablename set ";
	
		$i = 1;
		while($row = mysql_fetch_array($sql)) {
			if(array_key_exists($row['Field'], $arr)) {
	
	
				if($i != 1)
					$makesql .= ", ";
	
				//$makesql .= $row['Field']."='".$this->ms_addslashes((is_array($arr[$row['Field']]))?implode(":",$arr[$row['Field']]):$arr[$row['Field']])."'";
				
				$makesql .= $row['Field']."='".addslashes((is_array($arr[$row['Field']]))?implode(":",$arr[$row['Field']]):$arr[$row['Field']])."'";
				
				
				$i++;
			}
	
		}
		if($update)
			$makesql .= " where ".$update."='".$id."'".(($update2 && $id2)?" and ".$update2."='".$id2."'":"");
		if($rs == 'show') {
			echo $makesql;
			exit;
		}
		else {
			$this->db_query($makesql);
		}
		return ($update)?$id:mysql_insert_id();
	}
	public function filequery($rs='exe',$tablename,$foldername,$arr,$update='',$id='',$update2='',$id2='') {
		$sp = array_keys($arr);
		$aa = "";
		for($c=0;$c<=(count($sp)-1);$c++) {
			if($arr[$sp[$c]]['name']) {
				$path = $this->bannerup($foldername);
				$sql = $this->db_query("DESC ".tb_Prefix."$tablename");
				$row = mysql_fetch_array($sql);
				if($update == '')
					$makesql = "insert into ";
				else
					$makesql = "update " ;
				$makesql .= tb_Prefix."$tablename set ";
	
				$i = 1;
				while($row = mysql_fetch_array($sql)) {
	
					if($row['Field'] == $sp[$c]) {
						$filename =$this-> uploadFile1($path,$arr[$row['Field']]['name'],$row['Field']);
						if($i != 1)
							$makesql .= ", ";
	
						//$makesql .= $row['Field']."='".$this->ms_addslashes($filename)."'";
						$makesql .= $row['Field']."='".addslashes($filename)."'";
						$i++;
					}
	
				}
				if($update)
					$makesql .= " where ".$update."='".$id."'".(($update2 && $id2)?" and ".$update2."='".$id2."'":"");
				if($rs == 'show') {
					echo $makesql;
					exit;
				}
				else {
					$this->db_query($makesql);
				}
				return ($update)?$id:mysql_insert_id();
			}
		}
	}
	
	public function getSingleresult_($sql, $dbcon2 = null) {
		if($dbcon2=='') {
			if(!isset($GLOBALS['dbcon'])) {
				$this->connect_db();
			}
			$dbcon2	= $GLOBALS['dbcon'];
		}
		$result	=$this->db_query_($sql, $dbcon2);
		if ($line =	$this->db_fetch_array($result)) {
			$response =	$line[0];
		}
		return $response;
	}
	
	
	public function db_error($sql) {
		echo "<div style='font-family: tahoma; font-size: 11px; color: #333333'><br>".mysql_error()."<br>";
		$this->print_error();
		if(LOCAL_MODE) {
			echo "<br>sql: $sql";
		}
		echo "</div>";
	}
	
	public function print_error() {
		$debug_backtrace = debug_backtrace();
		for ($i = 1; $i < count($debug_backtrace); $i++) {
			$error = $debug_backtrace[$i];
			echo "<br><div><span>File:</span> ".str_replace(SITE_FS_PATH, '',$error['file'])."<br><span>Line:</span> ".$error['line']."<br><span>Function:</span> ".$error['function']."<br></div>";
		}
	}
	
	
	public function mysql_time($hour, $minute,	$ampm) {
		if ($ampm == 'PM' && $hour != '12') {
			$hour += 12;
		}
		if ($ampm == 'AM' && $hour == '12') {
			$hour =	'00';
		}
		$mysql_time	= $hour	. ':' .	$minute	. ':00';
		return $mysql_time;
	}
	
	
	public function price_format($price) {
		if ($price != '' &&	$price != '0') {
			$price = number_format($price, 2);
			return CUR.$price;
		}
	}
	
	
	public function opin_date_format($date) {
		if (strlen($date) >= 10) {
			if ($date == '0000-00-00 00:00:00' || $date	== '0000-00-00') {
				return '';
			}
			$mktime	= mktime(0,	0, 0, substr($date,	5, 2), substr($date, 8,	2),	substr($date, 0, 4));
			return date("M j, Y", $mktime);
		} else {
			return $s;
		}
	}
	public function dateshow($time,$format='F j,Y'){
		return date($format,$time);
	}
	
	
	public function datetime_format($date) {
		global $arr_month_short;
		if (strlen($date) >= 10) {
			if ($date == '0000-00-00 00:00:00' || $date	== '0000-00-00') {
				return '';
			}
			$mktime	= mktime(substr($date, 11, 2), substr($date, 14, 2), substr($date, 17, 2),substr($date,	5, 2), substr($date, 8,	2),	substr($date, 0, 4));
			return date("M j, Y h:i A ", $mktime);
		} else {
			return $s;
		}
	}
	
	
	public function time_format($time) {
		if (strlen($time) >= 5) {
			$hour =	substr($time, 0, 2);
			$hour =	str_pad($hour, 2, "0", STR_PAD_LEFT);
	
			return $hour . ':' . substr($time, 3, 2) . ' ' . $ampm;
		} else {
			return $s;
		}
	}
	
	
	public function ms_print_r($var) {
		//if(LOCAL_MODE || $_SESSION['debug']){
		echo "<textarea rows='10' cols='148' style='font-size: 11px; font-family: tahoma'>";
		print_r($var);
		echo "</textarea>";
		//}
	}
	
	
	public function ms_form_value($var) {
		return is_array($var) ? array_map('ms_form_value', $var) : htmlspecialchars(stripslashes(trim($var)));
	}
	
	
	public function ms_display_value($var) {
		return is_array($var) ? array_map('ms_display_value', $var) : nl2br(htmlspecialchars(stripslashes(trim($var))));
	}
	
	public function ms_adds($var) {
		return trim(addslashes(stripslashes($var)));
	}
	
	
	public function ms_stripslashes($var) {
		return is_array($var) ? array_map('ms_stripslashes', $var) : stripslashes(trim($var));
	}
	
	
	public function ms_addslashes($var) {
		//return is_array($var) ? array_map('ms_addslashes', $var) : addslashes(stripslashes(trim($var)));
		//return addslashes(stripslashes(trim($var)));
	}
	
	
	public function ms_trim($var) {
		return is_array($var) ? array_map('ms_trim', $var) : trim($var);
	}
	
	public function is_image_valid($file_name) {
		global $ARR_VALID_IMG_EXTS;
		$ext = file_ext($file_name);
		if (in_array($ext, $ARR_VALID_IMG_EXTS)) {
			return true;
		} else {
			return false;
		}
	}
	
	
	public function getmicrotime() {
		list($usec,	$sec) =	explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	
	
	public function file_ext($file_name) {
		$path_parts = pathinfo($file_name);
		$ext = strtolower($path_parts["extension"]);
		return $ext;
	}
	
	
	public function blank_filter($var) {
		$var = trim($var);
		return ($var != '' && $var != '&nbsp;');
	}
	
	
	public function apply_filter($sql,	$field,	$field_filter, $column) {
		if (!empty($field)) {
			if ($field_filter == "=" || $field_filter == "") {
				$sql = $sql	. "	and	$column	= '$field' ";
			} else if ($field_filter == "like") {
				$sql = $sql	. "	and	$column	like '%$field%'	";
			} else if ($field_filter ==	"starts_with") {
				$sql = $sql	. "	and	$column	like '$field%' ";
			} else if ($field_filter ==	"ends_with") {
				$sql = $sql	. "	and	$column	like '%$field' ";
			} else if ($field_filter ==	"not_contains") {
				$sql = $sql	. "	and	$column	not	like '%$field%'	";
			} else if ($field_filter == ">") {
				$sql = $sql . " and $column > '$field' ";
			} else if ($field_filter == "<") {
				$sql = $sql . " and $column < '$field' ";
			} else if ($field_filter ==	"!=") {
				$sql = $sql	. "	and	$column	!= '$field'	";
			}
		}
		return $sql;
	}
	
	public function filter_dropdown($name	= 'filter',	$sel_value) {
		$arr = array( "like" => 'Contains', '=' => 'Is', "starts_with" => 'Starts with', "ends_with"	=> 'Ends with', "!=" => 'Is not' , "not_contains" => 'Not contains');
		return $this->array_dropdown($arr, $sel_value, $name);
	}
	
	
	public function move_up($table_name, $where_clause_all, $where_clause_item, $sort_order, $move_by) {
		$dest_order	= $sort_order -	$move_by;
		// $arr_ids_to_move=Array();
		// echo	"<br>$movie_artist_id, $movie_id, $artistcate_id, $sort_order, $move_by, $dest_order<br>";
		for($i = $sort_order-1;	$i > $dest_order-1;	$i--) {
			$sql = " update	$table_name	set	sort_order=sort_order+1	where $where_clause_all	and	sort_order='$i'";
			// echo	"<br>$sql<br>";
			$this->db_query($sql);
		}
		$sql = " update	$table_name	set	sort_order=sort_order-$move_by where $where_clause_item";
		// echo	"<br>$sql<br>";
		$this->db_query($sql);
	}
	
	
	public function move_down($table_name,	$where_clause_all, $where_clause_item, $sort_order,	$move_by) {
		$dest_order	= $sort_order +	$move_by;
		// $arr_ids_to_move=Array();
		// echo	"<br>$movie_artist_id, $movie_id, $artistcate_id, $sort_order, $move_by, $dest_order<br>";
		for($i = $sort_order + 1; $i < $dest_order + 1;	$i++) {
			$sql = " update	$table_name	set	sort_order=sort_order-1	where $where_clause_all	and	sort_order='$i'	";
			// echo	"<br>$sql<br>";
			$this->db_query($sql);
		}
		$sql = " update	$table_name	set	sort_order=sort_order+$move_by where $where_clause_item";
		// echo	"<br>$sql<br>";
		$this->db_query($sql);
	}
	
	// refine_list: Updated 31 may 2006
	public function refine_list($id_column, $table_name, $where_clause) {
		$sql = " select	$id_column,	sort_order from	$table_name	where $where_clause	order by sort_order";
		// echo	"<br>$sql<br>";
		$result	= $this->db_query($sql);
		$i = 1;
		while ($line = mysql_fetch_array($result)) {
			$sql = " update	$table_name	set	sort_order='$i'	where $id_column='$line[0]'";
			// echo	"<br>$sql<br>";
			$this->db_query($sql);
			$i++;
		}
	}
	
	
	public function make_url($url) {
		$parsed_url	= parse_url($url);
		if ($parsed_url['scheme'] == '') {
			return 'http://' . $url;
		} else {
			return $url;
		}
	}
	
	public function url($url, $dir='') {
		return SITE_PATH.(($dir)?$dir."/":'').$url.".html";
	}
	public function folder($url) {
		//$bodytag = str_replace(" ", "-", strtolower($url));
		//$bodytag = str_replace(" ", "-", $url);
		return $url;
	}
	public function onclickurl($url, $dir='') {
		return "onClick=\"location.href='".SITE_PATH.(($dir)?$dir."/":'').$url.".html'\"";
	}
	
	public function url2($url, $dir='') {
		return SITE_PATH.(($dir)?$dir."/":'').$url;
	}
	public function ms_mail($to, $subject, $message, $arr_headers= array()) {
		$str_headers = '';
		foreach($arr_headers as $name=>$value) {
			$str_headers .= "$name: $value\n";
		}
		@mail($to, $subject, $message, $str_headers);
		return true;
	}
	
	// make_thumb_im
	public function make_thumb_im($file_path, $arr_options) {
		$width		= $arr_options['width'];
		$height		= $arr_options['height'];
		$prefix		= $arr_options['prefix'];
		$target_dir	= $arr_options['target_dir'];
		$quality	= $arr_options['quality'];
	
		$path_parts = pathinfo($file_path);
	
		if($width=='') {
			$width = '120';
		}
	
		if($prefix=='') {
			$prefix = 'thumb_';
		}
		if($target_dir=='') {
			$target_dir = $path_parts["dirname"];
		}
	
		if($quality=='') {
			$quality = '70';
		}
	
		$size = @getimagesize($file_path);
		if($size=='') {
			return false;
		}
		$path_parts = pathinfo($file_path);
	
		$thumb_path="$target_dir/".$prefix.$path_parts["basename"];
	
		$cmd ="convert -resize ".$width.'x'." -quality $quality \"$file_path\" \"$thumb_path\" ";
		system($cmd);
		//echo("<br>$cmd");
		return $prefix.$path_parts["basename"];
	}
	
	
	public function date_to_mysql($date) {
		list($month, $day, $year) = explode('/', $date);
		return "$year-$month-$day";
	}
	
	
	public function export_delimited_file($sql, $arr_columns, $file_name='', $arr_substitutes='', $arr_tpls='' ) {
		if($file_name=='') {
			$file_name = time().'.txt';
		}
		header("Content-type: application/txt");
		header("Content-Disposition: attachment; filename=$file_name");
		$arr_db_cols= array_keys($arr_columns);
		$arr_headers= array_values($arr_columns);
		$str_columns = implode(',', $arr_db_cols);
		$sql= "select ".$str_columns." $sql" ;
	
		$result = $this->db_query($sql);
		$num_cols = count($arr_columns);
		//$i=0;
	
		foreach($arr_headers as $header) {
			//$i++;
			echo $header."\t";
			//if($i!=$num_cols){
			//	echo "\t";
			//}
		}
		while($line=mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\r\n";
			//echo("<br> ");
			foreach($line as $key => $value) {
				$value=str_replace("\n","",$value);
				$value=str_replace("\r","",$value);
				$value=str_replace("\t","",$value);
				if(is_array($arr_substitutes[$key])) {
					$value = $arr_substitutes[$key][$value];
				}
				if(isset($arr_tpls[$key])) {
					$code = str_replace('{1}', $value, $arr_tpls[$key]);
					//echo ("\$value = $code;");
					//echo("<br>");
					eval ("\$value = $code;");
				}
				echo $value."\t";
			}
		}
	}
	
	// to check how much time is lapsed before first call of this public function
	public function checkpoint($from_start = false) {
		global $PREV_CHECKPOINT;
		if($PREV_CHECKPOINT=='') {
			$PREV_CHECKPOINT = SCRIPT_START_TIME;
		}
		$cur_microtime = $this->getmicrotime();
	
		if($from_start) {
			return $cur_microtime - SCRIPT_START_TIME;
		} else {
			$time_taken = $cur_microtime - $PREV_CHECKPOINT;
			$PREV_CHECKPOINT = $cur_microtime;
			return $time_taken;
		}
	}
	
	
	public function readable_col_name($str) {
		return ucwords( str_replace('_', ' ', strtolower($str) ) );
	}
	
	
	public function ms_echo($str) {
		if(LOCAL_MODE) {
			echo($str);
		}
	}
	
	
	public function make_dropdown($sql, $sel_value =	'',	$combo_name, $extra = '', $choose_one = '') {
	
		$result	= $this->db_query($sql);
		if (mysql_num_rows($result)	> 0) {
			$str_dropdown = "<select name='$combo_name' id='$combo_name' $extra>";
			if(is_array($choose_one)) {
				foreach($choose_one as $key => $value) {
					$str_dropdown .= "<option value='$key '>$value</option>";
				}
			} else if ($choose_one	!= '') {
				$str_dropdown .= "<option value=''>$choose_one</option>";
			}
			while	($line = mysql_fetch_array($result)) {
				// if($css== "opt1"){ $css='opt2';}else{$css='opt1';};
				$str_dropdown .= "<option value=\"" . $this->ms_form_value($line[0]) . "\"";
				if(is_array($sel_value)) {
					if (in_array($line[0], $sel_value )) {
						$str_dropdown .= " selected ";
					}
				} else {
					if (trim($sel_value) == $line[0]) {
						$str_dropdown .= " selected='selected' ";
					} else {
						$str_dropdown .= "";
					}
				}
				$str_dropdown .= ">" .	$line[1] . "</option>";
			}
			$str_dropdown .= "</select>";
		}
		return $str_dropdown;
	}
	
	
	public function array_dropdown( $arr, $sel_value='', $name='', $extra='', $choose_one='', $arr_skip= array()) {
		$combo="<select name='$name' id='$name' $extra >";
		if($choose_one!='') {
			$combo.="<option value=\"\">$choose_one</option>";
		}
		foreach($arr as $key => $value) {
			if(is_array($arr_skip) && in_array($key, $arr_skip)) {
				continue;
			}
			$combo.='<option value="'.htmlspecialchars($key).'"';
			if(is_array($sel_value)) {
				if(in_array($key, $sel_value) || in_array(htmlspecialchars($key), $sel_value)) {
					$combo.=" selected ";
				}
			} else {
				if($sel_value==$key || $sel_value==htmlspecialchars($key)) {
					$combo.=" selected ";
				}
			}
			$combo.=" >$value</option>";
		}
		$combo.=" </select>";
		return $combo;
	}
	public function make_checkboxes($arr_tmp, $checkname, $checksel = '', $cols,	$missit, $style	= '', $tableattr = '') {
		if ($style != "") {
			$style = "class='" . $style	. "'";
		}
	
		$colwidth =	100	/ $cols;
		$colwidth =	round($colwidth, 2);
		$j = 0;
		/*
		$arr_tmp['Any']="Any";
		if($checksel==''){
			$checksel=Array("Any");
		}
		*/
		if(is_array($arr_tmp) && count($arr_tmp)) {
			foreach($arr_tmp as	$key =>	$value) {
				$tochecked = "";
				if (is_array($checksel)	&& in_array($key, $checksel)) {
					$tochecked = "checked";
				}
				if ($key !=	$missit) {
					if ($value != "") {
						if ($j == 0) {
							$checkstr .= "<table $tableattr><tr>\n";
						} else if (($j % $cols)	== 0) {
							$checkstr .= "</tr><tr>\n";
						}
						$checkstr .= "<td valign=top><INPUT TYPE='checkbox' $javascript	 NAME='$checkname" . '[]' .	"' value='$key'	$tochecked ></td><td $style nowrap> $value	</td>\n";
						$j++;
					}
				}
			}
			$j--;
			// echo	"$cols-($j%$cols)=".$cols-($j%$cols);
			// echo	"<BR>($j%$cols)=".($j%$cols);
			for($x = $j	% $cols;$x < 4;$x++) {
				if ($x != 3) {
					$checkstr .= "<td>&nbsp;</td>\n";
				} else {
					$checkstr .= "<td>&nbsp;</td></tr>\n";
				}
			}
			$checkstr .= "</table>";
		}
		return $checkstr;
	}
	
	
	public function make_radios($arr_tmp, $checkname, $checksel = '', $cols,	$missit, $style	= '', $tableattr = '') {
		if ($style != "") {
			$style = "class='" . $style	. "'";
		}
	
		$colwidth =	100	/ $cols;
		$colwidth =	round($colwidth, 2);
		$j = 1;
		/*
		$arr_tmp['Any']="Any";
		if($checksel==''){
			$checksel=Array("Any");
		}
		*/
		foreach($arr_tmp as	$key =>	$value) {
			$tochecked = "";
			if ($checksel == $key) {
				$tochecked = "checked";
			}
			if ($key !=	$missit) {
				if ($value != "") {
					if ($j == 1) {
						$checkstr .= "<table $tableattr><tr>\n";
					} else if (($j % $cols)	== 1) {
						$checkstr .= "</tr><tr>\n";
					}
					$checkstr .= "<td width='" . $colwidth . "%' $style	valign=top><INPUT TYPE='radio' $javascript	 NAME='$checkname' value='$key'	$tochecked	   > $value	</td>\n";
					$j++;
				}
			}
		}
		$j--;
		// echo	"$cols-($j%$cols)=".$cols-($j%$cols);
		// echo	"<BR>($j%$cols)=".($j%$cols);
		for($x = $j	% $cols;$x < 4;$x++) {
			if ($x != 3) {
				$checkstr .= "<td>&nbsp;</td>\n";
			} else {
				$checkstr .= "<td>&nbsp;</td></tr>\n";
			}
		}
		$checkstr .= "</table>";
		return $checkstr;
	}
	
	
	public function date_dropdown($pre, $selected_date = '', $start_year='', $end_year = '', $sort = 'asc') {
		$cur_date =	date("Y-m-d");
		$cur_date_day =	substr($cur_date, 8, 2);
		$cur_date_month	= substr($cur_date,	5, 2);
		$cur_date_year = substr($cur_date, 0, 4);
	
		if ($selected_date != '') {
			$selected_date_day = substr($selected_date,	8, 2);
			$selected_date_month = substr($selected_date, 5, 2);
			$selected_date_year	= substr($selected_date, 0,	4);
		}
		$date_dropdown	.= $this->month_dropdown($pre	. "month", $selected_date_month);
		$date_dropdown	.= $this->day_dropdown($pre .	"day", $selected_date_day);
		// echo($pre . "year: ". $selected_date_year);
		$date_dropdown	.= $this->year_dropdown($pre . "year", $selected_date_year, $start_year,	$end_year,	$sort);
		return $date_dropdown;
	}
	
	
	public function month_dropdown($name,	$selected_date_month = '', $extra='') {
		global $ARR_MONTHS;
	
		$date_dropdown	= "	<select	name='$name' $extra> <option value='0'>Month</option>";
		$i = 0;
		foreach ($ARR_MONTHS as $key => $value) {
			$date_dropdown	.= " <option ";
			if ($key == $selected_date_month) {
				$date_dropdown	.= " selected ";
			}
			$date_dropdown	.= " value='" .	str_pad($key, 2, "0",	STR_PAD_LEFT) .	"'>$value</option>";
		}
		$date_dropdown	.= "</select>";
		return $date_dropdown;
	}
	
	
	public function day_dropdown($name, $selected_date_day = '', $extra='') {
		$date_dropdown	.= "<select	name='$name' $extra>";
		$date_dropdown	.= "<option	value='0'>Date</option>";
		for($i = 1;$i <= 31;$i++) {
			//$s = date('S', mktime(1, 0,	0, 3, $i, 1970));
			$date_dropdown	.= " <option ";
			if ($i == $selected_date_day) {
				$date_dropdown	.= " selected ";
			}
			$date_dropdown	.= " value='" .	str_pad($i,	2, "0",	STR_PAD_LEFT) .	"'>" . $i .	$s . "</option>";
		}
		$date_dropdown	.= "</select>";
		return $date_dropdown;
	}
	
	
	public function year_dropdown($name, $selected_date_year = '', $start_year =	'',	$end_year = '', $extra='') {
		if ($start_year	== '') {
			$start_year	= DEFAULT_START_YEAR;
		}
	
		if ($end_year == '') {
			$end_year =	DEFAULT_END_YEAR;
		}
	
		$date_dropdown	.= "<select	name='$name' $extra>";
		$date_dropdown	.= "<option	value='0'>Year</option>";
	
		for($i = $start_year; $i <= $end_year; $i++) {
			$date_dropdown	.= " <option ";
			if ($i == $selected_date_year) {
				$date_dropdown	.= " selected ";
			}
			$date_dropdown	.= " value='" .	str_pad($i,	2, "0",	STR_PAD_LEFT) .	"'>" . str_pad($i, 2, "0", STR_PAD_LEFT) .	"</option>";
		}
		$date_dropdown	.= "</select>";
		return $date_dropdown;
	}
	
	
	public function time_dropdown($pre, $selected_time = '') {
		// echo("<br>selected_time:$selected_time");
		if ($selected_time != '' &&	$selected_time != ':') {
			$selected_hour = substr($selected_time,	0, 2);
			$selected_minute = substr($selected_time, 3, 2);
			/*
			if($selected_hour >11){
				$selected_ampm = "PM";
				$selected_hour -= 12;
			}else{
				$selected_ampm = "AM";
			}
			if($selected_hour==0){
				$selected_hour = 12;
			}
			*/
		}
		$str .= $this->hour_dropdown($pre, $selected_hour);
		$str .= '<b>:</b>';
		$str .= $this->minute_dropdown($pre, $selected_minute);
		return $str;
		// echo	"<br>$selected_hour, $selected_minute $selected_ampm <br>";
	}
	
	
	
	public function get_qry_str($over_write_key = array(),	$over_write_value =	array()) {
		global $_GET;
		$m = $_GET;
		if (is_array($over_write_key)) {
			$i = 0;
			foreach($over_write_key	as $key) {
				$m[$key] = $over_write_value[$i];
				$i++;
			}
		} else {
			$m[$over_write_key]	= $over_write_value;
		}
		$qry_str = $this->qry_str($m);
		return $qry_str;
	}
	
	
	public function qry_str($arr, $skip = '') {
		$s = "?";
		$i = 0;
		foreach($arr as	$key =>	$value) {
			if ($key !=	$skip) {
				if (is_array($value)) {
					foreach($value as $value2) {
						if ($i == 0) {
							$s .= $key . '[]=' . $value2;
							$i = 1;
						} else {
							$s .= '&' .	$key . '[]=' . $value2;
						}
					}
				} else {
					if ($i == 0) {
						$s .= "$key=$value";
						$i = 1;
					} else {
						$s .= "&$key=$value";
					}
				}
			}
		}
		return $s;
	}
	
	
	public function check_radio($s, $s2) {
		if (is_array($s2)) {
			// echo("<br>$s");
			// print_r($s2);
			if (in_array($s, $s2)) {
				return " checked ";
			}
		} else if ($s == $s2) {
			return " checked ";
		}
	}
	

	
	public function is_post_back() {
		if(count($_POST)>0) {
			return true;
		} else {
			return false;
		}
	
	}
	
	
	public function request_to_hidden($arr_skip='') {
		foreach($_REQUEST as $name => $value) {
			$s .= '<input type="hidden" name="'.$name.'" value="'.htmlspecialchars(stripslashes($value)).'">'."\n";
		}
		return $s;
	}
	
	public function sql_to_array_file($arr_name, $sql, $file, $full_table=false) {
		$str = "<?\n";
		$result = $this->db_query($sql);
		while ($line = mysql_fetch_array($result)) {
			//$line = $this->ms_addslashes($line);
			$line = addslashes($line);
			if($full_table) {
				$key = $line[0];
				foreach($line as $name=>$value) {
					if(!is_numeric($name)) {
						$str .= '$'.$arr_name."['".$key."']['".$name."'] = '".$value."';\n";
					}
				}
				$str .= "\n";
			} else {
				$str .= '$'.$arr_name."['".$line[0]."'] = '".$line[1]."';\n";
			}
		}
		$str .= "\n?>";
	
		$fh = fopen($file, 'w');
		fwrite($fh, $str);
		fclose($fh);
		return true;
	}
	
	
	public function array_radios($arr, $sel_value = '', $name = '', $cols = 3, $extra = '') {
		if ($style != "") {
			$style = "class='" . $style . "'";
		}
	
		$colwidth = 100 / $cols;
		$colwidth = round($colwidth, 2);
		$j = 1;
		foreach($arr as $key => $value) {
			$tochecked = "";
			if (is_array($sel_value) && in_array($key, $sel_value)) {
				$tochecked = "checked";
			}
			if ($key != $missit) {
				if ($value != "") {
					if ($j == 1) {
						$checkstr .= "<table $tableattr><tr>\n";
					} else if (($j % $cols) == 1 || $cols==1) {
						$checkstr .= "</tr><tr>\n";
					}
	
					$checkstr .= "<td width='" . $colwidth . "%' $style valign=top><INPUT TYPE='radio' $javascript  NAME='$name' value='$key' $tochecked     > $value </td>\n";
					$j++;
				}
			}
		}
		$j--;
		for($x = $j % $cols;$x < 4;$x++) {
			if ($x != 3) {
				$checkstr .= "<td>&nbsp;</td>\n";
			} else {
				$checkstr .= "<td>&nbsp;</td></tr>\n";
			}
		}
		$checkstr .= "</table>";
		return $checkstr;
	} 
	
	
	public function make_thumb_gd($imgPath, $destPath, $newWidth, $newHeight, $ratio_type = 'width', $quality = 70, $verbose = false) {
		$size = getimagesize($imgPath);
		if (!$size) {
			if ($verbose) {
				echo "Unable to read image info.";
			}
			return false;
		}
		$curWidth	= $size[0];
		$curHeight	= $size[1];
		$fileType	= $size[2];
	
		// width/height ratio
		$ratio =  $curWidth / $curHeight;
		$thumbRatio = $newWidth / $newHeight;
	
		$srcX = 0;
		$srcY = 0;
		$srcWidth = $curWidth;
		$srcHeight = $curHeight;
	
		if($ratio_type=='width_height') {
			$tmpWidth	= $newHeight * $ratio;
			if($tmpWidth > $newWidth) {
				$ratio_type='width';
			} else {
				$ratio_type='height';
			}
		}
	
	
		if($ratio_type=='width') {
			// If the dimensions for thumbnails are greater than original image do not enlarge
			if($newWidth > $curWidth) {
				$newWidth = $curWidth;
			}
			$newHeight	= $newWidth / $ratio;
		} else if($ratio_type=='height') {
			// If the dimensions for thumbnails are greater than original image do not enlarge
			if($newHeight > $curHeight) {
				$newHeight = $curHeight;
			}
			$newWidth	= $newHeight * $ratio;
		} else if($ratio_type=='crop') {
			if($ratio < $thumbRatio) {
				$srcHeight = round($curHeight*$ratio/$thumbRatio);
				$srcY = round(($curHeight-$srcHeight)/2);
			} else {
				$srcWidth = round($curWidth*$thumbRatio/$ratio);
				$srcX = round(($curWidth-$srcWidth)/2);
			}
		} else if($ratio_type=='distort') {
		}
	
		// create image
		switch ($fileType) {
			case 1:
				if (function_exists("imagecreatefromgif")) {
					$originalImage = imagecreatefromgif($imgPath);
				} else {
					if ($verbose) {
						echo "GIF images are not support in this php installation.";
						return false;
					}
				}
				$fileExt = 'gif';
				break;
			case 2:
				$originalImage = imagecreatefromjpeg($imgPath);
				$fileExt = 'jpg';
				break;
			case 3:
				$originalImage = imagecreatefrompng($imgPath);
				$fileExt = 'png';
				break;
			default:
				if ($verbose) {
					echo "Not a valid image type.";
				}
				return false;
		}
		// create new image
	
		$resizedImage = imagecreatetruecolor($newWidth, $newHeight);
		//echo "$srcX, $srcY, $newWidth, $newHeight, $curWidth, $curHeight";
		//echo "<br>$srcX, $srcY, $newWidth, $newHeight, $srcWidth, $srcHeight<br>";
		imagecopyresampled($resizedImage, $originalImage, 0, 0, $srcX, $srcY, $newWidth, $newHeight, $srcWidth, $srcHeight);
		imageinterlace($resizedImage, 1);
		switch ($fileExt) {
			case 'gif':
				imagegif($resizedImage, $destPath, $quality);
				break;
			case 'jpg':
				imagejpeg($resizedImage, $destPath, $quality);
				break;
			case 'png':
				imagepng($resizedImage, $destPath, $quality);
				break;
		}
		// return true if successfull
		return true;
	} 
	
	// show_thumb
	public function show_thumbOld($file_org, $width, $height, $ratio_type = 'width') {
		$path_parts = pathinfo($file_org);
		/*$file_name = str_replace(SITE_WS_PATH."/", "", $file_org);
		$file_name = str_replace("/", "^", $file_name);
		$cache_file = $width."x".$height.'__'.$ratio_type .'__'.$file_name;
	
		$file_fs_path = str_replace(SITE_WS_PATH, SITE_FS_PATH, $file_org);*/
		//$file_fs_path = str_replace(SITE_WS_PATH, SITE_FS_PATH, $file_org);
	
		$file_name = $path_parts['basename'];
		$file_name = str_replace("/", "^", $file_name);
		$cache_file = $width."x".$height.'__'.$ratio_type .'__'.$file_name;
		if(!is_file($path_parts['dirname']."/".$cache_file)) {
			$this->make_thumb_gd($file_org, $path_parts['dirname']."/".$cache_file, $width, $height, $ratio_type );
	
		}
		return $path_parts['dirname']."/".$cache_file;
	}
	
	public function show_thumb($file_org, $width, $height, $ratio_type = 'width') {
		$file_name = str_replace(SITE_WS_PATH."/", "", $file_org);
		$file_name = str_replace("/", "^", $file_name);
		$cache_file = $width."x".$height.'__'.$ratio_type .'__'.$file_name;
	
		$file_fs_path = str_replace(SITE_WS_PATH, SITE_FS_PATH, $file_org);
		if(!is_file(SITE_FS_PATH."/".THUMB_CACHE_DIR."/".$cache_file)) {
			$this->make_thumb_gd($file_fs_path, SITE_FS_PATH."/".THUMB_CACHE_DIR."/".$cache_file, $width, $height, $ratio_type );
		}
		return SITE_WS_PATH.THUMB_CACHE_DIR."/".$cache_file;
	}
	// ms_parse_keywords: Updated 31 may 2006
	// Temporary function. Need to be made more elegant or replace with regular expression
	public function ms_parse_keywords($keywords) {
		$arr_keywords = array();
		$dq_end =true;
		$sp_end = true;
		for ($i=0;$i<strlen($keywords);$i++) {
			//echo "<br>cur_token:$cur_token, cur_keyword:$cur_keyword, dq_start:$dq_start, dq_end:$dq_end, sp_start:$sp_start, sp_end:$sp_end,";
			$cur_token = $keywords[$i];
			if($cur_token=='"') {
				if($dq_start) {
					$dq_end = true;
					$dq_start = false;
					$arr_keywords[] = $cur_keyword;
					$cur_keyword = '';
				} else if($dq_end) {
					$dq_end = false;
					$dq_start = true;
					$sp_start = false;
				} else {
					$dq_end = false;
					$dq_start = true;
				}
			} else if($cur_token==' ') {
				if($sp_start || $dq_end) {
					$sp_end = true;
					$sp_start = false;
					$arr_keywords[] = $cur_keyword;
					$cur_keyword = '';
				} else if($sp_end && !$dq_start) {
					$sp_end = false;
					$sp_start = true;
				} else if($dq_start) {
					$cur_keyword .= $cur_token;
				}
			} else {
				$cur_keyword .= $cur_token;
			}
		}
	
		$arr_keywords[] =$cur_keyword;
		return $arr_keywords;
	}
	
	
	// pagesize_dropdown
	public function pagesize_dropdown($name, $value) {
		$arr = array('1'=>'1','10'=>'10','25'=>'25','50'=>'50','100'=>'100');
		$m = $_GET;
		unset($m['pagesize']);
		return $this->array_dropdown($arr, $value , $name, '  onchange="location.href=\''.$_SERVER['PHP_SELF'].qry_str($m).'&pagesize=\'+this.value" ');
	}
	
	// sql_to_assoc_array
	public function sql_to_assoc_array($sql) {
		$arr = array();
		$result = $this->db_query($sql);
		while ($line = mysql_fetch_array($result)) {
			$line = $this->ms_form_value($line);
			$arr[$line[0]] = $line[1];
		}
		return $arr;
	}
	
	
	// sql_to_index_array
	public function sql_to_index_array($sql) {
		$arr = array();
		$result = $this->db_query($sql);
		while ($line = mysql_fetch_array($result)) {
			$line = $this->ms_form_value($line);
			$arr[] = $line[0];
		}
		return $arr;
	}
	
	// sql_to_array
	public function sql_to_array($sql) {
		$arr = array();
		$result = $this->db_query($sql);
		while ($line = mysql_fetch_array($result)) {
			$line = $this->ms_form_value($line);
			array_push($arr, $line);
		}
		return $arr;
	}
	
	
	public function qry_str_to_hidden($str) {
		$fields='';
		if(substr($str,0,1)=='?') {
			$str = substr($str,1);
		}
		$arr = explode('&', $str);
		foreach($arr as $pair) {
			list($name, $value) = explode('=',$pair);
			if($name!='') {
				$fields.='<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'" />';
			}
		}
		return $fields;
	}
	
	// enum_to_array
	
	public function enum_to_array($table, $column) {
		$result = $this->db_query("show fields from $table");
		while ($line_raw = mysql_fetch_assoc($result)) {
			$line = $this->ms_display_value($line_raw);
			if($line['Field']==$column) {
				$Type = $line['Type'];
				$Type = substr($Type,6,-2);
				$arr_tmp = explode("','", $Type);
				foreach($arr_tmp as $val) {
					$arr[$val]=$val;
				}
				return $arr;
			}
		}
	}
	
	public function redir($url,$inpage=0) {
		if($inpage==0) {
			header('location: '.$url) or die("Cannot Send to next page");
			exit;
		}
		else {
			echo '
			<script type="text/javascript">
			<!--
			window.location.href="'.$url.'";
			-->
			</SCRIPT>'
			;
			exit;
		}
	}
			
	public function getFilename($filename) {
		$uniq = uniqid("");
		$arr=explode('.',$filename);
		$ext = $arr[count($arr)-1];
	
		$allowed = "/[^a-z0-9\\_]/i";
		$arr[0] = preg_replace($allowed,"",$arr[0]);
	
		$filename=$uniq.$arr[0]."_.".$ext;
	
		return $filename;
	}
	public function getextention($fname){
		$fext=explode(".",$fname);
		$ext=$fext[count($fext)-1];
		return $ext;
	}
	
	public  function checkpath($PATH){
		if(!is_dir($PATH)){
			mkdir($PATH,0777);
		}
	}
	public function uploadFile($PATH,$FILENAME,$FILEBOX){
		global $temp_file; 
		$this->checkpath($PATH);
		$PATH = $PATH.'/';
		$ext = strtolower($this->getextention($FILENAME));
		$FILENAME_= time()."_".mt_rand(1,1000);
		$temp_file = SITE_FS_PATH."/".THUMB_CACHE_DIR."/".$FILENAME_;
		if (isset($_FILES[$FILEBOX])){
			switch($_FILES[$FILEBOX]['type']){
				case "image/png":
					$file = $temp_file.".".$ext;
					$FILENAME = $FILENAME_.".jpg";
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
					$imageObject = imagecreatefrompng($file);
					imagejpeg($imageObject,$PATH.$FILENAME);
					unlink($file);
					//imagedestroy($imageObject);
					break;
				case "image/gif":
					$file = $temp_file.".".$ext;
					$FILENAME = $FILENAME_.".jpg";
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
					$imageObject = imagecreatefromgif($file);
					imagejpeg($imageObject,$PATH.$FILENAME);
					unlink($file);
					//imagedestroy($imageObject);
					break; 
				case "image/bmp":
					$file = $temp_file.".".$ext;
					$FILENAME = $FILENAME_.".jpeg";
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);
					$imageObject = imagecreatefromwbmp($file);
					imagejpeg($imageObject,$PATH.$FILENAME);
					unlink($file);
					//imagedestroy($imageObject);
					break; 
				default:
					$file = $PATH.$FILENAME_.".".$ext;
					$FILENAME = $FILENAME_.".".$ext;
					move_uploaded_file($_FILES[$FILEBOX]['tmp_name'], $file);	
			}
		}	
		return $FILENAME;
	}
	public function storeImage1($tmp_name, $filename, $path, $type, $typeid, $name='Main') {
		$filename = $this->getFilename($filename);
		$PATH = $path.'/';
		list($wi,$hi)=getimagesize($tmp_name);

		$this->db_query("insert into ".tb_Prefix."images set id='', name='$name', type='$type', type_id='$typeid', path= '$filename', status='Active'");
	}
	
	public function storeImage($tmp_name, $filename, $path, $type, $typeid, $name='Main') {
		$filename = $this->getFilename($filename);
		$PATH = $path.'/';
		list($wi,$hi)=getimagesize($tmp_name);
		$this->sqlquery("rs","pages",array($name=>$filename),'page_id',$typeid);
	}
	
	public function showimg($type,$id,$fol,$imgid='') {
		$nn = $fol;
		if($imgid)
			$wh = " and name='".$imgid."'";
		$img = $this->getSingleresult("select path from ".tb_Prefix."images where type='".$type."' and type_id='".$id."'".$wh);
		if($img != '' && file_exists($nn.'/'.$img)) {
			return $nn.'/'.$img;
		}
		else {
			return "images/noimgbig.gif";
		}
	}
	
	public function showmess(){
		if($_SESSION['sessmsg']){
			echo "<table width='100%'>";
			echo "<tr>";
			echo "<td class='error-item'><span>";
			echo $_SESSION['sessmsg'];
			echo "</span></td>";
			echo "</tr>";
			echo "</table>";
			$_SESSION['sessmsg'] = '';
			unset($_SESSION['sessmsg']);
		}
	}
	public function sessset($val){
		$_SESSION['sessmsg'] = $val;
	}
	public function alt($val){
		return 'alt="'.$val.'" title="'.$val.'"';
	}
	
	public function sendmail($to, $subject, $message, $fname='', $femail=''){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.(($fname)?$fname:$this->getSingleresult("select company from #_setting where `id`='1'")).' <'.(($femail)?$femail:$this->getSingleresult("select email from #_setting where `id`='1'")).'>' . "\r\n";
		@mail($to, $subject, $message, $headers);
	}
	public function  sform($vals=''){
		return '<form method="post" enctype="multipart/form-data" name="aforms" action=""  '.$vals.'>';
	}
	
	public function  eform(){
		return '</form>';
	}
	public function pageinfo($page){
		$pageInfo = array();
		$pageInfo[title] = $this->get_static_content('meta_title',$page);
		$pageInfo[keyword] = $this->get_static_content('meta_keyword',$page);
		$pageInfo[description] = $this->get_static_content('meta_description',$page);
		$pageInfo[heading] = $this->get_static_content('heading',$page);
		$pageInfo[body] = $this->get_static_content('body',$page);
		$pageInfo[pimage] = $this->get_static_content('pimage',$page);
		return $pageInfo;
	}

	public function get_static_content($key,$pname){
		return $rs = $this->db_scalar("select ".$key." from #_pages where url='$pname'");
	}
	
	public function cal($fld,$val="",$class='', $frmt='yyyy/mm/dd'){
	  return '<input type="text" value="'.(($val)?$val:'').'" class="'.$class.'" readonly name="'.$fld.'" onclick="displayCalendar(document.forms[0].'.$fld.',\''.$frmt.'\',this)"/><div id="debug"></div>';
		
	}
	public function ptr($key){
		$key1 = str_replace("<p>","", $key);
		$rs = str_replace("</p>","", $key1);
		$rs = str_replace("<span>","", $rs);
		$rs = str_replace("</span>","", $rs);
		return $rs;
	}
	public function access(){
		if(!$_SESSION[uid] and !$_SESSION[eid]){
			$this->redir($this->url("login"),true);	
		}
	}
	function getShipping($shipamt)
	{
	$rsAdmin=$this->db_query("select * from #_shipping"); 
	$totCount = mysql_num_rows($rsAdmin);
	$i =1;
		while($arrAdmin=$this->db_fetch_array($rsAdmin))
		{
			 @extract($arrAdmin); 
			  if($shipamt>=$ranges && $shipamt<=$rangee) 
			  {
					//return  "case : ".$i ." for '$shipamt' =>".$ranges." & ".$rangee." = ".  $ship; 
				 return $ship;
				 exit; 
			  } 
			  else
			  if($i==$totCount)	
			  {
				return $ship;
			   //return  $ranges." & ".$rangee." = ".  $ship; 
			  }
			  $i++;
			  
		} 
	}
 function getDiscountPercent($actprice, $disPricwe)
	{
	if(!$actprice) return 0; 
	if(!$disPricwe) return 0;
	$diff  =  $actprice - $disPricwe;
	$per = ceil(($diff*100)/$actprice);
	return $per; 
	}
	public function imgthumb($imgpath,$h,$w){  
			$image = imagecreatefromjpeg($imgpath); 
			//get image dimension
			$dim=getimagesize($imgpath); 
			//create empty image
			$thumb_image=imagecreatetruecolor($w, $h); 
			//Resize original image and copy it to thumb image
			imagecopyresampled($thumb_image, $image, 0, 0, 0, 0,
								$w, $h, $dim[0], $dim[1]); 
			//display thumb image
			return imagejpeg($thumb_image);
	}
	public function make_thumb($src, $dest, $desired_width,$desired_height) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	//$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
	}
	public function geturl(){
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	 
 
	 public function removeSlash($str) {
	 $badFriends = '/(\\\)/';
	 $str = preg_replace($badFriends, '', $str);
	 return $str;
	}
	 function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}
	public function getSiteEmails($store_id = 0){
		if($store_id == 0){
		$qry = "select email from #_subscribe_list where status = 'Active'";
		}
		else{
		$qry = "select email from #_subscribe_list where status = 'Active' and store_id = '$store_id'";
		}
		$rsAdmin=$this->db_query($qry);
		while($arrAdmin=$this->db_fetch_array($rsAdmin)){
		extract($arrAdmin);
		$emails .= $email.", ";
		}
		$emails = substr($emails,0,-2);
		return $emails;
	}
	function createXmlFile(){ 
		 global $fixurls;
		 $content ='<?xml version="1.0" encoding="UTF-8"?>';  
		 $content .= '<urlset
			  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
			  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
			  xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

		if(count($fixurls)){
			foreach($fixurls as $val){
			$content .='<url>
						<loc>'.$val.'</loc>						 
						<priority>1</priority></url>';
			
			}
		}
		$rs = $this->db_query("select pid,url,priority from #_series  ");
		if(mysql_num_rows($rs)>0){
			
 			while($res = $this->db_fetch_array($rs)){extract($res); 
					$content .='<url>
						<loc>'.SITE_PATH.$url."/".$pid.'</loc>						 
						<priority>'.$priority.'</priority></url>'; 
		   } 	 
		}	 
		$rs = $this->db_query("select pid,url,priority from #_matches  ");
		if(mysql_num_rows($rs)>0){
		while($res = $this->db_fetch_array($rs)){extract($res); 
					$content .='<url>
						<loc>'.SITE_PATH.$url."/".$pid.'</loc>						 
						<priority>'.$priority.'</priority></url>'; 
		   } 	 
		}	
		$rs = $this->db_query("select pid,url,priority from #_news  ");
		if(mysql_num_rows($rs)>0){
		while($res = $this->db_fetch_array($rs)){extract($res); 
					$content .='<url>
						<loc>'.SITE_PATH.'news/'.$url."/".$pid.'</loc>						 
						<priority>'.$priority.'</priority></url>'; 
		   } 	 
		}
		$content .='</urlset>';		 		 
		$myFile = SITE_FS_PATH."/sitemap.xml";
		$fh = fopen($myFile, 'w') or die("can't open file");	
		fwrite($fh, $content);
		fclose($fh);	 	 
	}
	function get_time_zone($country, $region)
	{
		switch ($country) {
			case "AD":
				$timezone = "Europe/Andorra";
				break;
			case "AE":
				$timezone = "Asia/Dubai";
				break;
			case "AF":
				$timezone = "Asia/Kabul";
				break;
			case "AG":
				$timezone = "America/Antigua";
				break;
			case "AI":
				$timezone = "America/Anguilla";
				break;
			case "AL":
				$timezone = "Europe/Tirane";
				break;
			case "AM":
				$timezone = "Asia/Yerevan";
				break;
			case "AN":
				$timezone = "America/Curacao";
				break;
			case "AO":
				$timezone = "Africa/Luanda";
				break;
			case "AQ":
				$timezone = "Antarctica/South_Pole";
				break;
			case "AR":
				switch ($region) {
					case "01":
						$timezone = "America/Argentina/Buenos_Aires";
						break;
					case "02":
						$timezone = "America/Argentina/Catamarca";
						break;
					case "03":
						$timezone = "America/Argentina/Tucuman";
						break;
					case "04":
						$timezone = "America/Argentina/Rio_Gallegos";
						break;
					case "05":
						$timezone = "America/Argentina/Cordoba";
						break;
					case "06":
						$timezone = "America/Argentina/Tucuman";
						break;
					case "07":
						$timezone = "America/Argentina/Buenos_Aires";
						break;
					case "08":
						$timezone = "America/Argentina/Buenos_Aires";
						break;
					case "09":
						$timezone = "America/Argentina/Tucuman";
						break;
					case "10":
						$timezone = "America/Argentina/Jujuy";
						break;
					case "11":
						$timezone = "America/Argentina/San_Luis";
						break;
					case "12":
						$timezone = "America/Argentina/La_Rioja";
						break;
					case "13":
						$timezone = "America/Argentina/Mendoza";
						break;
					case "14":
						$timezone = "America/Argentina/Buenos_Aires";
						break;
					case "15":
						$timezone = "America/Argentina/San_Luis";
						break;
					case "16":
						$timezone = "America/Argentina/Buenos_Aires";
						break;
					case "17":
						$timezone = "America/Argentina/Salta";
						break;
					case "18":
						$timezone = "America/Argentina/San_Juan";
						break;
					case "19":
						$timezone = "America/Argentina/San_Luis";
						break;
					case "20":
						$timezone = "America/Argentina/Rio_Gallegos";
						break;
					case "21":
						$timezone = "America/Argentina/Buenos_Aires";
						break;
					case "22":
						$timezone = "America/Argentina/Catamarca";
						break;
					case "23":
						$timezone = "America/Argentina/Ushuaia";
						break;
					case "24":
						$timezone = "America/Argentina/Tucuman";
						break;
			}
			break;
			case "AS":
				$timezone = "Pacific/Pago_Pago";
				break;
			case "AT":
				$timezone = "Europe/Vienna";
				break;
			case "AU":
				switch ($region) {
					case "01":
						$timezone = "Australia/Sydney";
						break;
					case "02":
						$timezone = "Australia/Sydney";
						break;
					case "03":
						$timezone = "Australia/Darwin";
						break;
					case "04":
						$timezone = "Australia/Brisbane";
						break;
					case "05":
						$timezone = "Australia/Adelaide";
						break;
					case "06":
						$timezone = "Australia/Hobart";
						break;
					case "07":
						$timezone = "Australia/Melbourne";
						break;
					case "08":
						$timezone = "Australia/Perth";
						break;
			}
			break;
			case "AW":
				$timezone = "America/Aruba";
				break;
			case "AX":
				$timezone = "Europe/Mariehamn";
				break;
			case "AZ":
				$timezone = "Asia/Baku";
				break;
			case "BA":
				$timezone = "Europe/Sarajevo";
				break;
			case "BB":
				$timezone = "America/Barbados";
				break;
			case "BD":
				$timezone = "Asia/Dhaka";
				break;
			case "BE":
				$timezone = "Europe/Brussels";
				break;
			case "BF":
				$timezone = "Africa/Ouagadougou";
				break;
			case "BG":
				$timezone = "Europe/Sofia";
				break;
			case "BH":
				$timezone = "Asia/Bahrain";
				break;
			case "BI":
				$timezone = "Africa/Bujumbura";
				break;
			case "BJ":
				$timezone = "Africa/Porto-Novo";
				break;
			case "BL":
				$timezone = "America/St_Barthelemy";
				break;
			case "BM":
				$timezone = "Atlantic/Bermuda";
				break;
			case "BN":
				$timezone = "Asia/Brunei";
				break;
			case "BO":
				$timezone = "America/La_Paz";
				break;
			case "BQ":
				$timezone = "America/Curacao";
				break;
			case "BR":
				switch ($region) {
					case "01":
						$timezone = "America/Rio_Branco";
						break;
					case "02":
						$timezone = "America/Maceio";
						break;
					case "03":
						$timezone = "America/Sao_Paulo";
						break;
					case "04":
						$timezone = "America/Manaus";
						break;
					case "05":
						$timezone = "America/Bahia";
						break;
					case "06":
						$timezone = "America/Fortaleza";
						break;
					case "07":
						$timezone = "America/Sao_Paulo";
						break;
					case "08":
						$timezone = "America/Sao_Paulo";
						break;
					case "11":
						$timezone = "America/Campo_Grande";
						break;
					case "13":
						$timezone = "America/Belem";
						break;
					case "14":
						$timezone = "America/Cuiaba";
						break;
					case "15":
						$timezone = "America/Sao_Paulo";
						break;
					case "16":
						$timezone = "America/Belem";
						break;
					case "17":
						$timezone = "America/Recife";
						break;
					case "18":
						$timezone = "America/Sao_Paulo";
						break;
					case "20":
						$timezone = "America/Fortaleza";
						break;
					case "21":
						$timezone = "America/Sao_Paulo";
						break;
					case "22":
						$timezone = "America/Recife";
						break;
					case "23":
						$timezone = "America/Sao_Paulo";
						break;
					case "24":
						$timezone = "America/Porto_Velho";
						break;
					case "25":
						$timezone = "America/Boa_Vista";
						break;
					case "26":
						$timezone = "America/Sao_Paulo";
						break;
					case "27":
						$timezone = "America/Sao_Paulo";
						break;
					case "28":
						$timezone = "America/Maceio";
						break;
					case "29":
						$timezone = "America/Sao_Paulo";
						break;
					case "30":
						$timezone = "America/Recife";
						break;
					case "31":
						$timezone = "America/Araguaina";
						break;
			}
			break;
			case "BS":
				$timezone = "America/Nassau";
				break;
			case "BT":
				$timezone = "Asia/Thimphu";
				break;
			case "BV":
				$timezone = "Antarctica/Syowa";
				break;
			case "BW":
				$timezone = "Africa/Gaborone";
				break;
			case "BY":
				$timezone = "Europe/Minsk";
				break;
			case "BZ":
				$timezone = "America/Belize";
				break;
			case "CA":
				switch ($region) {
					case "AB":
						$timezone = "America/Edmonton";
						break;
					case "BC":
						$timezone = "America/Vancouver";
						break;
					case "MB":
						$timezone = "America/Winnipeg";
						break;
					case "NB":
						$timezone = "America/Halifax";
						break;
					case "NL":
						$timezone = "America/St_Johns";
						break;
					case "NS":
						$timezone = "America/Halifax";
						break;
					case "NT":
						$timezone = "America/Yellowknife";
						break;
					case "NU":
						$timezone = "America/Rankin_Inlet";
						break;
					case "ON":
						$timezone = "America/Toronto";
						break;
					case "PE":
						$timezone = "America/Halifax";
						break;
					case "QC":
						$timezone = "America/Montreal";
						break;
					case "SK":
						$timezone = "America/Regina";
						break;
					case "YT":
						$timezone = "America/Whitehorse";
						break;
			}
			break;
			case "CC":
				$timezone = "Indian/Cocos";
				break;
			case "CD":
				switch ($region) {
					case "01":
						$timezone = "Africa/Kinshasa";
						break;
					case "02":
						$timezone = "Africa/Kinshasa";
						break;
					case "03":
						$timezone = "Africa/Kinshasa";
						break;
					case "04":
						$timezone = "Africa/Lubumbashi";
						break;
					case "05":
						$timezone = "Africa/Lubumbashi";
						break;
					case "06":
						$timezone = "Africa/Kinshasa";
						break;
					case "07":
						$timezone = "Africa/Lubumbashi";
						break;
					case "08":
						$timezone = "Africa/Kinshasa";
						break;
					case "09":
						$timezone = "Africa/Lubumbashi";
						break;
					case "10":
						$timezone = "Africa/Lubumbashi";
						break;
					case "11":
						$timezone = "Africa/Lubumbashi";
						break;
					case "12":
						$timezone = "Africa/Lubumbashi";
						break;
			}
			break;
			case "CF":
				$timezone = "Africa/Bangui";
				break;
			case "CG":
				$timezone = "Africa/Brazzaville";
				break;
			case "CH":
				$timezone = "Europe/Zurich";
				break;
			case "CI":
				$timezone = "Africa/Abidjan";
				break;
			case "CK":
				$timezone = "Pacific/Rarotonga";
				break;
			case "CL":
				$timezone = "America/Santiago";
				break;
			case "CM":
				$timezone = "Africa/Lagos";
				break;
			case "CN":
				switch ($region) {
					case "01":
						$timezone = "Asia/Shanghai";
						break;
					case "02":
						$timezone = "Asia/Shanghai";
						break;
					case "03":
						$timezone = "Asia/Shanghai";
						break;
					case "04":
						$timezone = "Asia/Shanghai";
						break;
					case "05":
						$timezone = "Asia/Harbin";
						break;
					case "06":
						$timezone = "Asia/Chongqing";
						break;
					case "07":
						$timezone = "Asia/Shanghai";
						break;
					case "08":
						$timezone = "Asia/Harbin";
						break;
					case "09":
						$timezone = "Asia/Shanghai";
						break;
					case "10":
						$timezone = "Asia/Shanghai";
						break;
					case "11":
						$timezone = "Asia/Chongqing";
						break;
					case "12":
						$timezone = "Asia/Shanghai";
						break;
					case "13":
						$timezone = "Asia/Urumqi";
						break;
					case "14":
						$timezone = "Asia/Chongqing";
						break;
					case "15":
						$timezone = "Asia/Chongqing";
						break;
					case "16":
						$timezone = "Asia/Chongqing";
						break;
					case "18":
						$timezone = "Asia/Chongqing";
						break;
					case "19":
						$timezone = "Asia/Harbin";
						break;
					case "20":
						$timezone = "Asia/Harbin";
						break;
					case "21":
						$timezone = "Asia/Chongqing";
						break;
					case "22":
						$timezone = "Asia/Harbin";
						break;
					case "23":
						$timezone = "Asia/Shanghai";
						break;
					case "24":
						$timezone = "Asia/Chongqing";
						break;
					case "25":
						$timezone = "Asia/Shanghai";
						break;
					case "26":
						$timezone = "Asia/Chongqing";
						break;
					case "28":
						$timezone = "Asia/Shanghai";
						break;
					case "29":
						$timezone = "Asia/Chongqing";
						break;
					case "30":
						$timezone = "Asia/Chongqing";
						break;
					case "31":
						$timezone = "Asia/Chongqing";
						break;
					case "32":
						$timezone = "Asia/Chongqing";
						break;
					case "33":
						$timezone = "Asia/Chongqing";
						break;
			}
			break;
			case "CO":
				$timezone = "America/Bogota";
				break;
			case "CR":
				$timezone = "America/Costa_Rica";
				break;
			case "CU":
				$timezone = "America/Havana";
				break;
			case "CV":
				$timezone = "Atlantic/Cape_Verde";
				break;
			case "CW":
				$timezone = "America/Curacao";
				break;
			case "CX":
				$timezone = "Indian/Christmas";
				break;
			case "CY":
				$timezone = "Asia/Nicosia";
				break;
			case "CZ":
				$timezone = "Europe/Prague";
				break;
			case "DE":
				$timezone = "Europe/Berlin";
				break;
			case "DJ":
				$timezone = "Africa/Djibouti";
				break;
			case "DK":
				$timezone = "Europe/Copenhagen";
				break;
			case "DM":
				$timezone = "America/Dominica";
				break;
			case "DO":
				$timezone = "America/Santo_Domingo";
				break;
			case "DZ":
				$timezone = "Africa/Algiers";
				break;
			case "EC":
				switch ($region) {
					case "01":
						$timezone = "Pacific/Galapagos";
						break;
					case "02":
						$timezone = "America/Guayaquil";
						break;
					case "03":
						$timezone = "America/Guayaquil";
						break;
					case "04":
						$timezone = "America/Guayaquil";
						break;
					case "05":
						$timezone = "America/Guayaquil";
						break;
					case "06":
						$timezone = "America/Guayaquil";
						break;
					case "07":
						$timezone = "America/Guayaquil";
						break;
					case "08":
						$timezone = "America/Guayaquil";
						break;
					case "09":
						$timezone = "America/Guayaquil";
						break;
					case "10":
						$timezone = "America/Guayaquil";
						break;
					case "11":
						$timezone = "America/Guayaquil";
						break;
					case "12":
						$timezone = "America/Guayaquil";
						break;
					case "13":
						$timezone = "America/Guayaquil";
						break;
					case "14":
						$timezone = "America/Guayaquil";
						break;
					case "15":
						$timezone = "America/Guayaquil";
						break;
					case "17":
						$timezone = "America/Guayaquil";
						break;
					case "18":
						$timezone = "America/Guayaquil";
						break;
					case "19":
						$timezone = "America/Guayaquil";
						break;
					case "20":
						$timezone = "America/Guayaquil";
						break;
					case "22":
						$timezone = "America/Guayaquil";
						break;
					case "24":
						$timezone = "America/Guayaquil";
						break;
			}
			break;
			case "EE":
				$timezone = "Europe/Tallinn";
				break;
			case "EG":
				$timezone = "Africa/Cairo";
				break;
			case "EH":
				$timezone = "Africa/El_Aaiun";
				break;
			case "ER":
				$timezone = "Africa/Asmara";
				break;
			case "ES":
				switch ($region) {
					case "07":
						$timezone = "Europe/Madrid";
						break;
					case "27":
						$timezone = "Europe/Madrid";
						break;
					case "29":
						$timezone = "Europe/Madrid";
						break;
					case "31":
						$timezone = "Europe/Madrid";
						break;
					case "32":
						$timezone = "Europe/Madrid";
						break;
					case "34":
						$timezone = "Europe/Madrid";
						break;
					case "39":
						$timezone = "Europe/Madrid";
						break;
					case "51":
						$timezone = "Africa/Ceuta";
						break;
					case "52":
						$timezone = "Europe/Madrid";
						break;
					case "53":
						$timezone = "Atlantic/Canary";
						break;
					case "54":
						$timezone = "Europe/Madrid";
						break;
					case "55":
						$timezone = "Europe/Madrid";
						break;
					case "56":
						$timezone = "Europe/Madrid";
						break;
					case "57":
						$timezone = "Europe/Madrid";
						break;
					case "58":
						$timezone = "Europe/Madrid";
						break;
					case "59":
						$timezone = "Europe/Madrid";
						break;
					case "60":
						$timezone = "Europe/Madrid";
						break;
			}
			break;
			case "ET":
				$timezone = "Africa/Addis_Ababa";
				break;
			case "FI":
				$timezone = "Europe/Helsinki";
				break;
			case "FJ":
				$timezone = "Pacific/Fiji";
				break;
			case "FK":
				$timezone = "Atlantic/Stanley";
				break;
			case "FM":
				$timezone = "Pacific/Pohnpei";
				break;
			case "FO":
				$timezone = "Atlantic/Faroe";
				break;
			case "FR":
				$timezone = "Europe/Paris";
				break;
			case "FX":
				$timezone = "Europe/Paris";
				break;
			case "GA":
				$timezone = "Africa/Libreville";
				break;
			case "GB":
				$timezone = "Europe/London";
				break;
			case "GD":
				$timezone = "America/Grenada";
				break;
			case "GE":
				$timezone = "Asia/Tbilisi";
				break;
			case "GF":
				$timezone = "America/Cayenne";
				break;
			case "GG":
				$timezone = "Europe/Guernsey";
				break;
			case "GH":
				$timezone = "Africa/Accra";
				break;
			case "GI":
				$timezone = "Europe/Gibraltar";
				break;
			case "GL":
				switch ($region) {
					case "01":
						$timezone = "America/Thule";
						break;
					case "02":
						$timezone = "America/Godthab";
						break;
					case "03":
						$timezone = "America/Godthab";
						break;
			}
			break;
			case "GM":
				$timezone = "Africa/Banjul";
				break;
			case "GN":
				$timezone = "Africa/Conakry";
				break;
			case "GP":
				$timezone = "America/Guadeloupe";
				break;
			case "GQ":
				$timezone = "Africa/Malabo";
				break;
			case "GR":
				$timezone = "Europe/Athens";
				break;
			case "GS":
				$timezone = "Atlantic/South_Georgia";
				break;
			case "GT":
				$timezone = "America/Guatemala";
				break;
			case "GU":
				$timezone = "Pacific/Guam";
				break;
			case "GW":
				$timezone = "Africa/Bissau";
				break;
			case "GY":
				$timezone = "America/Guyana";
				break;
			case "HK":
				$timezone = "Asia/Hong_Kong";
				break;
			case "HN":
				$timezone = "America/Tegucigalpa";
				break;
			case "HR":
				$timezone = "Europe/Zagreb";
				break;
			case "HT":
				$timezone = "America/Port-au-Prince";
				break;
			case "HU":
				$timezone = "Europe/Budapest";
				break;
			case "ID":
				switch ($region) {
					case "01":
						$timezone = "Asia/Pontianak";
						break;
					case "02":
						$timezone = "Asia/Makassar";
						break;
					case "03":
						$timezone = "Asia/Jakarta";
						break;
					case "04":
						$timezone = "Asia/Jakarta";
						break;
					case "05":
						$timezone = "Asia/Jakarta";
						break;
					case "06":
						$timezone = "Asia/Jakarta";
						break;
					case "07":
						$timezone = "Asia/Jakarta";
						break;
					case "08":
						$timezone = "Asia/Jakarta";
						break;
					case "09":
						$timezone = "Asia/Jayapura";
						break;
					case "10":
						$timezone = "Asia/Jakarta";
						break;
					case "11":
						$timezone = "Asia/Pontianak";
						break;
					case "12":
						$timezone = "Asia/Makassar";
						break;
					case "13":
						$timezone = "Asia/Makassar";
						break;
					case "14":
						$timezone = "Asia/Makassar";
						break;
					case "15":
						$timezone = "Asia/Jakarta";
						break;
					case "16":
						$timezone = "Asia/Makassar";
						break;
					case "17":
						$timezone = "Asia/Makassar";
						break;
					case "18":
						$timezone = "Asia/Makassar";
						break;
					case "19":
						$timezone = "Asia/Pontianak";
						break;
					case "20":
						$timezone = "Asia/Makassar";
						break;
					case "21":
						$timezone = "Asia/Makassar";
						break;
					case "22":
						$timezone = "Asia/Makassar";
						break;
					case "23":
						$timezone = "Asia/Makassar";
						break;
					case "24":
						$timezone = "Asia/Jakarta";
						break;
					case "25":
						$timezone = "Asia/Pontianak";
						break;
					case "26":
						$timezone = "Asia/Pontianak";
						break;
					case "28":
						$timezone = "Asia/Jayapura";
						break;
					case "29":
						$timezone = "Asia/Makassar";
						break;
					case "30":
						$timezone = "Asia/Jakarta";
						break;
					case "31":
						$timezone = "Asia/Makassar";
						break;
					case "32":
						$timezone = "Asia/Jakarta";
						break;
					case "33":
						$timezone = "Asia/Jakarta";
						break;
					case "34":
						$timezone = "Asia/Makassar";
						break;
					case "35":
						$timezone = "Asia/Pontianak";
						break;
					case "36":
						$timezone = "Asia/Jayapura";
						break;
					case "37":
						$timezone = "Asia/Pontianak";
						break;
					case "38":
						$timezone = "Asia/Makassar";
						break;
					case "39":
						$timezone = "Asia/Jayapura";
						break;
					case "40":
						$timezone = "Asia/Pontianak";
						break;
					case "41":
						$timezone = "Asia/Makassar";
						break;
			}
			break;
			case "IE":
				$timezone = "Europe/Dublin";
				break;
			case "IL":
				$timezone = "Asia/Jerusalem";
				break;
			case "IM":
				$timezone = "Europe/Isle_of_Man";
				break;
			case "IN":
				$timezone = "Asia/Kolkata";
				break;
			case "IO":
				$timezone = "Indian/Chagos";
				break;
			case "IQ":
				$timezone = "Asia/Baghdad";
				break;
			case "IR":
				$timezone = "Asia/Tehran";
				break;
			case "IS":
				$timezone = "Atlantic/Reykjavik";
				break;
			case "IT":
				$timezone = "Europe/Rome";
				break;
			case "JE":
				$timezone = "Europe/Jersey";
				break;
			case "JM":
				$timezone = "America/Jamaica";
				break;
			case "JO":
				$timezone = "Asia/Amman";
				break;
			case "JP":
				$timezone = "Asia/Tokyo";
				break;
			case "KE":
				$timezone = "Africa/Nairobi";
				break;
			case "KG":
				$timezone = "Asia/Bishkek";
				break;
			case "KH":
				$timezone = "Asia/Phnom_Penh";
				break;
			case "KI":
				$timezone = "Pacific/Tarawa";
				break;
			case "KM":
				$timezone = "Indian/Comoro";
				break;
			case "KN":
				$timezone = "America/St_Kitts";
				break;
			case "KP":
				$timezone = "Asia/Pyongyang";
				break;
			case "KR":
				$timezone = "Asia/Seoul";
				break;
			case "KW":
				$timezone = "Asia/Kuwait";
				break;
			case "KY":
				$timezone = "America/Cayman";
				break;
			case "KZ":
				switch ($region) {
					case "01":
						$timezone = "Asia/Almaty";
						break;
					case "02":
						$timezone = "Asia/Almaty";
						break;
					case "03":
						$timezone = "Asia/Qyzylorda";
						break;
					case "04":
						$timezone = "Asia/Aqtobe";
						break;
					case "05":
						$timezone = "Asia/Qyzylorda";
						break;
					case "06":
						$timezone = "Asia/Aqtau";
						break;
					case "07":
						$timezone = "Asia/Oral";
						break;
					case "08":
						$timezone = "Asia/Qyzylorda";
						break;
					case "09":
						$timezone = "Asia/Aqtau";
						break;
					case "10":
						$timezone = "Asia/Qyzylorda";
						break;
					case "11":
						$timezone = "Asia/Almaty";
						break;
					case "12":
						$timezone = "Asia/Qyzylorda";
						break;
					case "13":
						$timezone = "Asia/Aqtobe";
						break;
					case "14":
						$timezone = "Asia/Qyzylorda";
						break;
					case "15":
						$timezone = "Asia/Almaty";
						break;
					case "16":
						$timezone = "Asia/Aqtobe";
						break;
					case "17":
						$timezone = "Asia/Almaty";
						break;
			}
			break;
			case "LA":
				$timezone = "Asia/Vientiane";
				break;
			case "LB":
				$timezone = "Asia/Beirut";
				break;
			case "LC":
				$timezone = "America/St_Lucia";
				break;
			case "LI":
				$timezone = "Europe/Vaduz";
				break;
			case "LK":
				$timezone = "Asia/Colombo";
				break;
			case "LR":
				$timezone = "Africa/Monrovia";
				break;
			case "LS":
				$timezone = "Africa/Maseru";
				break;
			case "LT":
				$timezone = "Europe/Vilnius";
				break;
			case "LU":
				$timezone = "Europe/Luxembourg";
				break;
			case "LV":
				$timezone = "Europe/Riga";
				break;
			case "LY":
				$timezone = "Africa/Tripoli";
				break;
			case "MA":
				$timezone = "Africa/Casablanca";
				break;
			case "MC":
				$timezone = "Europe/Monaco";
				break;
			case "MD":
				$timezone = "Europe/Chisinau";
				break;
			case "ME":
				$timezone = "Europe/Podgorica";
				break;
			case "MF":
				$timezone = "America/Marigot";
				break;
			case "MG":
				$timezone = "Indian/Antananarivo";
				break;
			case "MH":
				$timezone = "Pacific/Kwajalein";
				break;
			case "MK":
				$timezone = "Europe/Skopje";
				break;
			case "ML":
				$timezone = "Africa/Bamako";
				break;
			case "MM":
				$timezone = "Asia/Rangoon";
				break;
			case "MN":
				switch ($region) {
					case "06":
						$timezone = "Asia/Choibalsan";
						break;
					case "11":
						$timezone = "Asia/Ulaanbaatar";
						break;
					case "17":
						$timezone = "Asia/Choibalsan";
						break;
					case "19":
						$timezone = "Asia/Hovd";
						break;
					case "20":
						$timezone = "Asia/Ulaanbaatar";
						break;
					case "21":
						$timezone = "Asia/Ulaanbaatar";
						break;
					case "25":
						$timezone = "Asia/Ulaanbaatar";
						break;
			}
			break;
			case "MO":
				$timezone = "Asia/Macau";
				break;
			case "MP":
				$timezone = "Pacific/Saipan";
				break;
			case "MQ":
				$timezone = "America/Martinique";
				break;
			case "MR":
				$timezone = "Africa/Nouakchott";
				break;
			case "MS":
				$timezone = "America/Montserrat";
				break;
			case "MT":
				$timezone = "Europe/Malta";
				break;
			case "MU":
				$timezone = "Indian/Mauritius";
				break;
			case "MV":
				$timezone = "Indian/Maldives";
				break;
			case "MW":
				$timezone = "Africa/Blantyre";
				break;
			case "MX":
				switch ($region) {
					case "01":
						$timezone = "America/Mexico_City";
						break;
					case "02":
						$timezone = "America/Tijuana";
						break;
					case "03":
						$timezone = "America/Hermosillo";
						break;
					case "04":
						$timezone = "America/Merida";
						break;
					case "05":
						$timezone = "America/Mexico_City";
						break;
					case "06":
						$timezone = "America/Chihuahua";
						break;
					case "07":
						$timezone = "America/Monterrey";
						break;
					case "08":
						$timezone = "America/Mexico_City";
						break;
					case "09":
						$timezone = "America/Mexico_City";
						break;
					case "10":
						$timezone = "America/Mazatlan";
						break;
					case "11":
						$timezone = "America/Mexico_City";
						break;
					case "12":
						$timezone = "America/Mexico_City";
						break;
					case "13":
						$timezone = "America/Mexico_City";
						break;
					case "14":
						$timezone = "America/Mazatlan";
						break;
					case "15":
						$timezone = "America/Chihuahua";
						break;
					case "16":
						$timezone = "America/Mexico_City";
						break;
					case "17":
						$timezone = "America/Mexico_City";
						break;
					case "18":
						$timezone = "America/Mazatlan";
						break;
					case "19":
						$timezone = "America/Monterrey";
						break;
					case "20":
						$timezone = "America/Mexico_City";
						break;
					case "21":
						$timezone = "America/Mexico_City";
						break;
					case "22":
						$timezone = "America/Mexico_City";
						break;
					case "23":
						$timezone = "America/Cancun";
						break;
					case "24":
						$timezone = "America/Mexico_City";
						break;
					case "25":
						$timezone = "America/Mazatlan";
						break;
					case "26":
						$timezone = "America/Hermosillo";
						break;
					case "27":
						$timezone = "America/Merida";
						break;
					case "28":
						$timezone = "America/Monterrey";
						break;
					case "29":
						$timezone = "America/Mexico_City";
						break;
					case "30":
						$timezone = "America/Mexico_City";
						break;
					case "31":
						$timezone = "America/Merida";
						break;
					case "32":
						$timezone = "America/Monterrey";
						break;
			}
			break;
			case "MY":
				switch ($region) {
					case "01":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "02":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "03":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "04":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "05":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "06":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "07":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "08":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "09":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "11":
						$timezone = "Asia/Kuching";
						break;
					case "12":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "13":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "14":
						$timezone = "Asia/Kuala_Lumpur";
						break;
					case "15":
						$timezone = "Asia/Kuching";
						break;
					case "16":
						$timezone = "Asia/Kuching";
						break;
			}
			break;
			case "MZ":
				$timezone = "Africa/Maputo";
				break;
			case "NA":
				$timezone = "Africa/Windhoek";
				break;
			case "NC":
				$timezone = "Pacific/Noumea";
				break;
			case "NE":
				$timezone = "Africa/Niamey";
				break;
			case "NF":
				$timezone = "Pacific/Norfolk";
				break;
			case "NG":
				$timezone = "Africa/Lagos";
				break;
			case "NI":
				$timezone = "America/Managua";
				break;
			case "NL":
				$timezone = "Europe/Amsterdam";
				break;
			case "NO":
				$timezone = "Europe/Oslo";
				break;
			case "NP":
				$timezone = "Asia/Kathmandu";
				break;
			case "NR":
				$timezone = "Pacific/Nauru";
				break;
			case "NU":
				$timezone = "Pacific/Niue";
				break;
			case "NZ":
				switch ($region) {
					case "85":
						$timezone = "Pacific/Auckland";
						break;
					case "E7":
						$timezone = "Pacific/Auckland";
						break;
					case "E8":
						$timezone = "Pacific/Auckland";
						break;
					case "E9":
						$timezone = "Pacific/Auckland";
						break;
					case "F1":
						$timezone = "Pacific/Auckland";
						break;
					case "F2":
						$timezone = "Pacific/Auckland";
						break;
					case "F3":
						$timezone = "Pacific/Auckland";
						break;
					case "F4":
						$timezone = "Pacific/Auckland";
						break;
					case "F5":
						$timezone = "Pacific/Auckland";
						break;
					case "F6":
						$timezone = "Pacific/Auckland";
						break;
					case "F7":
						$timezone = "Pacific/Chatham";
						break;
					case "F8":
						$timezone = "Pacific/Auckland";
						break;
					case "F9":
						$timezone = "Pacific/Auckland";
						break;
					case "G1":
						$timezone = "Pacific/Auckland";
						break;
					case "G2":
						$timezone = "Pacific/Auckland";
						break;
					case "G3":
						$timezone = "Pacific/Auckland";
						break;
			}
			break;
			case "OM":
				$timezone = "Asia/Muscat";
				break;
			case "PA":
				$timezone = "America/Panama";
				break;
			case "PE":
				$timezone = "America/Lima";
				break;
			case "PF":
				$timezone = "Pacific/Marquesas";
				break;
			case "PG":
				$timezone = "Pacific/Port_Moresby";
				break;
			case "PH":
				$timezone = "Asia/Manila";
				break;
			case "PK":
				$timezone = "Asia/Karachi";
				break;
			case "PL":
				$timezone = "Europe/Warsaw";
				break;
			case "PM":
				$timezone = "America/Miquelon";
				break;
			case "PN":
				$timezone = "Pacific/Pitcairn";
				break;
			case "PR":
				$timezone = "America/Puerto_Rico";
				break;
			case "PS":
				$timezone = "Asia/Gaza";
				break;
			case "PT":
				switch ($region) {
					case "02":
						$timezone = "Europe/Lisbon";
						break;
					case "03":
						$timezone = "Europe/Lisbon";
						break;
					case "04":
						$timezone = "Europe/Lisbon";
						break;
					case "05":
						$timezone = "Europe/Lisbon";
						break;
					case "06":
						$timezone = "Europe/Lisbon";
						break;
					case "07":
						$timezone = "Europe/Lisbon";
						break;
					case "08":
						$timezone = "Europe/Lisbon";
						break;
					case "09":
						$timezone = "Europe/Lisbon";
						break;
					case "10":
						$timezone = "Atlantic/Madeira";
						break;
					case "11":
						$timezone = "Europe/Lisbon";
						break;
					case "13":
						$timezone = "Europe/Lisbon";
						break;
					case "14":
						$timezone = "Europe/Lisbon";
						break;
					case "16":
						$timezone = "Europe/Lisbon";
						break;
					case "17":
						$timezone = "Europe/Lisbon";
						break;
					case "18":
						$timezone = "Europe/Lisbon";
						break;
					case "19":
						$timezone = "Europe/Lisbon";
						break;
					case "20":
						$timezone = "Europe/Lisbon";
						break;
					case "21":
						$timezone = "Europe/Lisbon";
						break;
					case "22":
						$timezone = "Europe/Lisbon";
						break;
					case "23":
						$timezone = "Atlantic/Azores";
						break;
			}
			break;
			case "PW":
				$timezone = "Pacific/Palau";
				break;
			case "PY":
				$timezone = "America/Asuncion";
				break;
			case "QA":
				$timezone = "Asia/Qatar";
				break;
			case "RE":
				$timezone = "Indian/Reunion";
				break;
			case "RO":
				$timezone = "Europe/Bucharest";
				break;
			case "RS":
				$timezone = "Europe/Belgrade";
				break;
			case "RU":
				switch ($region) {
					case "01":
						$timezone = "Europe/Volgograd";
						break;
					case "02":
						$timezone = "Asia/Irkutsk";
						break;
					case "03":
						$timezone = "Asia/Novokuznetsk";
						break;
					case "04":
						$timezone = "Asia/Novosibirsk";
						break;
					case "05":
						$timezone = "Asia/Vladivostok";
						break;
					case "06":
						$timezone = "Europe/Moscow";
						break;
					case "07":
						$timezone = "Europe/Volgograd";
						break;
					case "08":
						$timezone = "Europe/Samara";
						break;
					case "09":
						$timezone = "Europe/Moscow";
						break;
					case "10":
						$timezone = "Europe/Moscow";
						break;
					case "11":
						$timezone = "Asia/Irkutsk";
						break;
					case "12":
						$timezone = "Europe/Volgograd";
						break;
					case "13":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "14":
						$timezone = "Asia/Irkutsk";
						break;
					case "15":
						$timezone = "Asia/Anadyr";
						break;
					case "16":
						$timezone = "Europe/Samara";
						break;
					case "17":
						$timezone = "Europe/Volgograd";
						break;
					case "18":
						$timezone = "Asia/Krasnoyarsk";
						break;
					case "20":
						$timezone = "Asia/Irkutsk";
						break;
					case "21":
						$timezone = "Europe/Moscow";
						break;
					case "22":
						$timezone = "Europe/Volgograd";
						break;
					case "23":
						$timezone = "Europe/Kaliningrad";
						break;
					case "24":
						$timezone = "Europe/Volgograd";
						break;
					case "25":
						$timezone = "Europe/Moscow";
						break;
					case "26":
						$timezone = "Asia/Kamchatka";
						break;
					case "27":
						$timezone = "Europe/Volgograd";
						break;
					case "28":
						$timezone = "Europe/Moscow";
						break;
					case "29":
						$timezone = "Asia/Novokuznetsk";
						break;
					case "30":
						$timezone = "Asia/Vladivostok";
						break;
					case "31":
						$timezone = "Asia/Krasnoyarsk";
						break;
					case "32":
						$timezone = "Asia/Omsk";
						break;
					case "33":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "34":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "35":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "36":
						$timezone = "Asia/Anadyr";
						break;
					case "37":
						$timezone = "Europe/Moscow";
						break;
					case "38":
						$timezone = "Europe/Volgograd";
						break;
					case "39":
						$timezone = "Asia/Krasnoyarsk";
						break;
					case "40":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "41":
						$timezone = "Europe/Moscow";
						break;
					case "42":
						$timezone = "Europe/Moscow";
						break;
					case "43":
						$timezone = "Europe/Moscow";
						break;
					case "44":
						$timezone = "Asia/Magadan";
						break;
					case "45":
						$timezone = "Europe/Samara";
						break;
					case "46":
						$timezone = "Europe/Samara";
						break;
					case "47":
						$timezone = "Europe/Moscow";
						break;
					case "48":
						$timezone = "Europe/Moscow";
						break;
					case "49":
						$timezone = "Europe/Moscow";
						break;
					case "50":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "51":
						$timezone = "Europe/Moscow";
						break;
					case "52":
						$timezone = "Europe/Moscow";
						break;
					case "53":
						$timezone = "Asia/Novosibirsk";
						break;
					case "54":
						$timezone = "Asia/Omsk";
						break;
					case "55":
						$timezone = "Europe/Samara";
						break;
					case "56":
						$timezone = "Europe/Moscow";
						break;
					case "57":
						$timezone = "Europe/Samara";
						break;
					case "58":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "59":
						$timezone = "Asia/Vladivostok";
						break;
					case "60":
						$timezone = "Europe/Kaliningrad";
						break;
					case "61":
						$timezone = "Europe/Volgograd";
						break;
					case "62":
						$timezone = "Europe/Moscow";
						break;
					case "63":
						$timezone = "Asia/Yakutsk";
						break;
					case "64":
						$timezone = "Asia/Sakhalin";
						break;
					case "65":
						$timezone = "Europe/Samara";
						break;
					case "66":
						$timezone = "Europe/Moscow";
						break;
					case "67":
						$timezone = "Europe/Samara";
						break;
					case "68":
						$timezone = "Europe/Volgograd";
						break;
					case "69":
						$timezone = "Europe/Moscow";
						break;
					case "70":
						$timezone = "Europe/Volgograd";
						break;
					case "71":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "72":
						$timezone = "Europe/Moscow";
						break;
					case "73":
						$timezone = "Europe/Samara";
						break;
					case "74":
						$timezone = "Asia/Krasnoyarsk";
						break;
					case "75":
						$timezone = "Asia/Novosibirsk";
						break;
					case "76":
						$timezone = "Europe/Moscow";
						break;
					case "77":
						$timezone = "Europe/Moscow";
						break;
					case "78":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "79":
						$timezone = "Asia/Irkutsk";
						break;
					case "80":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "81":
						$timezone = "Europe/Samara";
						break;
					case "82":
						$timezone = "Asia/Irkutsk";
						break;
					case "83":
						$timezone = "Europe/Moscow";
						break;
					case "84":
						$timezone = "Europe/Volgograd";
						break;
					case "85":
						$timezone = "Europe/Moscow";
						break;
					case "86":
						$timezone = "Europe/Moscow";
						break;
					case "87":
						$timezone = "Asia/Novosibirsk";
						break;
					case "88":
						$timezone = "Europe/Moscow";
						break;
					case "89":
						$timezone = "Asia/Vladivostok";
						break;
					case "90":
						$timezone = "Asia/Yekaterinburg";
						break;
					case "91":
						$timezone = "Asia/Krasnoyarsk";
						break;
					case "92":
						$timezone = "Asia/Anadyr";
						break;
					case "93":
						$timezone = "Asia/Irkutsk";
						break;
			}
			break;
			case "RW":
				$timezone = "Africa/Kigali";
				break;
			case "SA":
				$timezone = "Asia/Riyadh";
				break;
			case "SB":
				$timezone = "Pacific/Guadalcanal";
				break;
			case "SC":
				$timezone = "Indian/Mahe";
				break;
			case "SD":
				$timezone = "Africa/Khartoum";
				break;
			case "SE":
				$timezone = "Europe/Stockholm";
				break;
			case "SG":
				$timezone = "Asia/Singapore";
				break;
			case "SH":
				$timezone = "Atlantic/St_Helena";
				break;
			case "SI":
				$timezone = "Europe/Ljubljana";
				break;
			case "SJ":
				$timezone = "Arctic/Longyearbyen";
				break;
			case "SK":
				$timezone = "Europe/Bratislava";
				break;
			case "SL":
				$timezone = "Africa/Freetown";
				break;
			case "SM":
				$timezone = "Europe/San_Marino";
				break;
			case "SN":
				$timezone = "Africa/Dakar";
				break;
			case "SO":
				$timezone = "Africa/Mogadishu";
				break;
			case "SR":
				$timezone = "America/Paramaribo";
				break;
			case "SS":
				$timezone = "Africa/Juba";
				break;
			case "ST":
				$timezone = "Africa/Sao_Tome";
				break;
			case "SV":
				$timezone = "America/El_Salvador";
				break;
			case "SX":
				$timezone = "America/Curacao";
				break;
			case "SY":
				$timezone = "Asia/Damascus";
				break;
			case "SZ":
				$timezone = "Africa/Mbabane";
				break;
			case "TC":
				$timezone = "America/Grand_Turk";
				break;
			case "TD":
				$timezone = "Africa/Ndjamena";
				break;
			case "TF":
				$timezone = "Indian/Kerguelen";
				break;
			case "TG":
				$timezone = "Africa/Lome";
				break;
			case "TH":
				$timezone = "Asia/Bangkok";
				break;
			case "TJ":
				$timezone = "Asia/Dushanbe";
				break;
			case "TK":
				$timezone = "Pacific/Fakaofo";
				break;
			case "TL":
				$timezone = "Asia/Dili";
				break;
			case "TM":
				$timezone = "Asia/Ashgabat";
				break;
			case "TN":
				$timezone = "Africa/Tunis";
				break;
			case "TO":
				$timezone = "Pacific/Tongatapu";
				break;
			case "TR":
				$timezone = "Asia/Istanbul";
				break;
			case "TT":
				$timezone = "America/Port_of_Spain";
				break;
			case "TV":
				$timezone = "Pacific/Funafuti";
				break;
			case "TW":
				$timezone = "Asia/Taipei";
				break;
			case "TZ":
				$timezone = "Africa/Dar_es_Salaam";
				break;
			case "UA":
				switch ($region) {
					case "01":
						$timezone = "Europe/Kiev";
						break;
					case "02":
						$timezone = "Europe/Kiev";
						break;
					case "03":
						$timezone = "Europe/Uzhgorod";
						break;
					case "04":
						$timezone = "Europe/Zaporozhye";
						break;
					case "05":
						$timezone = "Europe/Zaporozhye";
						break;
					case "06":
						$timezone = "Europe/Uzhgorod";
						break;
					case "07":
						$timezone = "Europe/Zaporozhye";
						break;
					case "08":
						$timezone = "Europe/Simferopol";
						break;
					case "09":
						$timezone = "Europe/Kiev";
						break;
					case "10":
						$timezone = "Europe/Zaporozhye";
						break;
					case "11":
						$timezone = "Europe/Simferopol";
						break;
					case "12":
						$timezone = "Europe/Kiev";
						break;
					case "13":
						$timezone = "Europe/Kiev";
						break;
					case "14":
						$timezone = "Europe/Zaporozhye";
						break;
					case "15":
						$timezone = "Europe/Uzhgorod";
						break;
					case "16":
						$timezone = "Europe/Zaporozhye";
						break;
					case "17":
						$timezone = "Europe/Simferopol";
						break;
					case "18":
						$timezone = "Europe/Zaporozhye";
						break;
					case "19":
						$timezone = "Europe/Kiev";
						break;
					case "20":
						$timezone = "Europe/Simferopol";
						break;
					case "21":
						$timezone = "Europe/Kiev";
						break;
					case "22":
						$timezone = "Europe/Uzhgorod";
						break;
					case "23":
						$timezone = "Europe/Kiev";
						break;
					case "24":
						$timezone = "Europe/Uzhgorod";
						break;
					case "25":
						$timezone = "Europe/Uzhgorod";
						break;
					case "26":
						$timezone = "Europe/Zaporozhye";
						break;
					case "27":
						$timezone = "Europe/Kiev";
						break;
			}
			break;
			case "UG":
				$timezone = "Africa/Kampala";
				break;
			case "UM":
				$timezone = "Pacific/Wake";
				break;
			case "US":
				switch ($region) {
					case "AK":
						$timezone = "America/Anchorage";
						break;
					case "AL":
						$timezone = "America/Chicago";
						break;
					case "AR":
						$timezone = "America/Chicago";
						break;
					case "AZ":
						$timezone = "America/Phoenix";
						break;
					case "CA":
						$timezone = "America/Los_Angeles";
						break;
					case "CO":
						$timezone = "America/Denver";
						break;
					case "CT":
						$timezone = "America/New_York";
						break;
					case "DC":
						$timezone = "America/New_York";
						break;
					case "DE":
						$timezone = "America/New_York";
						break;
					case "FL":
						$timezone = "America/New_York";
						break;
					case "GA":
						$timezone = "America/New_York";
						break;
					case "HI":
						$timezone = "Pacific/Honolulu";
						break;
					case "IA":
						$timezone = "America/Chicago";
						break;
					case "ID":
						$timezone = "America/Denver";
						break;
					case "IL":
						$timezone = "America/Chicago";
						break;
					case "IN":
						$timezone = "America/Indiana/Indianapolis";
						break;
					case "KS":
						$timezone = "America/Chicago";
						break;
					case "KY":
						$timezone = "America/New_York";
						break;
					case "LA":
						$timezone = "America/Chicago";
						break;
					case "MA":
						$timezone = "America/New_York";
						break;
					case "MD":
						$timezone = "America/New_York";
						break;
					case "ME":
						$timezone = "America/New_York";
						break;
					case "MI":
						$timezone = "America/New_York";
						break;
					case "MN":
						$timezone = "America/Chicago";
						break;
					case "MO":
						$timezone = "America/Chicago";
						break;
					case "MS":
						$timezone = "America/Chicago";
						break;
					case "MT":
						$timezone = "America/Denver";
						break;
					case "NC":
						$timezone = "America/New_York";
						break;
					case "ND":
						$timezone = "America/Chicago";
						break;
					case "NE":
						$timezone = "America/Chicago";
						break;
					case "NH":
						$timezone = "America/New_York";
						break;
					case "NJ":
						$timezone = "America/New_York";
						break;
					case "NM":
						$timezone = "America/Denver";
						break;
					case "NV":
						$timezone = "America/Los_Angeles";
						break;
					case "NY":
						$timezone = "America/New_York";
						break;
					case "OH":
						$timezone = "America/New_York";
						break;
					case "OK":
						$timezone = "America/Chicago";
						break;
					case "OR":
						$timezone = "America/Los_Angeles";
						break;
					case "PA":
						$timezone = "America/New_York";
						break;
					case "RI":
						$timezone = "America/New_York";
						break;
					case "SC":
						$timezone = "America/New_York";
						break;
					case "SD":
						$timezone = "America/Chicago";
						break;
					case "TN":
						$timezone = "America/Chicago";
						break;
					case "TX":
						$timezone = "America/Chicago";
						break;
					case "UT":
						$timezone = "America/Denver";
						break;
					case "VA":
						$timezone = "America/New_York";
						break;
					case "VT":
						$timezone = "America/New_York";
						break;
					case "WA":
						$timezone = "America/Los_Angeles";
						break;
					case "WI":
						$timezone = "America/Chicago";
						break;
					case "WV":
						$timezone = "America/New_York";
						break;
					case "WY":
						$timezone = "America/Denver";
						break;
			}
			break;
			case "UY":
				$timezone = "America/Montevideo";
				break;
			case "UZ":
				switch ($region) {
					case "01":
						$timezone = "Asia/Tashkent";
						break;
					case "02":
						$timezone = "Asia/Samarkand";
						break;
					case "03":
						$timezone = "Asia/Tashkent";
						break;
					case "05":
						$timezone = "Asia/Samarkand";
						break;
					case "06":
						$timezone = "Asia/Tashkent";
						break;
					case "07":
						$timezone = "Asia/Samarkand";
						break;
					case "08":
						$timezone = "Asia/Samarkand";
						break;
					case "09":
						$timezone = "Asia/Samarkand";
						break;
					case "10":
						$timezone = "Asia/Samarkand";
						break;
					case "12":
						$timezone = "Asia/Samarkand";
						break;
					case "13":
						$timezone = "Asia/Tashkent";
						break;
					case "14":
						$timezone = "Asia/Tashkent";
						break;
			}
			break;
			case "VA":
				$timezone = "Europe/Vatican";
				break;
			case "VC":
				$timezone = "America/St_Vincent";
				break;
			case "VE":
				$timezone = "America/Caracas";
				break;
			case "VG":
				$timezone = "America/Tortola";
				break;
			case "VI":
				$timezone = "America/St_Thomas";
				break;
			case "VN":
				$timezone = "Asia/Phnom_Penh";
				break;
			case "VU":
				$timezone = "Pacific/Efate";
				break;
			case "WF":
				$timezone = "Pacific/Wallis";
				break;
			case "WS":
				$timezone = "Pacific/Pago_Pago";
				break;
			case "YE":
				$timezone = "Asia/Aden";
				break;
			case "YT":
				$timezone = "Indian/Mayotte";
				break;
			case "YU":
				$timezone = "Europe/Belgrade";
				break;
			case "ZA":
				$timezone = "Africa/Johannesburg";
				break;
			case "ZM":
				$timezone = "Africa/Lusaka";
				break;
			case "ZW":
				$timezone = "Africa/Harare";
				break;
		}
		return $timezone;
	  }
}
?>