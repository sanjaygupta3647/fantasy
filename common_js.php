<script src="<?=SITE_PATH?>js/jquery.min.js"></script>
<script src="<?=SITE_PATH?>js/jquery-1.7.1.min.js"></script>
<?php 
if($loadpage=='site/dashboard.php' || $loadpage=='site/predict.php' || $loadpage=='site/prediction-detail.php'){?>
<script type="text/javascript" src="<?=SITE_PATH?>js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="<?=SITE_PATH?>js/jquery.countdownTimer.js"></script>
<script>
$(function(){
	var cnt  = '<?=$total_match21?>';   
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
<script src="<?=SITE_PATH?>js/index.js"></script>
<script src="<?=SITE_PATH?>js/holder.js"></script>
<script src="<?=SITE_PATH?>js/buttons.js"></script>
<script src="<?=SITE_PATH?>js/styleswitcher.js"></script>
<script src="<?=SITE_PATH?>js/jquery.mixitup.min.js"></script>
<script src="<?=SITE_PATH?>js/circles.min.js"></script>
<script src="<?=SITE_PATH?>js/shCore.js"></script>
<script src="<?=SITE_PATH?>js/shBrushXml.js"></script>
<script src="<?=SITE_PATH?>js/shBrushJScript.js"></script> 
<script src="<?=SITE_PATH?>js/app.js"></script>
<?php
if($loadpage=='site/redeem-points.php'){?>
<script src="<?=SITE_PATH?>js/validate.js"></script>
<?php
}?>

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

	$("#showpassform").click(function(){
		$(this).hide();
		$(".showpass").show();
	});
	$("#getpass").click(function(){
		var getemail = $("#forgotemail").val(); 
		$.ajax({
		    url : "<?=SITE_PATH?>ms_file/forgotpass/?email="+getemail, 
		    success: function(data, textStatus, jqXHR){  
		       	$("#forgotpassmsg").html(data);  
		    },
		    error: function (jqXHR, textStatus, errorThrown){
		 		alert(errorThrown);
		    }
		});
	});
<?php
}
?> 
<?php 
if($loadpage=='site/dashboard.php' || $loadpage=='site/my-gifts.php'){?>
var maxpage = '<?=$totpage?>';
var paging  = '<?=$limitpage?>';
$("#nextpage").click(function(){
	var curpage = $(this).attr('lang');
	ajaxpageing(curpage);
	var prevpage =$("#prevpage").attr('lang'); 
	//alert(curpage+ ' and ' +prevpage);
	if(curpage<maxpage){
		curpage++;
		prevpage++;
		$("#prevpage").attr('lang',prevpage);
		$(this).attr('lang',curpage);
	}else{
		$(this).hide('slow');
		$("#prevpage").show('slow');
	} 
});
$("#prevpage").click(function(){
	var curpage = $(this).attr('lang');
	ajaxpageing(curpage);
	var nextpage =$("#nextpage").attr('lang'); 
	//alert(curpage+ ' and ' +nextpage);
	if(curpage>1){
		curpage--;
		nextpage--;
		$("#nextpage").attr('lang',nextpage);
		$(this).attr('lang',curpage);
	}else{
		$(this).hide('slow');
		$("#nextpage").show('slow');
	} 
});
function ajaxpageing(page){ 
	$.ajax({
	    url : "<?=SITE_PATH?>ms_file/history-paging/?page="+page, 
	    success: function(data, textStatus, jqXHR){  
	       	$("#userpredictionpage").html(data);  
	    },
	    error: function (jqXHR, textStatus, errorThrown){
	 		alert(errorThrown);
	    }
	});
}
<?php }?>
 
</script>