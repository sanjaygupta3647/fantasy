<?php
class DAL_CUR {  
	
	private $var;
	public function cartfill($rs) {
		$cms = new DAL();	
		$numns = mysql_num_rows($cms->db_query("select * from #_cart where ssid='".$rs."'"));
		if($numns){
			return  $numns.(($numns==1)?' Item':' Items')." in your Cart";
		} else{
			return 'Your Shopping Cart is empty';
		}
	}
	
}

?>