
<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>
<html>
<head>
<title>Firestone Locator | Backup on Demand</title>

</head>
<body>
<?php 

echo "<h1>Backup Process</h1>\n";

db_backup("stage");

?>
</body>


</html>
