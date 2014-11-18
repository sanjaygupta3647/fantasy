 <div class="container">
<div class="row" style="margin-top: 40px;">

<div class="col-md-12">
            <h2 class="right-line">Terms and Conditions</h2>
			<?php 
			$description=$cms->getSingleresult("SELECT page_description	 FROM #_pages WHERE page_name = 'Term and Condition' AND status='Active'");
			?>
			<p><?=$description?></p>
            
        </div>



</div>






</div>