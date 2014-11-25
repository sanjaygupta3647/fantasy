<div class="col-md-3" style="border: 1px solid rgb(236, 236, 236);"> <span style="padding-left: 15px;">Welcome,
      <?php if($_SESSION['FBID']){ echo $_SESSION['FULLNAME'];}else { echo strtoupper($_SESSION['userName']); } ?>
      </span>
      <div class="points">
        <?php
		if($udetl[image] && is_file($_SERVER['DOCUMENT_ROOT'].SITE_SUB_PATH."uploaded_files/orginal/".$udetl[image])==true){
			$path = SITE_PATH."uploaded_files/orginal/".$udetl[image];
		}
	    else{ $path = SITE_PATH."images/no-user-image.png";}?>
        <span class="points_img"><img src="<?=$path?>" width="75" style="max-height:74px;"></span> <span class="points_img2">
		<?php $getpoints = $cms->getPoins($_SESSION['pid']);?>
        <div class="two_points"><?=$getpoints[remain]?> pionts</div>
        <div class="two_points2">Correct predictions<br>
          <img src="images/hat.jpg"> <span style="padding-left: 41px;"><?=$getpoints[correct_prediction]?></span> </div>
        </span>
        <div class="scord" style="display:none;">
          <ul>
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Score Board</a></li>
            <li><a href="#">Prizes</a></li>
            <li><a href="#">Winners</a></li>
            <li><a href="#">Invite Friends</a></li>
            <li><a href="#">Upcoming Matches</a></li>
          </ul>
        </div>
        <div class="scord2"> <img src="images/add.jpg"> </div>
      </div>
    </div>