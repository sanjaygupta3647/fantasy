<?php
if(!$_SESSION['userName']) $cms->redir(SITE_PATH, true);
$metaTitle = $cms->getSingleresult("select metatitle from pro_matches where pid = '".$items[2]."'");
$metaIntro = $cms->getSingleresult("select metakey from pro_matches where pid = '".$items[2]."'");
$metaKeyword = $cms->getSingleresult("select metadesc from pro_matches where pid = '".$items[2]."'"); 
?>
<div class="container">
  <div class="row" style="margin-top: 40px;">
    <?php include "site/left-pannel.php";  ?>
    <div class="col-md-9">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs nav-tabs-ar nav-tabs-ar-white">
        <li class="active"><a href="#home2" data-toggle="tab">Options</a></li>
        <li><a href="#profile2" data-toggle="tab">Score</a></li>
        
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="home2">
		<?php
	$sql="select series_id,pid,url,title,match_date,team1,team2 from pro_matches where pid = '".$items[2]."'";
	$searchexe = $cms->db_query($sql);
	$total_match21 = mysql_num_rows($searchexe);
    if($total_match21){
	$i = 1;
	while($arrAdmin=$cms->db_fetch_array($searchexe)){extract($arrAdmin);?>
		<table class="table table-bordered">
			<thead>
			  <tr><?php 
				  $img1  = $cms->getSingleresult("select image from #_team where pid ='$team1'");
				  $img2  = $cms->getSingleresult("select image from #_team where pid ='$team2'"); 
			    ?>
				<td id="blenk" width="30%">
				<img width="56" height="54" src="uploaded_files/orginal/<?=$img1?>">
				&nbsp;&nbsp;  <span>Vs</span>  &nbsp;&nbsp;
				<img width="56" height="54" src="uploaded_files/orginal/<?=$img2?>"></td> 
				<td align="center" width="40%"><a href="<?=SITE_PATH?>predict/<?=$url?>/<?=$pid?>"><?=$title?></a> <br/><?=$match_date?> GMT </td>
				  <!--<td align="center"> <?=$match_date?> GMT </td> -->
				  <td align="center"> 
				  <input type="hidden" id="countdown<?=$i?>" value="<?=date("Y/m/d H:i:s", strtotime($match_date))?>" />
				  <span style="float: left;" id="time_<?=$i?>"></span>
				  <!--<a href="<?=SITE_PATH?>predict/<?=$url?>" 
				  style="background-color: rgb(0, 116, 255); color: rgb(255, 255, 255); padding: 3px 27px; border-radius: 3px; 
				  margin-top: 16px; float: left;">Predict</a>--></td>
			  </tr>
			</thead>
  		</table>
	
	<?php	$i++;
	}
}?>
          <div class="row">
            <div class="col-lg-8">
               
				<h5 style="color: rgb(0, 0, 0); text-decoration: underline;">SELECT YOUR OPTIONS TO PREDICT</h5>
				<?php
			     $result = $cms->db_query("select * from #_prediction where status = 'Active'   ");
				 while($arrAdmin=$cms->db_fetch_array($result)){extract($arrAdmin);?>
					<div class="form-group">
					  <label for="InputName" class="lable_about"><?=$prediction?></label>
					  <?php
                       $url = "prediction-detail/".$items[2]."/".$adm->baseurl($prediction.'-Predict & Win-'.$prediction_points)."-points/".$pid;
					  ?>
					  <a href="<?=$url?>" class="predict">Predict & Win <?=$prediction_points?> Points</a> 
					</div><?php 
				 }
                ?>

				 
                 
              
            </div>
            <div class="col-lg-4">
              <div style="border-radius: 7px; background-color:#bbb; height: 410px; margin-top: 12px;">
                <p style="color: rgb(255, 255, 255); font-size:18px; padding-top: 8px; text-align: center;">TESTIMONIALS</p>
                <marquee  onMouseOver="this.scrollAmount=0" onMouseOut="this.scrollAmount=2" scrollamount="2" direction="up" loop="true" width="100%" height="350">
                <center>
                  <?php 
					$rsAdmin=$cms->db_query("SELECT * FROM #_testimonials WHERE id='1' AND status='Active'");
					$arrAdmin=$cms->db_fetch_array($rsAdmin);
					@extract($arrAdmin);
					?>
                  <p>
                    <?=$arrAdmin[testimonials]?>
                  </p>
                </center>
                </marquee>
              </div>
            </div>
          </div>
           <?php include "site/grab-gift.php"; ?>
        </div>
        <div class="tab-pane" id="profile2">Score coming soon..</div>
         
      </div>
    </div>
  </div>
</div>
