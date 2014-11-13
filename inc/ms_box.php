<? 
	if(count($items) > 1)
	{
		$page = $items[2].".php";
	}
	else
	{
		if($items[0] != 'en' AND $items[0] != 'de')
		{
			header("Location:" . $_SESSION['site_root'] . $items[0]); die;
		}
		header("Location:" . $_SESSION['site_root'] ."home"); die;
	}

	$_SESSION['lang'] = ($items[0] == 'de') ? 'de' : 'en' ;
  	$lang=$_SESSION['lang'];
  
	if($items[2]!="" && file_exists($page)){
		$loadpage=$page;
	}else{		
		echo 'Apologies... page not found';
		die;
	}

