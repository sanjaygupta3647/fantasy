<?php
if($_SESSION['FBID']){
 $_SESSION['FBID'];
 $_SESSION['FULLNAME'];
}
else 
if(!$_SESSION['userName']) $cms->redir(SITE_PATH, true);
$arrCheck = $cms->db_query("SELECT * FROM #_user WHERE pid = '".$_SESSION['pid']."' AND userName = '".$_SESSION['userName']."'");
$udetl = $cms->db_fetch_array($arrCheck);
//print_r($arrDetail);
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
        <li><a href="#settings22" data-toggle="tab">Match the Followings</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <?php include "site/tab1.php";  ?>
        <div class="tab-pane" id="profile2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, at, laboriosam, possimus, nam rem quia reiciendis sit vel totam id eum quasi aperiam officiis omnis ipsum quo praesentium quaerat unde mollitia maiores. Dignissimos, deleniti, eos, quibusdam quae voluptatibus obcaecati voluptatum iure quas voluptates cupiditate incidunt voluptate dolorem delectus exercitationem earum?</div>
        <div class="tab-pane" id="messages2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt, ipsam, distinctio, ea quas quam mollitia enim dolorem aliquam laboriosam exercitationem ullam iste quis possimus aut atque est beatae temporibus impedit deleniti explicabo ratione esse molestias maiores minima odit? Tempore, omnis, possimus praesentium minus iusto laboriosam vitae officiis deserunt voluptate odio.</div>
        <div class="tab-pane" id="live-score">Comming soon! </div>
        <div class="tab-pane" id="settings22">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, blanditiis, ea quam minus aliquid libero quibusdam eos incidunt quo accusantium itaque veritatis reprehenderit optio provident nostrum ipsam aliquam voluptate officia voluptatem magni vitae nisi error maiores dolor natus at perferendis. Eligendi, a deserunt voluptatibus facere dolores rem molestias ad magnam!</div>
      </div>
    </div>
  </div>
</div>
