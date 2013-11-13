<?php
include_once('../../includes/cas/CAS.php');
phpCAS::setDebug("/tmp/cas.log");
phpCAS::client(CAS_VERSION_2_0,'fed.princeton.edu',443,'cas');
phpCAS::forceAuthentication();
if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
}


$loginUsername= phpCAS::getUser();
//$loginUsername = "abarrera";

#mysql_select_db($database_Locator, $Locator);

$LoginRS__query=sprintf("SELECT username_usr, level_usr FROM lctr_User_usr WHERE username_usr='%s'",
		get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername));

$LoginRS = $dbconnects["stage"]->query($LoginRS__query) or die(mysql_error());
$loginFoundUser = $LoginRS->num_rows;
if (!$loginFoundUser) {
	header("Location: denied.php");
}

?>
