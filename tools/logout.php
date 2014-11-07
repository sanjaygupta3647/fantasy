<?php include("../lib/opin.inc.php");
session_destroy();
session_unset();
$cms->redir(SITE_PATH_ADM."login");
exit;
?>