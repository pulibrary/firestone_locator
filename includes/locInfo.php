<?php
$url = "http://libweb5.princeton.edu/LocInfo/locinfo.aspx?loc=" . $_GET['loc'];
echo file_get_contents($url);
?>
