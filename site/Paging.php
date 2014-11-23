<?php
	class Paging {
		var $sql;
		var $rs;
		var $numrows;
		var $limit;
		var $noofpage;
		var $offset;
		var $page;
		var $style;
		var $parameter;
		var $activestyle;
		var $buttonstyle;
		function curPage() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 if($_GET['page']){
			$vals = "?page=$_GET[page]";
			$vals2 = "&page=$_GET[page]";
		 }
		 $pageURL = str_replace($vals, '', $pageURL);
		 $pageURL = str_replace($vals2, '', $pageURL);
			$arr = explode('?',$pageURL);
			if($arr[1]!=""){
				$arr2 = explode('&',$arr[1]); 
				$i = 1;
				foreach($arr2 as $val){
					if($i==1){
						$ur .= "?".$val;
					}else{
						$ur .= "&".$val;
					}
					$i++;
				}
				$returl = $arr[0].$ur;
			}else{
				$returl = $pageURL."/?";
			}
			$returl = str_replace("/?/?",'/?',$returl);
		 return $returl;
		}
		function Paging($query) {
			$this->offset=0;
			$this->page=1;
			$this->sql=$query;
			$this->rs=mysql_query($this->sql);
			$this->numrows= mysql_num_rows($this->rs);
			$this->data=mysql_fetch_array($this->rs);
			
		}
		function getNumRows() {
			return $this->numrows;
		}
		//set limit for the data display per page
		function setLimit($no) {
			$this->limit=$no;
		}
		//Limit for page display on link
		function PageLimit($pgno) {
			$this->Pglimit=$pgno;
		}
		//limit display of record per page
		function getLimit() {
			return $this->limit;
		}
		// function for get Number of pages OR Last Page
		function getNoOfPages() {
			return ceil($this->noofpage=($this->getNumRows()/$this->getLimit()));
		}
			
		function getPageNo() {
	
			$startRec = ($this->getPage()-1)*$this->getLimit();
			$lastRec = $startRec + $this->getLimit();
			$startRec = $startRec + 1;
			if($lastRec > $this->getNumRows())
				$lastRec = $this->getNumRows();
			if($startRec==$this->getNumRows())
				$lastRec=$this->getNumRows();
				
			$str="";
			$str.="<table style='float:left;border-bottom:none!important' width='100%' border='0'>";
			$str.="<tr>";
			/*$str.="<form name='frmPage' action='".$this->curPage()."' method='get' >";
			$str.="<td align='left' class='".$this->getStyle()."'>";
			$str.="Go To Page&nbsp;<input type='text' name='page' size='2' class='".$this->getStyle()."'>&nbsp;";
			$param=explode("[&=]",$this->getParameter());
			for($i=2;$i<=count($param);$i=$i+2) {
				$str.="<input type='hidden' name='".$param[$i-1]."' value='".$param[$i]."'>";
			}
			//$str.="<input type='submit' name='btnGo' value='Go!' class='".$this->getButtonStyle()."'>";
			$str.="<input type='image' src='http://fizzkart.com/image/icon_go.gif'>";
			$str.="</td>";
			$str.="</form>";*/
			$str.="<td align='center'>";
			if($this->getPage()>1){
				$str.="<a href='".$this->curPage()."&page=1".$this->getParameter()."' class='".$this->getStyle()."'>
				<img src='http://fizzkart.com/image/arrow_first.gif' style='border:none' title='First'></a>";
				$str.="<a href='".$this->curPage()."&page=".($this->getPage()-1).$this->getParameter()."' class='".$this->getStyle()."' title='Back'>
				<img src='http://fizzkart.com/image/arrow_left.gif' style='border:none'></a>";
			}
			
			$range_min = ($this->Pglimit % 2 == 0) ? ($this->Pglimit / 2) - 1 : ($this->Pglimit - 1) / 2;
			$range_max = ($this->Pglimit % 2 == 0) ? $this->Pglimit : $this->Pglimit;
			$page_min = $page_num- $range_min;
			$page_max = $page_num+ $range_max;
			
			if ($page_max > $this->getNoOfPages()) {
			
				 $page_min = ($page_min > 1) ? $this->getNoOfPages() - $this->Pglimit + 1 : 1;
				 $page_max = $this->getNoOfPages();
			}
			$page_min = ($page_min < 1) ? 1 : $page_min;
			
			if ($this->getNoOfPages() < 9)
			{	
				for ($counter = 1; $counter <= $this->getNoOfPages(); $counter++)
				{
					if ($counter == $this->getPage())
						$str.="<span class='".$this->getActiveStyle()."'>".$counter."&nbsp</span>";
					else
						$str.="<a href='".$this->curPage()."&page=".$counter.$this->getParameter()."' class='".$this->getStyle()."'>".$counter."&nbsp</a>&nbsp;";
				}
			}
			elseif($this->getNoOfPages() >= 9)
			{
				$lpm1 = $this->getNoOfPages() - 1;		
				
				if($this->getPage() < 4)		
				{ 
					for ($counter = 1; $counter < 6; $counter++)
					{
						if ($counter == $this->getPage())
							$str.="<span class='".$this->getActiveStyle()."'>".$counter."&nbsp</span>";
						else
							$str.="<a href='".$this->curPage()."&page=".$counter.$this->getParameter()."' class='".$this->getStyle()."'/>".$counter."&nbsp</a>";					
					}
					$str.="...&nbsp";
					$str.="<a href='".$this->curPage()."&page=".$lpm1.$this->getParameter()."' class='".$this->getStyle()."'>".$lpm1."&nbsp</a>";
					$str.="<a href='".$this->curPage()."&page=".$this->getNoOfPages().$this->getParameter()."'class='".$this->getStyle()."'>".$this->getNoOfPages()."&nbsp</a>";		
				}
				elseif($this->getNoOfPages() - 3 > $this->getPage() && $this->getPage() > 1)
				{
					$str.="<a href='".$this->curPage()."&page=1".$this->getParameter()."' class='".$this->getStyle()."'>1&nbsp</a>";
					$str.="<a href='".$this->curPage()."&page=2".$this->getParameter()."' class='".$this->getStyle()."'>2&nbsp</a>";
					if($this->getPage()!=4 && $this->getPage()!=5)
					{
						$str.="...&nbsp";
					}
					for ($counter = $this->getPage() - 1; $counter <= $this->getPage() + 1; $counter++)
					{
						if ($counter == $this->getPage())
							$str.="<span class='".$this->getActiveStyle()."'>".$counter."&nbsp</span>";
						else
							$str.="<a href='".$this->curPage()."&page=".$counter.$this->getParameter()."' class='".$this->getStyle()."'>".$counter."&nbsp</a>";					
					}
					
					$str.="...&nbsp";
					$str.="<a href='".$this->curPage()."&page=".$lpm1.$this->getParameter()."' class='".$this->getStyle()."'>".$lpm1."&nbsp</a>";
					$str.="<a href='".$this->curPage()."&page=".$this->getNoOfPages().$this->getParameter()."' class='".$this->getStyle()."'>".$this->getNoOfPages()."&nbsp</a>";		
				}
				else
				{
					$str.="<a href='".$this->curPage()."&page=1".$this->getParameter()."' class='".$this->getStyle()."'>1&nbsp</a>";
					$str.="<a href='".$this->curPage()."&page=2".$this->getParameter()."' class='".$this->getStyle()."'>2&nbsp</a>";
					if($this->getPage()!=4 && $this->getPage()!=5)
					{
						$str.="...&nbsp";
					}
					for ($counter = $this->getNoOfPages() - 4; $counter <= $this->getNoOfPages(); $counter++)
					{
						if ($counter == $this->getPage())
							$str.="<span class='".$this->getActiveStyle()."'>".$counter."&nbsp</span>";
						else
							$str.="<a href='".$this->curPage()."&page=".$counter.$this->getParameter()."' class='".$this->getStyle()."'>".$counter."&nbsp</a>";					
					}
				}/**/
			}
		
			if($this->getPage()<$this->getNoOfPages()) {
				$str.="<a href='".$this->curPage()."&page=".($this->getPage()+1).$this->getParameter()."' class='".$this->getStyle()."' title='Next'><img src='http://fizzkart.com/image/arrow_right.gif' style='border:none'></a>";
				$str.="<a href='".$this->curPage()."&page=".$this->getNoOfPages().$this->getParameter()."' class='".$this->getStyle()."' title='Last'><img src='http://fizzkart.com/image/arrow_last.gif' style='border:none'></a>";
			}
			$str.="</td>";
			$str.="<td align='right'>";
			$str.="<font class='".$this->getStyle()."'>Displaying&nbsp;".$startRec." - ".$lastRec."&nbsp;of&nbsp;".$this->getNumRows()."</font>";
			$str.="</td>";
			$str.="</tr></table>";
			print $str;
		}
		
		function getOffset($page) {
			if($page > $this->getNoOfPages()) {
				$page=$this->getNoOfPages();
			}
			if($page=="") {
				$this->page=1;
				$page=1;
			}
			else {
				$this->page=$page;
			}
			if($page=="1") {
				$this->offset=0;
				return $this->offset;
			}
			else {
				for($i=2;$i<=$page;$i++) {
					$this->offset=$this->offset+$this->getLimit();
				}
				return $this->offset;
			}
		}
		function getPage() {
			return $this->page;
		}
		function setStyle($style) {
			$this->style=$style;
		}
		function getStyle() {
			return $this->style;
		}
		function setActiveStyle($style) {
			$this->activestyle=$style;
		}
		function getActiveStyle() {
			return $this->activestyle;
		}
		function setButtonStyle($style) {
			$this->buttonstyle=$style;
		}
		function getButtonStyle() {
			return $this->buttonstyle;
		}
		function setParameter($parameter) {
			$this->parameter=$parameter;
		}
		function getParameter() {
			return $this->parameter;
		}
	}
?>