<aside id="footer-widgets">
    <div class="container">
        <!--<div class="row">
            <div class="col-md-2">
                <h3 class="footer-widget-title">PRODUCTS</h3>
                <ul class="list-unstyled three_cols">
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="portfolio_sidebar.html">Portafolio</a></li>
                   
                </ul>
            </div>
            
            <div class="col-md-2">
                <h3 class="footer-widget-title">TECHNOLOGY</h3>
                <ul class="list-unstyled three_cols">
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="portfolio_sidebar.html">Portafolio</a></li>
                   
                </ul>
            </div>
            <div class="col-md-2">
                <h3 class="footer-widget-title">COMPANY</h3>
                <ul class="list-unstyled three_cols">
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="portfolio_sidebar.html">Portafolio</a></li>
                   
                </ul>
            </div>
            
            <div class="col-md-2">
                <h3 class="footer-widget-title">FOLLOW US</h3>
                <ul class="list-unstyled three_cols">
                    <li><a href="index.html" class="active"><img src="images/google.jpg" align="left">Google</a></li>
                    <li><a href="blog.html"><img src="images/tweete.jpg" align="left">Twitter</a></li>
                    <li><a href="portfolio_sidebar.html"><img src="images/faceboo2.jpg" align="left">Facebook</a></li>
                    
                </ul>
            </div>
            
            <div class="col-md-3" style="text-align: right;">
                <h3 class="footer-widget-title">CONTACT</h3>
              <span style="color: #000; font-size: 13px;"> Telephone : 83 7797 6212<br>
               Fax : 1 504 889  9898<br>
               E-mail : mailto:demolink.org</span>
               
            </div>
            
            
        </div>--> <!-- row -->
    </div> <!-- container -->
</aside>
<footer id="footer">
<div class="container">
        <div class="row">
   <div style="text-align: right; width: 100%; float: right;"><strong>&copy; <?=date('Y')?> </strong><a href="#"><strong><?=$_SERVER['HTTP_HOST']?></strong></a></div>
    
  <div class="set2"><?php
  	$chekc=$cms->db_query("select pid,heading,url from #_pages where status='Active' and fnav='yes' ");
	$cnt = mysql_num_rows($chekc);
	$i  =1;
	while($rs=$cms->db_fetch_array($chekc)){ extract($rs);
	    if($heading=='Home') $link = SITE_PATH; else $link = SITE_PATH.'page/'.$url; ?>
		<a href="<?=$link?>"><?=$heading?></a> <?=($i!=$cnt)?' | ':''?>
	<?php $i++;
	}?>
   
   </div>
    
    </div></div>
</footer>