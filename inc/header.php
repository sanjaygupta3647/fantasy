<?php
$rsAdmin=$cms->db_query("SELECT * FROM #_setting WHERE id='1'");
$arrAdmin=$cms->db_fetch_array($rsAdmin);
@extract($arrAdmin); 
?>
<header id="header-full-top" class="hidden-xs header-full">
    <div class="container">
        <div class="header-full-title">
      <a href="<?=SITE_PATH?>"><img src="<?=SITE_PATH?>images/logo.jpg"></a>
        </div>
        <nav class="top-nav">
            <ul class="top-nav-social hidden-sm">
                <li><a href="<?=$arrAdmin[tw]?>" target="_blank" class="animated fadeIn animation-delay-7 twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="<?=$arrAdmin[fb]?>" target="_blank" class="animated fadeIn animation-delay-8 facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="<?=$arrAdmin[gp]?>" target="_blank" class="animated fadeIn animation-delay-9 googleplus"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="<?=$arrAdmin[lin]?>" target="_blank" class="animated fadeIn animation-delay-7 linkedin"><i class="fa fa-linkedin"></i></a></li>
            </ul>
            <div class="dropdown animated fadeInDown animation-delay-11">
				<a href="<?=SITE_PATH?>contact-us" class="dropdown-toggle link" data-toggle="dropdown">Contact Us</a>|
			    <?php  $log = 0;  if($_SESSION['FBID'] || $_SESSION['userName']) $log = 1; if($log){?>
				<a href="<?=SITE_PATH?>dashboard" class="dropdown-toggle link" data-toggle="dropdown">Dashboard</a>|
				<a href="<?=SITE_PATH?>logout" class="dropdown-toggle link" data-toggle="dropdown">Logout</a> 
				<?php }else{?>
				<a href="<?=SITE_PATH?>" class="dropdown-toggle link" data-toggle="dropdown">Login</a>|
				<a href="<?=SITE_PATH?>?register=true" class="dropdown-toggle link" data-toggle="dropdown">Register</a> 
				<?php }?>


                
                
               
            </div>
      
        </nav>
        
         <nav class="top-nav">
         <div class="dropdown animated fadeInDown animation-delay-11">
         <img src="<?=SITE_PATH?>images/banner_back.jpg" class="img-responsive">
         </div>
        </nav>
    </div> <!-- container -->
</header>
<nav class="navbar navbar-static-top navbar-default navbar-header-full navbar-dark" role="navigation" id="header">
    <div class="container">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
			   <?php 
			   $chekc=$cms->db_query("select pid,heading,url from #_pages where status='Active' and hnav='yes' and parent='0'");
			    while($rs=$cms->db_fetch_array($chekc)){
				         $menu2=$cms->db_query("select pid,heading,url from #_pages where status='Active' and hnav='yes' and 
						 parent='".$rs[pid]."'");
						 $cnt2 = mysql_num_rows($menu2);?>
						<li <?=($cnt2)?'class="dropdown"':''?>>
						  <a <?=($cnt2)?'class="dropdown-toggle" data-toggle="dropdown"':''?> 
						  href="<?=($rs[heading]=='Home')?SITE_PATH:SITE_PATH.'page/'.$rs[url]?>"><?=$rs[heading]?></a>
							<?php if($cnt2){?> 
							<ul class="dropdown-menu dropdown-menu-left"><?php
								while($rs2=$cms->db_fetch_array($menu2)){?>
									<li >
                                		<a href='<?=SITE_PATH.'page/'.$rs2[url]?>' ><?=$rs2[heading]?></a>
									</li>
								<?php
								}
							?> 
							</ul>
							<?php } ?> 
						
						</li>
				<?php 
				} 
			    ?>
			    <!--
                <li class="active">
                <a href="#">Home</a>
                     
                </li>
                <li>
                    <a href="#">What is Fantastic Cricket?</a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">How to Play</a>
                      
                </li> -->
                
             </ul>
        </div><!-- navbar-collapse -->
    </div><!-- container -->
</nav>