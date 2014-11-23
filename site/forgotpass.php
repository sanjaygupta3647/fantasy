<?php 
$erro = 0;
$user = $cms->getSingleresult("SELECT userName FROM #_user WHERE emailId='".$_GET[email]."' "); 
if(!$user){
	$erro = 1;
	echo '<p class="err_ms" style="color:red;">Invalid Email Id</p>';
}
if(!$erro){
	$pass = base64_decode($cms->getSingleresult("SELECT password FROM #_user WHERE emailId='".$_GET[email]."' "));
	$to = trim($_GET[email]) ; 
	$subject = "Forgot Password Request from ".$_SERVER[HTTP_HOST];
	$mail_body = '<html>
	<body>
	<table width="100%" align="center" style="background-color:#eee">
	<tr><td colspan="2" align="left">Your login details are given bellow:</td></tr> 
	<tr><td width="10%"  align="left">User Name:</td><td align="left">' .$user. '</td></tr> 
	<tr><td width="10%"  align="left">Password:</td><td align="left">' .$pass. '</td></tr> 
	 
	<tr><td colspan="2" align="left">Thanks and Regards,<br>Admin @'.$_SERVER[HTTP_HOST].'</td></tr>
	</table> 
	</body>
	</html>'; 
	$senderEmail = SITE_MAIL;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'From: '.$senderEmail. "\r\n" .'CC: '.$senderEmail; 
	@mail($to, $subject, $mail_body, $headers);  
	echo'<p class="success_ms" style="color:green;">Your password has been sent to your email id, also check your spam folder</p>';
}

