<?php
$result = $cms->db_query("select  pid, team1,team2 from #_matches   ");
 while($arrAdmin=$cms->db_fetch_array($result)){extract($arrAdmin);
	  $pid1  = $cms->getSingleresult("select pid from #_team where name ='$team1'");
	  $pid2  = $cms->getSingleresult("select pid from #_team where name ='$team2'");
	  $cms->db_query("update #_matches set team1  = '$pid1',team2  = '$pid2' where pid = '$pid'    ");

 }