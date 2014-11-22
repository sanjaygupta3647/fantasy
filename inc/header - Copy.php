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
				<a href="<?=SITE_PATH?>" class="dropdown-toggle link" data-toggle="dropdown">Register</a> 
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
                <li class="active">
                <a href="#">Home</a>
                     
                </li>
                <li>
                    <a href="#">What is Fantastic Cricket?</a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">How to Play</a>
                     <ul class="dropdown-menu dropdown-menu-left">
                        <li class="dropdown-submenu">
                                <a href="javascript:void(0);" class="has_children">About us & Team</a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="page_about.html">About us Option 1</a></li>
                                <li><a href="page_about2.html">About us Option 2</a></li>
                                <li><a href="page_about3.html">About us & Team</a></li>
                                <li class="divider"></li>                                        <li><a href="page_team.html">Our Team Option 1</a></li>
                                <li><a href="page_team2.html">Our Team Option 2</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                                <a href="javascript:void(0);" class="has_children">Form</a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="page_contact.html">Contact Option 1</a></li>
                                <li><a href="page_contact2.html">Contact Option 2</a></li>
                                <li class="divider"></li>                                        <li><a href="page_login.html">Login Integrated</a></li>
                                <li><a href="page_login_full.html">Login Full Page</a></li>
                                <li class="divider"></li>                                        <li><a href="page_login_register.html">Login and Register</a></li>
                                <li><a href="page_register.html">Register Option 1</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                                <a href="javascript:void(0);" class="has_children">Profiles</a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="page_profile.html">User Profile Option 1</a></li>
                                <li><a href="page_profile2.html">User Profile Option 2</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                                <a href="javascript:void(0);" class="has_children">Error</a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="page_404.html">Error 404 Full Page</a></li>
                                <li><a href="page_404_2.html">Error 404 Integrated</a></li>
                                <li><a href="page_500.html">Error 500 Full Page</a></li>
                                <li><a href="page_500_2.html">Error 500 Integrated</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                                <a href="javascript:void(0);" class="has_children">Bussiness & Products</a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="page_testimonial.html">Testimonials</a></li>
                                <li><a href="page_clients.html">Our Clients</a></li>
                                <li><a href="page_product.html">Products</a></li>
                                <li><a href="page_services.html">Services</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Disclaimer and Risk Factors</a>
                     <ul class="dropdown-menu dropdown-menu-left">
                        <li class="dropdown-submenu">
                                <a href="javascript:void(0);" class="has_children">About us & Team</a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="page_about.html">About us Option 1</a></li>
                                <li><a href="page_about2.html">About us Option 2</a></li>
                                <li><a href="page_about3.html">About us & Team</a></li>
                                <li class="divider"></li>                                        <li><a href="page_team.html">Our Team Option 1</a></li>
                                <li><a href="page_team2.html">Our Team Option 2</a></li>
                            </ul>
                        </li>
						</ul>
                </li>
                <li>
                    <a href="<?=SITE_PATH?>term-condition">Terms and Conditions</a>
                     
                </li>
                
             </ul>
        </div><!-- navbar-collapse -->
    </div><!-- container -->
</nav>