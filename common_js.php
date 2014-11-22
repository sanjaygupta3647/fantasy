<script src="<?=SITE_PATH?>js/jquery.min.js"></script>
<script src="<?=SITE_PATH?>js/jquery-1.7.1.min.js"></script>
<?php
if($loadpage=='site/dashboard.php'){?>
<script type="text/javascript" src="<?=SITE_PATH?>js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="<?=SITE_PATH?>js/jquery.countdownTimer.js"></script>
<script>
//"2016/01/01 00:00:00"
$(function(){
	var cnt  = '<?=$total_match?>'; 
	for(var i=1; i<=cnt;i++){  
		var cls = $("#countdown"+i).val();
		$('#time_'+i).countdowntimer({
			dateAndTime : cls,
			size : "lg"
		});
	}
});
</script>
<?php
}
?> 
<script src="<?=SITE_PATH?>js/jquery.cookie.js"></script>
<script src="<?=SITE_PATH?>js/bootstrap.min.js"></script>
<script src="<?=SITE_PATH?>js/wow.min.js"></script>
<script src="<?=SITE_PATH?>js/slidebars.js"></script>
<script src="<?=SITE_PATH?>js/jquery.bxslider.min.js"></script>
<script src="<?=SITE_PATH?>js/holder.js"></script>
<script src="<?=SITE_PATH?>js/buttons.js"></script>
<script src="<?=SITE_PATH?>js/styleswitcher.js"></script>
<script src="<?=SITE_PATH?>js/jquery.mixitup.min.js"></script>
<script src="<?=SITE_PATH?>js/circles.min.js"></script>
<script src="<?=SITE_PATH?>js/shCore.js"></script>
<script src="<?=SITE_PATH?>js/shBrushXml.js"></script>
<script src="<?=SITE_PATH?>js/shBrushJScript.js"></script> 
<script src="<?=SITE_PATH?>js/app.js"></script>
<script src="<?=SITE_PATH?>js/index.js"></script>

<script>
$(".link").click(function(){
	var link  = $(this).attr('href');
	window.location = link;
});
<?php
if($loadpage=='site/index.php'){?>
	$(".playgame").click(function(){
		var log = '<?=$_SESSION[email]?>';
		var path = '<?=SITE_PATH?>dashboard';
		if(log){
			window.location = path;
		}else{
			alert('Please login to predict match!');
		}
	}); 
<?php
}
?> 
</script>