 
<?
   // putenv("TZ=Asia/Calcutta");		
 	if(count($items) > 1)
	{
		$page = 'site/' . $items[1].".php";
	}else{
		die;
	} 

	if($items[1]!="" && file_exists($page)){
		$loadpage=$page;
	}else{		
		echo 'Apologies... page not found';
		die;
	}
	  
	  include_once $loadpage;
?>
