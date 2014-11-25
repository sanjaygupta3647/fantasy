<?php
if($_SESSION['FBID']){
 $_SESSION['FBID'];
 $_SESSION['FULLNAME'];
}
else 
if(!$_SESSION['userName']){ $cms->redir(SITE_PATH, true);}
	
?>

<div class="container">
  <div class="row" style="margin-top: 40px;">
    <?php include "site/left-pannel.php";  ?>
    <div class="col-md-9" >
      <!-- Nav tabs -->
      <ul class="nav nav-tabs nav-tabs-ar nav-tabs-ar-white" >
        <li class="active"><a href="#home2" data-toggle="tab">All Comming Matches</a></li>
        <li><a href="#profile2" data-toggle="tab">Profile</a></li>
        <li><a href="#messages2" data-toggle="tab">History</a></li>
        <li><a href="#live-score" data-toggle="tab">Live Score</a></li>
         
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <?php 
		include "site/Paging.php"; 
		include "site/tab1.php";  ?>
        <div class="tab-pane" id="profile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, at, laboriosam, possimus, nam rem quia reiciendis sit vel totam id eum quasi aperiam officiis omnis ipsum quo praesentium quaerat unde mollitia maiores. Dignissimos, deleniti, eos, quibusdam quae voluptatibus obcaecati voluptatum iure quas voluptates cupiditate incidunt voluptate dolorem delectus exercitationem earum?</div>
        <div class="tab-pane" id="messages2"><?php include "site/history.php";  ?></div>
        <div class="tab-pane" id="live-score">Comming soon! </div>
         
    </div>
  </div>
</div>
</div>
