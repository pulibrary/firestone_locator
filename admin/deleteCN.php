<?php 

/*
 * 
 * deleteCN.php - Deletes a coordinate row from the database.
 * 	the site post variable actually is a table name, where the id_cn is a row id.
 * 
 * 
 */

?>

<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>

<?php


if (
		(isset($_GET['id_cn'])) && ($_GET['id_cn'] != "") &&
		(isset($_GET['site'])) && ($_GET['site'] != "")
) {
	$id	   = $_GET['id_cn'];
	$site	   = $_GET['site'];
	$selectSQL = sprintf("SELECT * FROM %s WHERE id_cn=%s",
			$site, GetSQLValueString($id, "int"));
	$deleteSQL = sprintf("DELETE FROM %s WHERE id_cn=%s",
			$site, GetSQLValueString($id, "int"));
	if ($reqResult = $dbconnects["stage"]->query($selectSQL) ) {
		$reqRecord = $reqResult->fetch_assoc();
		if ($dbconnects["stage"]->query($deleteSQL)===FALSE) {
			$error = $dbconnects["stage"]->error;
		} else {
			if ($site=="lctr_Collections_cn") {
				$success = "<div class='response'>\n";
				
				$success .= "<strong>Location Name:</strong>".$reqRecord["LocationDisplayName_cn"]."<br/>\n";
				
				$success .= "<strong>Range Deleted:</strong><br/>\n";
				$success .= "<blockquote><strong>Left CN:</strong> ".$reqRecord["left_cn"]."<br/>\n";
				$success .= "<strong>Building:</strong> ".$reqRecord["BuildingCode_cn"]."<br/>\n";
				$success .= "<strong>Location:</strong> ".$reqRecord["LocationMap_cn"]."<br/>\n";
				$success .= "<strong>Image File:</strong> ".$reqRecord["Image_cn"]."<br/>\n";
				$success .= "<strong>Floor:</strong> ".$reqRecord["FloorDB_cn"]."<br/>\n";
				$success .= "<strong>Message:</strong> ".$reqRecord["message_cn"]."<br/>\n";
				$success .= "</blockquote>\n";
				$success .= "</div>\n";
				
			} else if ($site=="lctr_Coordinates_cn") {
				$success = "<div class='response'><strong>Building:</strong> ".$reqRecord["BuildingCode_cn"]."<br/>\n";
				$success .= "<strong>Floor:</strong> ".$reqRecord["floor_cn"]."<br/>\n";
				print_r($reqRecord);
				
				$success .= "</div>\n";
			} else if ($site=="lctr_Oversize_cn"||$site=="lctr_Octavos_cn") {
				$success = "<div class='response'>\n";
				$success .= "<strong>Location Name:</strong>".$reqRecord["LocationDisplayName_cn"]."<br/>\n";
				$success .= "<strong>Range Deleted:</strong><br/>\n";
				$success .= "<blockquote><strong>Left CN:</strong> ".$reqRecord["left_cn"]."<br/>\n";
				$success .= "<strong>Right CN:</strong> ".$reqRecord["right_cn"]."<br/></blockquote>\n";
				$success .= "<strong>Building:</strong> ".$reqRecord["BuildingCode_cn"]."<br/>\n";
				$success .= "<strong>Location:</strong> ".$reqRecord["LocationMap_cn"]."<br/>\n";
				$success .= "<strong>Image File:</strong> ".$reqRecord["Image_cn"]."<br/>\n";
				$success .= "<strong>Floor:</strong> ".$reqRecord["FloorDB_cn"]."<br/>\n";
				$success .= "<strong>Message:</strong> ".$reqRecord["message_cn"]."<br/>\n";
				$success .= "</blockquote>\n";

				$success .= "</div>\n";
			} else if ($site=="lctr_External_cn") {
				$success = "<div class='response'><strong>Location:</strong> ".$reqRecord['LocationDisplayName_cn']."<br/>\n";
				$success .= "<strong>Location Code:</strong> ".$reqRecord['left_cn']."<br/>\n";
				$success .= "<strong>Message Display:</strong> ".$reqRecord['message_cn']."<br/>\n";
				$success .= "</div>\n";
			}
		}
		
	} else {
		$error = $dbconnects["stage"]->error;
	}
} else {
	$error = "Required variables not found, no action taken";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Firestone Locator Admin | Delete floor plan</title>
<?php styles(); ?>
<?php javascript_admin(); ?>
</head>

<body>
	<?php page_header();?>
	<div class="content">
	<?php 
		if (isset($error)) {
			echo "<div class='messages error'><h2>Delete Failed</h2>\n";
			echo "<div class='message'>\n";
			echo "<p>$error</p></div>\n";
		
			echo "</div>\n";
		
		} else if (isset($success)) {
			echo "<div class='messages status'><h2>Delete Successful</h2>\n";
			echo "<div class='message'>\n";
			echo "<p>$success</p>\n";
			echo "</div></div>\n";
		}
		if (isset($site)&&$site=="lctr_Coordinates_cn") {
			echo "<p><a href='indexDBdesign.php'>Return to Floor Plan Design</a></p>\n";
		} else if (isset($site)&&$site=="lctr_Collections_cn") {
			echo "<p><a href='indexCollections.php'>Return to Designated Locations</a></p>\n";
		} else if (isset($site)&&$site=="lctr_Octavos_cn") {
			echo "<p><a href='indexOctavos.php'>Return to Octavos Locations</a></p>\n";
		} else if (isset($site)&&$site=="lctr_Oversize_cn") {
			echo "<p><a href='indexOversize.php'>Return to Oversize Locations</a></p>\n";
		} else if (isset($site)&&$site=="lctr_External_cn") {
			echo "<p><a href='indexExternal.php'>Return to External Locations</a></p>\n";
		}
	?>	
	</div>

	<?php page_footer(); ?>
</body>
</html>
