<?php 

require_once('../includes/db_config.php');

/**	update_point.php - connects to stage database and updates the x and y coordinates of the given floor
 * receives data from setPoints.swf
 * returns either the success or fail message based on either mysql_query or $_GET variables
 */

if (isset($_GET['id'])&&isset($_GET['db'])&&isset($_GET['x_point'])&&isset($_GET['y_point'])) {
	$id = $_GET['id'];
	$db = $_GET['db'];
	$x  = $_GET['x_point'];
	$y  = $_GET['y_point'];
	$sql = "UPDATE $db SET x_point_cn = $x, date_cn=NOW() WHERE id_cn = '$id' ";
	$dbconnects["stage"]->query($sql) or $errorResponse=$dbconnects["stage"]->error;
	
	$sql = "UPDATE $db SET y_point_cn = $y, date_cn=NOW() WHERE id_cn = '$id'";
	$dbconnects["stage"]->query($sql) or $errorResponse=$dbconnects["stage"]->error;
} else {
	$errorResponse="Expected variables were not sent.";
}
if (isset($errorResponse)) {
	echo "locResponse=$errorResponse";
} else {
	echo "locResponse=Floor updated successfully.";
}

exit;
?>