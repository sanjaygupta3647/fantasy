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
         
        <li><a href="#messages2" data-toggle="tab">History</a></li>
       
         
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <?php 
		include "site/Paging.php"; 
		include "site/tab1.php";  ?> 
        <div class="tab-pane" id="messages2"><?php include "site/history.php";  ?></div> 
       
    </div>
  </div>
</div>
</div>
