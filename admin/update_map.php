<?php 

require_once('../includes/db_config.php');

/**	update_map.php - connects to stage database and updates the accessibility of each x and y coordinates of the given floor
 * receives data from gridTool.swf
 * returns either the success or fail message based on either mysql_query or $_GET variables
 */

if (isset($_GET["id"]) && isset($_GET["db"]) && isset($_GET["shift_x"]) && isset($_GET["shift_y"]) && isset($_GET["scale_x"]) && isset($_GET["scale_y"])) {
	$id = $_GET['id'];	$db = $_GET['db'];	
	$shift_x  = $_GET['shift_x'];	$shift_y  = $_GET['shift_y'];
	$scale_x  = $_GET['scale_x'];	$scale_y  = $_GET['scale_y'];
	
	$chunk  = str_split($db);
	$decode = "";
	
	for ($i = 0; $i < sizeof($chunk); $i++) {
	
		$a = $chunk[$i++];
		$b = $chunk[$i];
	
		for ($j = 0; $j < $b; $j++)
			$decode .= $a . ",";
	}
	
	$sql = "UPDATE lctr_Coordinates_cn SET x_shift_cn = '$shift_x', y_shift_cn = '$shift_y', x_scale_cn = '$scale_x', y_scale_cn = '$scale_y', grid_crd = '$decode', date_cn=NOW() WHERE id_cn = '$id'";
	$dbconnects["stage"]->query($sql) or $errorResponse=$dbconnects["stage"]->error;
} else {
	$errorResponse="Expected variables were not sent.";
}

if (isset($errorResponse)) {
	echo "locResponse=$errorResponse";
} else {
	echo "locResponse=Floor coordinates updated successfully.";
}

exit;
?>
