<?php
/**
 * DB Config 
 * - Copy to db_config.php and configure the below information
 */
$hostname_Locator = "";
$hostname_Locator_production = ""; /* Production is the core server this data should send the data to*/
$username_Locator = "";
$password_Locator = "";
$port_Locator = "3306";
$db_settings["stagehost"] = $hostname_Locator;
$db_settings["productionhost"] = $hostname_Locator_production;
$db_settings["username"] = $username_Locator;
$db_settings["password"] = $password_Locator;
$db_settings["port"] = $port_Locator;
$db_tools["mysqldump"] = "/usr/local/mysql/bin/mysqldump";
$db_tools["mysql"] = "/usr/local/mysql/bin/mysql";
define("BASE_URL", "http://localhost/locator/"); // Needed for CAS, should reflect full correct url 

$dbconnects["stage"] = new mysqli($hostname_Locator, $username_Locator, $password_Locator, 'locator_stage', $port_Locator);
/* check connection */
if ($dbconnects["stage"]->connect_errno) {
	printf("Connect failed: %s\n", $dbconnects["stage"]->connect_error);
	exit();
}
$dbconnects["live"] = new mysqli($hostname_Locator, $username_Locator, $password_Locator, 'locator_live', $port_Locator);
if ($dbconnects["live"]->connect_errno) {
	printf("Connect failed: %s\n", $dbconnects["live"]->connect_error);
	exit();
}
$dbconnects["production"] = new mysqli($hostname_Locator_production, $username_Locator, $password_Locator, 'locator_production', $port_Locator);
if ($dbconnects["production"]->connect_errno) {
	printf("Connect failed: %s\n", $dbconnects["production"]->connect_error);
	exit();
}

if (isset($_GET["env"])&&$_GET["env"]=="stage") {
	$dbconnects["current"] = $dbconnects["stage"];
	$env = "stage";
} else {
	$dbconnects["current"] = $dbconnects["production"];
	$env = "production";	
}


include_once("db_functions.php");
?>