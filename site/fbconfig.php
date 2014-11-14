<?php
require 'src/facebook.php';  // Include facebook SDK file
//$fbconfig['serverurl'] = "http://secondsells.com/";
$facebook = new Facebook(array(
  'appId'  => '981931675155237',   // Facebook App ID 
  'secret' => 'b8e80e9243b372fcfbebf75fa1f020cd',  // Facebook App Secret
  'cookie' => true,	
));
$user = $facebook->getUser();
if ($user) {
	try {
	$user_profile = $facebook->api('/me');
	$fbid = $user_profile['id'];                 // To Get Facebook ID
	$fbuname = $user_profile['username'];  // To Get Facebook Username
	$fbfullname = $user_profile['name']; // To Get Facebook full name
	$femail = $user_profile['email'];  
	$country = 	$user_profile['country']; 
	$state = 	$user_profile['state']; 
	$city = 	$user_profile['city']; 
	$zip = 	$user_profile['zip']; 
	// To Get Facebook email ID
	/* ---- Session Variables -----*/
	$_SESSION['fbid'] = $fbid;           
	$_SESSION['userName'] = $fbuname;
	$_SESSION['fullName'] = $fbfullname;
	$_SESSION['emailId'] =  $femail;
	$check = $cms->getSingleresult("select count(*) from #_registration WHERE emailId = '".$femail."' AND status = 'Active' ");
	if(!$check){
		$rsCheck = $cms->db_query("INSERT INTO #_user SET userName = '".$fbuname."', emailId = '".$femail."', status = 'Active' ");
		$lastId = mysql_insert_id(); 
	}
	} catch (FacebookApiException $e) {
	error_log($e);
	$user = null;
	}
}
if ($user) {
	header("Location:".SITE_PATH);
} else {
 $loginUrl = $facebook->getLoginUrl(array(
		'scope'		=> 'email', // Permissions to request from the user
		));
 header("Location: ".$loginUrl);
}
?>
