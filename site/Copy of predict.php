<div class="container">
<div class="row" style="margin-top: 40px;">

<div class="col-md-3" style="border: 1px solid rgb(236, 236, 236);">
<span style="padding-left: 15px;"><strong>Naresh Kumar</strong></span>
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
<td align="center"> <a href="#" style="background-color:#7f7f7f; color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; margin-top: 16px; float: left;">Predict</a></td>
<td align="center">Match Scheduled To began at<br>
14:00:00 Loacl Time<br>
(01 :00 GMT)
</td>
</tr>
</thead>    
</table>

<div class="row">

<div class="col-lg-8">
<form role="form">

<h5 style="color: rgb(0, 0, 0); text-decoration: underline;">SELECT YOUR OPTIONS TO PREDICT</h5>
                    <div class="form-group">
                        <label for="InputName" class="lable_about">Which Team Will Win</label>  <a href="#" class="predict">Predict & Win 100 Points</a>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail1" class="lable_about">Select Yours Favorite Player</label>
                        <a href="#" class="predict">Predict & Win 100 Points</a>
                    </div>
                    
                     <div class="form-group">
                        <label for="InputEmail1" class="lable_about">Total Score</label>
                         <a href="#" class="predict">Predict & Win 100 Points</a>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="InputEmail1" class="lable_about">Total Score</label>
                       <a href="#" class="predict">Predict & Win 100 Points</a>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="InputEmail1" class="lable_about">Who will score how much</label>
                        <a href="#" class="predict">Predict & Win 100 Points</a>
                    </div> 
                    <div class="form-group">
                        <label for="InputEmail1" class="lable_about">Who will score how much</label>
                       <a href="#" class="predict">Predict & Win 100 Points</a>
                    </div>
                </form>
                </div>
                
              <div class="col-lg-4">
              
<div style="border-radius: 7px; background-color:#bbb; height: 410px; margin-top: 12px;">
<p style="color: rgb(255, 255, 255); font-size:18px; padding-top: 8px; text-align: center;">TESTIMONIALS</p>
<marquee  onMouseOver="this.scrollAmount=0" onMouseOut="this.scrollAmount=2" scrollamount="2" direction="up" loop="true" width="100%" height="350">
<center>

<p style="color: rgb(255, 255, 255); padding: 8px; text-align: justify;">Lorem ipsum Ex aliqua tempor nisi laboris dolor id laborum irure minim tempor in sit dolore amet sit esse nostrud tempor nulla consequat aute in nostrud laboris sint ullamco amet nisi pariatur officia nulla pariatur in id et labore dolore ad sit.Lorem ipsum Ex aliqua tempor nisi laboris dolor id laborum irure minim </p>
<p style="color: rgb(255, 255, 255); padding: 8px; text-align: justify;">Lorem ipsum Ex aliqua tempor nisi laboris dolor id laborum irure minim tempor in sit dolore amet sit esse nostrud tempor nulla consequat aute in nostrud laboris sint ullamco amet nisi pariatur officia nulla pariatur in id et labore dolore ad sit.Lorem ipsum Ex aliqua tempor nisi laboris dolor id laborum irure minim </p>

</center>
</marquee>
</div>
              
              
              
              
              </div>  
                
</div>


<div class="col-md-12">
   <p class="grap">Grab your GIfts</p>
       <div class="bxslider-controls">
            <span id="bx-prev4"> <a class="bx-prev" href="">&lt;</a></span>
            <span id="bx-next4"> <a class="bx-next" href="">&gt;</a></span>
        </div>
      
            <ul style="width: 1415%; position: relative; transition-duration: 0s; transform: translate3d(-1180px, 0px, 0px);" class="center" id="latest-works">
				<?php
					$getGifts = $cms->db_query("SELECT * FROM #_gift WHERE status = 'Active'");
					while($arrGift = $cms->db_fetch_array($getGifts)){
				?>
				  <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 100px; margin-right: 10px;">
					<div class="img-caption-ar"> <label for="gift" style="margin-left: 12px;"><?=$arrGift[giftName]?> </label></br><label for="points"><?=$arrGift[get_points]?> Points</label> </div>
				  </li>
				<?php } ?>
				</ul>
			<!--
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
       <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
          <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li>
        <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
          <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li>
        <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
          <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li>
        <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
          <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li>
        <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
          <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li>
        <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
          <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li>
        <li style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li>
        <li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
        </li><li class="bx-clone" style="float: left; list-style: outside none none; position: relative; width: 98px; margin-right: 30px;">
            <div class="img-caption-ar">
                <img src="images/one_slids.jpg" class="img-responsive" alt="Image">
            </div>
          </li></ul></div><div class="bx-controls"></div></div></div><div class="bx-controls"></div></div>
       
       
       
       -->
        </div>









</div>

<div class="tab-pane" id="profile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, at, laboriosam, possimus, nam rem quia reiciendis sit vel totam id eum quasi aperiam officiis omnis ipsum quo praesentium quaerat unde mollitia maiores. Dignissimos, deleniti, eos, quibusdam quae voluptatibus obcaecati voluptatum iure quas voluptates cupiditate incidunt voluptate dolorem delectus exercitationem earum?</div>

<div class="tab-pane" id="messages2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt, ipsam, distinctio, ea quas quam mollitia enim dolorem aliquam laboriosam exercitationem ullam iste quis possimus aut atque est beatae temporibus impedit deleniti explicabo ratione esse molestias maiores minima odit? Tempore, omnis, possimus praesentium minus iusto laboriosam vitae officiis deserunt voluptate odio.</div>

<div class="tab-pane" id="settings2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, blanditiis, ea quam minus aliquid libero quibusdam eos incidunt quo accusantium itaque veritatis reprehenderit optio provident nostrum ipsam aliquam voluptate officia voluptatem magni vitae nisi error maiores dolor natus at perferendis. Eligendi, a deserunt voluptatibus facere dolores rem molestias ad magnam!</div>

<div class="tab-pane" id="settings22">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, blanditiis, ea quam minus aliquid libero quibusdam eos incidunt quo accusantium itaque veritatis reprehenderit optio provident nostrum ipsam aliquam voluptate officia voluptatem magni vitae nisi error maiores dolor natus at perferendis. Eligendi, a deserunt voluptatibus facere dolores rem molestias ad magnam!</div>

</div>
</div>
</div>

</div>