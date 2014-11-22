<?php 
$metaTitle = $cms->getSingleresult("select meta_title from #_pages where heading = 'Home' and status = 'Active'");
$metaIntro = $cms->getSingleresult("select meta_description from #_pages where heading = 'Home' and status = 'Active'");
$metaKeyword = $cms->getSingleresult("select meta_keyword from #_pages where heading = 'Home' and status = 'Active'"); 
if($_POST[login]){
	$rsCheck = $cms->db_query("select * from #_user where userName='".trim($_POST[userName])."' and password='". base64_encode(trim($_POST[password]))."' and status='Active'");
	if(mysql_num_rows($rsCheck)){
		$arrCheck = $cms->db_fetch_array($rsCheck);
		if($arrCheck[status] == 'Active'){ 
			$_SESSION['pid'] = $arrCheck[pid];
			$_SESSION['userName'] = $arrCheck[userName];
			$_SESSION['email'] = $arrCheck[emailId];
			header("Location:".SITE_PATH."dashboard"); 
		}
	}
	else {
		$postmsg = '<p style="color:#FF0000">Invalid User Name Or Password!.</p>';
	}
}
if($_POST[register]){ 
	$err = 0;
	$checkemail = $cms->getSingleresult("SELECT count(*) FROM #_user WHERE  emailId='".$_POST[emailId]."' "); 
	$user = $cms->getSingleresult("SELECT count(*) FROM #_user WHERE userName ='".$_POST[userName]."' ");
	if($checkemail){ $err = 1; $postmsg= '<p style="color:#FF0000">Email already exist.</p>';  }
	if($user){ $err = 1; $postmsg= '<p style="color:#FF0000">Username already exist.</p>';  }   
	if(!$err){  
		$_POST[password] = base64_encode($_POST[password]); 
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
                  <h1 class="animated fadeInDownBig animation-delay-7 carousel-title"><?=$cms->getSingleresult("select title from #_pages where heading = 'Home' and status = 'Active'")?></h1>
                  <ul class="list-unstyled carousel-list">
                    <li class="animated bounceInLeft animation-delay-11"><?=strip_tags($cms->getSingleresult("select body from #_pages where heading = 'Home' and status = 'Active'"))?></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-5 hidden-xs carousel-img-wrap">
              <div class="main_tab">
                <ul class="nav nav-tabs nav-tabs-ar nav-tabs-ar-white">
				   <?php
					if($register) $_POST[register]  = 1;
				   ?>
                  <li <?=($_POST[register])?'':'class="active"'?> ><a href="#home2" data-toggle="tab">Sign In</a></li>
                  <li <?=($_POST[register])?'class="active"':''?>><a href="#profile2" data-toggle="tab">Register</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
				 
                  <div class="tab-pane <?=($_POST[register])?'':'active'?>" id="home2">
				  <form role="form" method="post"> 
				  <input type="hidden" name="login" value="1" />
                    <p><a href="<?=SITE_PATH?>fbconfig"><img src="images/facebook.jpg"></a> <a href="#"><img src="images/twitter.jpg"></a></p>
                    <div class="form-group">
                      <div class="input-group login-input"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input class="form-control" placeholder="User Name" value="<?=$_POST[userName]?>" name="userName" type="text">
                      </div>
                      <br>
                      <div class="input-group login-input"> <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" placeholder="Password" name="password" type="password">
                      </div>
					  <?=$postmsg?>
                      <hr class="dotted margin-10">
                      <button type="submit" class="btn btn-ar btn-primary pull-right">Sign in</button>
                      <a href="#" class="social-icon-ar sm twitter animated fadeInDown animation-delay-2">Forgotten password</a>
                      <hr class="dotted margin-10">
                    </div>
					</form>
                  </div>
				  
                  <div class="tab-pane <?=($_POST[register])?'active':''?>" id="profile2"> 
				    <form role="form" method="post"> 
                      <div class="form-group">   
					   <input type="hidden" name="register" value="1" />
                        <label for="InputUserName">User Name<sup>*</sup></label>
                        <input class="form-control" id="InputUserName" type="text" value="<?=$_POST[userName]?>" name="userName">
                      </div>
                      <div class="form-group">
                        <label for="InputEmail">Email<sup>*</sup></label>
                        <input class="form-control" id="InputEmail" type="email" value="<?=$_POST[emailId]?>" name="emailId">
                      </div>
                      <div class="form-group">
                        <label for="InputEmail">Password<sup>*</sup></label>
                        <input class="form-control" id="InputPassword" type="password" name="password">
                      </div>
					  <div><?=$postmsg?></div>
                      <div class="row">
                        <div class="col-md-8">
                          <label class="checkbox-inline">
                          <input id="inlineCheckbox1" value="option1" type="checkbox">
                          I read <a href="#">Terms and Conditions</a>. </label>
                        </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-ar btn-primary pull-right">Register</button>
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
<section class="margin-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="content-box box-default animated fadeInUp animation-delay-10"> <span class="icon-ar icon-ar-lg icon-ar-round icon-ar-inverse"><img src="<?=SITE_PATH?>images/box_icon.png"></span>
          <p class="em-danger-inverse">Predict</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="content-box box-default animated fadeInUp animation-delay-16"> <span class="icon-ar icon-ar-lg icon-ar-round icon-ar-inverse"><img src="<?=SITE_PATH?>images/box_icon3.png"></span>
          <p class="em-danger-inverse">Win Points</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="content-box box-default animated fadeInUp animation-delay-14"> <span class="icon-ar icon-ar-lg icon-ar-round icon-ar-inverse"><img src="<?=SITE_PATH?>images/box_icon2.png"></span>
          <p class="em-danger-inverse">Redeem Free Gifts</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="content-box box-default animated fadeInUp animation-delay-12" style="background-image: none;width:auto;">
          <?php
				$getPoints = $cms->db_query("SELECT * FROM #_prediction WHERE status = 'Active' ORDER BY prediction_points DESC LIMIT 6");
				$i = 1;
				while($arrPoint = $cms->db_fetch_array($getPoints)){
			?>
          <p <?=($i%2==0)?'class="em-info-inverse"':'class="em-primary-inverse"'?>>
            <?=$arrPoint[prediction]?> =  <?=$arrPoint[prediction_points]?>  Points</p>
          <?php $i++; } ?>
          <!--
			<p class="em-primary-inverse">Players score = 600 points</p>
			<p class="em-info-inverse">Total score = 400 points</p>
			<p class="em-primary-inverse">Players score = 600 points</p>
			<p class="em-info-inverse">Total score = 400 points</p>-->
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <section class="margin-bottom">
    <div class="back_side">
      <div class="col-md-8">
        <p class="grap">Grab your GIfts</p>
        <div class="bxslider-controls"> <span id="bx-prev4"> </span> <span id="bx-next4"> </span> </div>
        <div style="max-width: 1130px; margin: 0px auto;" class="bx-wrapper">
          <div style="width: 100%; overflow: hidden; position: relative; height: 100px; padding-left: 15px; border-bottom: 1px solid #CCC;" class="bx-viewport">
            <ul style="width: 1415%; position: relative; transition-duration: 0s; transform: translate3d(-1180px, 0px, 0px);" class="center" id="latest-works">
              <?php
					$getGifts = $cms->db_query("SELECT * FROM #_gift WHERE status = 'Active'");
					while($arrGift = $cms->db_fetch_array($getGifts)){
				?>
              <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar">
                  <label for="gift" style="margin-left: 12px;">
                  <?=$arrGift[giftName]?>
                  </label>
                  </br>
                  <label for="points">
                  <?=$arrGift[get_points]?>
                  Points</label>
                </div>
              </li>
              <?php } ?>
              <!-- <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>
              <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
                <div class="img-caption-ar"> <img src="<?=SITE_PATH?>images/one_slids.jpg" class="img-responsive" alt="Image"> </div>
              </li>-->
            </ul>
          </div>
          <div class="bx-controls"></div>
        </div>
      </div>
      <div class="col-md-4" style="border-bottom: 1px solid rgb(204, 204, 204); padding-bottom: 11px;">
        <p class="em-warning-inverse"><a href="<?=SITE_PATH?>?register=true" style="color:#FFFFFF;">Register Now (its free)</a></p>
        <p style="padding-top: 20px;"> <span style="color:#01478f;  font-size: 24px;">119,681</span><span style="padding-left:13px; font-size: 12px;"> posted in past 3 days</span></p>
        <p><span style="color:#01478f; font-size: 24px;">$119,681</span><span style="padding-left:13px; font-size: 12px;">earned through Elance to date</span></p>
      </div>
    </div>
  </section>
</div>
<div class="container">
  <section class="margin-bottom" style="margin-top: 56px; margin-bottom: 0px;">
    <div class="row">
      <div class="col-lg-6">
        <table class="table table-striped table-striped-primary">
          <thead>
            <tr class="table_tr">
              <th>#</th>
              <th>Series</th>
              <th>Match</th>
              
              <th>Time</th>
            </tr>
          </thead>
          <tbody><?php
		    $date = date('Y-m-d h:i:s');
			$result = $cms->db_query("select series_id,title,match_date from #_matches where status='Active' and match_date > '$date' order by match_date asc limit 9 ");
			if(mysql_num_rows($result)){
				$i = 1;
				while($arrAdmin=$cms->db_fetch_array($result)){extract($arrAdmin);?>
					<tr class="table_tr2">
					  <td><?=$i?></td>
					  <td><?=$cms->getSingleresult("select title from #_series where pid = '$series_id' ")?></td>
					  <td><?=$title?></td> 
					  <td><?=$match_date?></td>
					</tr>  
				<?php
					$i++;
				} 
			}else{?>
			<tr class="table_tr2">
              <td colspan="4" align="center">Sorry no new match to be play..</td>
               
            </tr> 
			<?php			
			}?>
          </tbody>
        </table>
      </div>
      <div class="col-lg-3">
        <p class="top_new"> <img src="<?=SITE_PATH?>images/top_back.png" align="left" style="padding-right: 7px;">TOP 10 PACKS NEW NEALAND V SOUTH AFRICA 3RD ODI</p>
        <div class="box_1">
          <p> <span style="float: left;"><img src="<?=SITE_PATH?>images/face.jpg"></span> <span style="float: left; padding-left: 12px;"><strong>AB DE VILLIERS </strong><br>
            <img src="<?=SITE_PATH?>images/logo1.jpg"> <img src="<?=SITE_PATH?>images/logo1.jpg"></span> <span class="six_s"><strong>96%</strong></span> </p>
        </div>
        <div class="box_1">
          <p> <span style="float: left;"><img src="<?=SITE_PATH?>images/face.jpg"></span> <span style="float: left; padding-left: 12px;"><strong>AB DE VILLIERS </strong><br>
            <img src="<?=SITE_PATH?>images/logo1.jpg"> <img src="<?=SITE_PATH?>images/logo1.jpg"></span> <span class="six_s"><strong>96%</strong></span> </p>
        </div>
        <div class="box_1">
          <p> <span style="float: left;"><img src="<?=SITE_PATH?>images/face.jpg"></span> <span style="float: left; padding-left: 12px;"><strong>AB DE VILLIERS </strong><br>
            <img src="<?=SITE_PATH?>images/logo1.jpg"> <img src="<?=SITE_PATH?>images/logo1.jpg"></span> <span class="six_s"><strong>96%</strong></span> </p>
        </div>
        <div class="box_1">
          <p> <span style="float: left;"><img src="<?=SITE_PATH?>images/face.jpg"></span> <span style="float: left; padding-left: 12px;"><strong>AB DE VILLIERS </strong><br>
            <img src="<?=SITE_PATH?>images/logo1.jpg"> <img src="<?=SITE_PATH?>images/logo1.jpg"></span> <span class="six_s"><strong>96%</strong></span> </p>
        </div>
        <div class="box_1">
          <p> <span style="float: left;"><img src="<?=SITE_PATH?>images/face.jpg"></span> <span style="float: left; padding-left: 12px;"><strong>AB DE VILLIERS </strong><br>
            <img src="<?=SITE_PATH?>images/logo1.jpg"> <img src="<?=SITE_PATH?>images/logo1.jpg"></span> <span class="six_s"><strong>96%</strong></span> </p>
        </div>
      </div>
      <div class="col-lg-3">
        <?php
		$date = date('Y-m-d h:i:s');
			$result = $cms->db_query("select series_id,title,match_date,team1,team2 from #_matches where status='Active' and match_date > '$date' order by match_date asc limit 2 ");
			if(mysql_num_rows($result)){
				while($arrAdmin=$cms->db_fetch_array($result)){extract($arrAdmin);?>
					<p class="top_new2"> <img src="<?=SITE_PATH?>images/lock.png" align="left">
					 <span style="padding-left: 7px;"><?=$title?><br>
					 <span style="font-size:11px; padding-left: 7px;">TESTS</span></span> 
					</p>
					<div class="box_2"> 
					  <?php
						$img1  = $cms->getSingleresult("select image from #_team where pid ='$team1'");
						$img2  = $cms->getSingleresult("select image from #_team where pid ='$team2'");
					  ?>
					  <p><img width="56" height="54" src="<?=SITE_PATH?>/uploaded_files/orginal/<?=$img1?>"> <img width="56" height="54" src="<?=SITE_PATH?>/uploaded_files/orginal/<?=$img2?>"></p>
					   
					  <p class="play playgame" style="cursor:pointer;" >PLAY ></p>
					</div>
				<?php
				} 
			}else{?>

			<?php 
			}
		?> 
      </div>
    </div>
  </section>
</div>
