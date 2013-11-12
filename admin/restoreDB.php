
<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>
<html>
<head>
<title>Firestone Locator | Database Restore</title>

</head>
<body>
<?php 

echo "<h1>Restoration Process</h1>\n";

db_backup($_POST["env"]);

db_restore("../sql-files/".$_POST["file"], $_POST["env"]);

?>
</body>


</html>
