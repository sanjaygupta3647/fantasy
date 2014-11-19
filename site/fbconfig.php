<?php
//die("mnd,dns,");
require 'src/facebook.php';  // Include facebook SDK file
$fbconfig['serverurl'] = "http://www.games-gifts.tk/fbconfig";
$facebook = new Facebook(array(
  'appId'  => '981931675155237',   // Facebook App ID 
  'secret' => 'b8e80e9243b372fcfbebf75fa1f020cd',  // Facebook App Secret
  'cookie' => true,	
));
$user = $facebook->getUser();
if ($user) {
	try {
		$user_profile = $facebook->api('/me');
		//print_r($user_profile);
		$fbid = $user_profile['id'];                 // To Get Facebook ID
		$fname = $user_profile['first_name'];  // To Get Facebook Username
		$fbfullname = $user_profile['name']; // To Get Facebook full name
		$femail = $user_profile['email'];  
		$country = 	$user_profile['country']; 
		$state = 	$user_profile['state']; 
		$city = 	$user_profile['city']; 
		$zip = 	$user_profile['zip']; 
		// To Get Facebook email ID
		/* ---- Session Variables -----*/
		$_SESSION['FBID'] = $fbid;           
		$_SESSION['USERNAME'] = $fbuname;
		$_SESSION['FULLNAME'] = $fbfullname;
		$_SESSION['email'] =  $femail;
	} catch (FacebookApiException $e) {
	error_log($e);
	$user = null;
	}
}
//die;
if ($user) {
	header("Location:".SITE_PATH."dashboard");
} else {
 $loginUrl = $facebook->getLoginUrl(array(
		'scope'		=> 'email', // Permissions to request from the user
		));
 header("Location: ".$loginUrl);
}
?>
