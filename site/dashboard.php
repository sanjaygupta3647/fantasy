<?php
$arrCheck = $cms->db_query("SELECT * FROM #_user WHERE pid = '".$_SESSION['pid']."' AND userName = '".$_SESSION['userName']."'");
$arrDetail = $cms->db_fetch_array($arrCheck);
//print_r($arrDetail);
?>
<div class="container">
<div class="row" style="margin-top: 40px;">

<div class="col-md-3" style="border: 1px solid rgb(236, 236, 236);">
<span style="padding-left: 15px;"><strong><?=strtoupper($_SESSION['userName'])?></strong></span>
<div class="points">
<span class="points_img"><img src="images/pointss.jpg"></span>

<span class="points_img2">
<div class="two_points">200 pionts</div>
<div class="two_points2">Correct predictions<br>
<img src="images/hat.jpg"> <span style="padding-left: 41px;">5</span>
</div>
</span>

<div class="scord">
<ul>
<li><a href="#">Score Board</a></li>
<li><a href="#">Prizes</a></li>
<li><a href="#">Winners</a></li>
<li><a href="#">Invite Friends</a></li>
<li><a href="#">Upcoming Matches</a></li>
</ul>
</div>

<div class="scord2">
<img src="images/add.jpg">
</div>



</div>

</div>

<div class="col-md-9">
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-tabs-ar nav-tabs-ar-white">
<li class="active"><a href="#home2" data-toggle="tab">Multiple Coice Questions</a></li>
<li><a href="#profile2" data-toggle="tab">Fill in the Blanks</a></li>
<li><a href="#messages2" data-toggle="tab">Unscramble</a></li>
<li><a href="#settings2" data-toggle="tab">Find the word</a></li>
<li><a href="#settings22" data-toggle="tab">Match the Followings</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="home2">
<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>

<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>

<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>


<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>

<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>


<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>

<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>


<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>

<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>

<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>


<table class="table table-bordered">
<thead>
<tr>
<td id="blenk"><img src="images/about_logo.jpg" class="img-responsive"></td>
<td align="center">19 Nov 2014<br>
01 :00 GMT
</td>
<td align="center"> <a href="#" style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>




</div>

<div class="tab-pane" id="profile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, at, laboriosam, possimus, nam rem quia reiciendis sit vel totam id eum quasi aperiam officiis omnis ipsum quo praesentium quaerat unde mollitia maiores. Dignissimos, deleniti, eos, quibusdam quae voluptatibus obcaecati voluptatum iure quas voluptates cupiditate incidunt voluptate dolorem delectus exercitationem earum?</div>

<div class="tab-pane" id="messages2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt, ipsam, distinctio, ea quas quam mollitia enim dolorem aliquam laboriosam exercitationem ullam iste quis possimus aut atque est beatae temporibus impedit deleniti explicabo ratione esse molestias maiores minima odit? Tempore, omnis, possimus praesentium minus iusto laboriosam vitae officiis deserunt voluptate odio.</div>

<div class="tab-pane" id="settings2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, blanditiis, ea quam minus aliquid libero quibusdam eos incidunt quo accusantium itaque veritatis reprehenderit optio provident nostrum ipsam aliquam voluptate officia voluptatem magni vitae nisi error maiores dolor natus at perferendis. Eligendi, a deserunt voluptatibus facere dolores rem molestias ad magnam!</div>

<div class="tab-pane" id="settings22">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, blanditiis, ea quam minus aliquid libero quibusdam eos incidunt quo accusantium itaque veritatis reprehenderit optio provident nostrum ipsam aliquam voluptate officia voluptatem magni vitae nisi error maiores dolor natus at perferendis. Eligendi, a deserunt voluptatibus facere dolores rem molestias ad magnam!</div>

</div>
</div>
</div>

</div>