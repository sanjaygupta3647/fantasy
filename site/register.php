<?php  
if($cms->is_post_back()){
	$insert= mysql_num_rows($rsAdmin=$cms->db_query("SELECT * FROM #_user WHERE  emailId='".$emailId."' "));
	$_POST[password] = base64_encode($password);
	if(!mysql_num_rows($rsAdmin=$cms->db_query("SELECT * FROM #_user WHERE  userName ='".$userName."' "))){
		if(!$insert){  
			$activation	= md5(time().$userName.mt_rand(1000,9999));
			$_POST[activationKey] = $activation;  
			$cms->sqlquery("rs","user",$_POST); 
			$postmsg= '<p style="color:#33FF33">Thank you for successful registration. Please check your Email.</p>';
			$activation_key = $cms->getSingleresult("SELECT activationKey FROM #_user WHERE emailId='".$emailId."' AND status='Inactive' ");
			$activate_link = SITE_PATH."activate?key=".$activation_key;
			$to = $emailId ; 
			$subject = "Registration Confirmation Email";
			$mail_body = '<html>
			<body>
			<table width="100%" align="center" style="background-color:#eee">
			<tr><td colspan="2" align="left">Thank you for having account with us on ' .SITE_PATH. ' your login detail are bellow:</td></tr>
			<tr><td width="7%"  align="left">User Name:</td><td align="left">'  .$userName. '</td></tr>
			<tr><td width="5%"  align="left">Name:</td><td align="left">' .$name. '</td></tr>
			<tr><td width="5%"  align="left">Email Id:</td><td align="left">' .$emailId. '</td></tr>
			<tr><td width="5%"  align="left">Password:</td><td align="left">' .$password. '</td></tr> 
			<tr><td colspan="2"  align="left">Please click the following link to activate your account:</td><td align="left">' .$activate_link. '</td></tr> 
			<tr><td colspan="2" align="left">Thanks and Regards,<br>Admin @'.SITE_NAME.'</td></tr>
			</table> 
			</body>
			</html>';
			$adminEmail = SITE_MAIL;
			$from = $adminEmail;
			$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$adminEmail.'' . "\r\n";  
			@mail($to, $subject, $mail_body, $headers,"-f $from"); 
			$er = '<p align="left" style="color:green; margin:10px 0; display:block; " >Your login detail has been sent to the registered email id!</p>';
			$_POST = false; 
			 
		} else {
			$postmsg= '<p style="color:#FF0000">Email already exist.</p>'; 
		}
	}else{
		$postmsg= '<p style="color:#FF0000">User already exist.</p>';
	}	
}
?>
<section class="carousel-section">
  <div id="carousel-example-generic" class="carousel carousel-razon slide" data-ride="carousel" data-interval="5000"> 
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-7">
              <div class="carousel-caption">
                <div class="carousel-text">
                  <h1 class="animated fadeInDownBig animation-delay-7 carousel-title">Welcome to the Fanstastic Cup</h1>
                  <ul class="list-unstyled carousel-list">
                    <li class="animated bounceInLeft animation-delay-11">Lorem ipsum dolor sit amet consectetur adipisicing elit. In rerum maxime quis tenetur dolor  qui enim dolorem.  In rerum maxime quis tenetur dolor  qui enim dolorem.  In rerum maxime quis tenetur dolor  qui enim dolorem. In rerum maxime quis tenetur dolor  qui enim dolorem.</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-5 hidden-xs carousel-img-wrap">
              <div class="main_tab">
                <ul class="nav nav-tabs nav-tabs-ar nav-tabs-ar-white">
                  <li><a href="<?=SITE_PATH?>" data-toggle="tab" id="home2">Sign In</a></li>
                  <li class="active"><a href="register" data-toggle="tab" id="profile2">Register</a></li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
				    <div class="tab-pane active" id="profile2">
                    <form role="form"  action="" method="post">
                      <div class="form-group">
                        <label for="InputUserName">User Name<sup>*</sup></label>
                        <input class="form-control" id="InputUserName" type="text" name="userName">
                      </div>
                      <div class="form-group">
                        <label for="InputEmail">Email<sup>*</sup></label>
                        <input class="form-control" id="InputEmail" type="email" name="emailId">
                      </div>
                      <div class="form-group">
                        <label for="InputEmail">Password<sup>*</sup></label>
                        <input class="form-control" id="InputPassword" type="password" name="password">
                      </div>
						<div>
							<?=$postmsg?>
						</div>
                      <div class="row">
                        <div class="col-md-8">
                          <label class="checkbox-inline">
                            <input id="inlineCheckbox1" value="option1" type="checkbox" required >
                            I read <a href="#" required>Terms and Conditions</a>. </label>
                        </div>
						
                        <div class="col-md-4">
                          <button type="submit" id="register" class="btn btn-ar btn-primary pull-right">Register</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
</div>


