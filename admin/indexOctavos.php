<?php

/*
 *
* indexOctavos - configures standard call number ranges, relating to floor plan sections
*
*/

?>
<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
	$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "InsertCallNum")) {
	if (isset($_POST["id_cn"])&&$_POST["id_cn"]!="") {
		$selectSQL = sprintf("SELECT * FROM lctr_Octavos_cn WHERE id_cn=%s",
				GetSQLValueString($_POST["id_cn"], "int"));
		$x_point_cn = GetSQLValueString($_POST['x_point_cn'], "int");
		$y_point_cn = GetSQLValueString($_POST['y_point_cn'], "int");
	} else {
		$x_point_cn = 0;
		$y_point_cn = 0;
		$selectSQL = "SELECT * FROM lctr_Octavos_cn ORDER BY date_cn DESC LIMIT 0,1";
	}

	$insertSQL = sprintf("REPLACE INTO lctr_Octavos_cn (id_cn, left_cn, right_cn, LocationDisplayName_cn,  BuildingCode_cn, FloorDB_cn, LocationMap_cn, Image_cn, message_cn, x_point_cn, y_point_cn, date_cn) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, $x_point_cn, $y_point_cn, NOW())",
			GetSQLValueString($_POST['id_cn'], "int"),
			GetSQLValueString($_POST['left'], "text"),
			GetSQLValueString($_POST['right'], "text"),
			GetSQLValueString($_POST['location_display'], "text"),
			GetSQLValueString($_POST['building'], "text"),
			GetSQLValueString($_POST['floordb'], "text"),
			GetSQLValueString($_POST['location'], "text"),
			GetSQLValueString($_POST['image'], "text"),
			GetSQLValueString($_POST['message'], "text"));

	if ($dbconnects["stage"]->query($insertSQL) ) {
		$subResult = $dbconnects["stage"]->query($selectSQL);
		$subRecord = $subResult->fetch_assoc();
		$success = "<div class='response'>\n";
		$success .= "<strong>Location Name:</strong>".$subRecord["LocationDisplayName_cn"]."<br/>\n";
		$success .= "<strong>Range Deleted:</strong><br/>\n";
		$success .= "<blockquote><strong>Left CN:</strong> ".$subRecord["left_cn"]."<br/>\n";
		$success .= "<strong>Right CN:</strong> ".$subRecord["right_cn"]."<br/></blockquote>\n";
		$success .= "<strong>Building:</strong> ".$subRecord["BuildingCode_cn"]."<br/>\n";
		$success .= "<strong>Location:</strong> ".$subRecord["LocationMap_cn"]."<br/>\n";
		$success .= "<strong>Image File:</strong> ".$subRecord["Image_cn"]."<br/>\n";
		$success .= "<strong>Floor:</strong> ".$subRecord["FloorDB_cn"]."<br/>\n";
		$success .= "<strong>Message:</strong> ".$subRecord["message_cn"]."<br/>\n";
		$success .= "</div>\n";
	} else {
		$error = $dbconnects["stage"]->error;
	}

} else if (isset($_GET['id_cn'])&&$_GET["id_cn"]!=""&&$_GET["edit_mode"]) {
	$selectSQL = sprintf("SELECT * FROM lctr_Octavos_cn WHERE id_cn=%s",
			GetSQLValueString($_GET["id_cn"], "int"));
	$reqResult = $dbconnects["stage"]->query($selectSQL);
	$reqRecord = $reqResult->fetch_assoc();
}

if (isset($_GET['order'])&&$_GET["order"]!="") {
	$order = $_GET['order'];
	$query_rsAdminCallNum = "SELECT * FROM lctr_Octavos_cn ORDER BY $order ASC";
} else {
	$order="";
	$query_rsAdminCallNum = "SELECT * FROM lctr_Octavos_cn ORDER BY left_cn ASC";
}

if ($rsAdminCallNum = $dbconnects["stage"]->query($query_rsAdminCallNum) ) {
	$row_rsAdminCallNum = $rsAdminCallNum->fetch_assoc();
	$totalRows_rsAdminCallNum = $rsAdminCallNum->num_rows;
} else {
	$error = "Error retrieving locator rows: ".$dbconnects["stage"]->error;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Firestone Locator | Octavos Locations</title>
<?php styles(); ?>
<?php javascript_admin(); ?>

<script type="text/javascript">
$(document).ready(function() {
	$("a.itemout").colorbox();
});
</script>
</head>
<body>
	<?php page_header(); ?>
	<div class="content">
		<h2>Configure octavos collection.</h2>
		<ul>
			<li>Left Endpoint: Set low end of range to include.</li>
			<li>Right Endpoint: Set high end of range to include.</li>
			<li>Location Display: Give brief description pertaining to collection
				that will be appended to index card.</li>
			<li>Building: Indicate in which building the collection resides.</li>
			<li>Floor DB: Indicate the floor database mapped to this collection's
				location (<em>Each floor is mapped to a grid, displayed under
					&quot;Manage Maps&quot;).</em>
			</li>
			<li>Message: Include a brief message that will be appended to the end
				of the index card.</li>
			<li>Location: Indicate location of collection (<em>coordinates code</em>).
				Once inputed, click link to specify end point on map.
			</li>
			<li>Image: Specify name given to image that displays location of this
				collection.</li>
			<li><i class="fa fa-edit" title="Update Entry"> </i>: to modify
				entry.</li>
			<li><i class="fa fa-trash-o" title="Delete Entry"> </i>: to delete
				entry.</li>
		</ul>
		<?php 

		if (isset($error)) {
			echo "<div class='messages error'><h2>Update Failed</h2>\n";
			echo "<div class='message'>\n";
			echo "<p>$error</p></div>\n";

			echo "</div>\n";

		} else if (isset($success)) {
			echo "<div class='messages status'><h2>Update Successful</h2>\n";
			echo "<div class='message'>\n";
			echo "<p>$success</p>\n";
			echo "</div></div>\n";
		}

		?>
		<table width="100%" border="0" class="code_table">
			<tr>
				<th colspan="2">&nbsp;</th>
				<th><a href="indexOctavos.php?order=left_cn">Left Endpoint </a>
				</th>
				<th><a href="indexOctavos.php?order=right_cn">Right Endpoint</a>
				</th>
				<th><a href="indexOctavos.php?order=LocationDisplayName_cn">Location
						Display</a>
				</th>
				<th><a href="indexOctavos.php?order=BuildingCode_cn">Building</a>
				</th>
				<th><a href="indexOctavos.php?order=FloorDB_cn">Floor DB</a>
				</th>
				<th><a href="indexOctavos.php?order=LocationMap_cn">Location</a>
				</th>
				<th><a href="indexOctavos.php?order=Image_cn">Image</a>
				</th>
				<th><a href="indexOctavos.php?order=message_cn">Message</a>
				</th>
				<th><a href="indexOctavos.php?order=date_cn">Last Modified</a>
				</th>
			</tr>

			<tr>
				<form action="indexOctavos.php" method="post" name="InsertCallNum"
					id="InsertCallNum">

					<th colspan="2"><input name="id_cn" type="hidden"
						value="<?php if (isset($reqRecord['id_cn'])) echo $reqRecord['id_cn']; ?>" />
						<?php if (isset($mode)&&$mode="edit") echo "Edit mode"; else echo "Create Mode"; ?>
					</th>
					<td>
						<div align="center" class="input">

							<input name="left" type="text" id="left"
								value="<?php if (isset($reqRecord['left_cn'])) echo $reqRecord['left_cn']; ?>"
								size="10" />
						</div>
					</td>

					<td>
						<div align="center" class="input">
							<input name="right" type="text" id="right"
								value="<?php if (isset($reqRecord['right_cn'])) echo $reqRecord['right_cn']; ?>"
								size="10" />
						</div>
					</td>

					<td>
						<div align="center" class="input">
							<input name="location_display" type="text" id="location_display"
								value="<?php if (isset($reqRecord['LocationDisplayName_cn'])) echo $reqRecord['LocationDisplayName_cn']; ?>"
								size="40" />
						</div>
					</td>

					<td>
						<div align="center" class="input">
							<input name="building" type="text" id="building"
								value="<?php if (isset($reqRecord['BuildingCode_cn'])) echo $reqRecord['BuildingCode_cn']; ?>"
								size="3" />
						</div>
					</td>

					<td>
						<div align="center" class="input">
							<input name="floordb" type="text" id="floordb"
								value="<?php if (isset($reqRecord['FloorDB_cn'])) echo $reqRecord['FloorDB_cn']; ?>"
								size="3" />
						</div>
					</td>

					<td>
						<div align="center" class="input">
							<input name="location" type="text" id="location"
								value="<?php if (isset($reqRecord['LocationMap_cn'])) echo $reqRecord['LocationMap_cn']; ?>"
								size="6" />
						</div>
					</td>

					<td>

						<div align="left" class="input">

							<input name="image" type="text" id="image"
								value="<?php if (isset($reqRecord['Image_cn'])) echo $reqRecord['Image_cn']; ?>"
								size="20">
						</div>
					</td>


					<td class="input"><textarea name="message" id="message"
					rows="4" maxlength="1000" cols="60"><?php if (isset($reqRecord['message_cn'])) echo $reqRecord['message_cn']; ?></textarea></td>
					<td>
						<div align="center" class="input">
							<input name="x_point_cn" type="hidden" id="x_point_cn"
						value="<?php if(isset($reqRecord["x_point_cn"])) echo $reqRecord['x_point_cn']; else echo "0";?>" >
						<input name="y_point_cn" type="hidden" id="y_point_cn"
						value="<?php if(isset($reqRecord["y_point_cn"])) echo $reqRecord['y_point_cn']; else echo "0"; ?>" size="35">
							<input name="Submit" type="submit"
								onClick="MM_validateForm('location','','R');return document.MM_returnValue"
								value="Submit" />
						</div>
					</td> <input type="hidden" name="MM_insert" value="InsertCallNum" />
				</form>
			</tr>



			<?php do { ?>
			<tr
			<?php if (isset($_GET['id_cn']) && $row_rsAdminCallNum['id_cn'] == $_GET['id_cn']) echo "class='edit_row'"?>>
				<td colspan="2"><a
					href="indexOctavos.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;order=<?php echo $order; ?>&amp;site=lctr_Octavos_cn&amp;return=../indexOctavos.php&amp;edit_mode=true"><i
						class="fa fa-edit" title="Update Entry"> </i> </a> <a
					href="deleteCN.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;order=<?php echo $order; ?>&amp;site=lctr_Octavos_cn&amp;return=../indexOctavos.php"><i
						class="fa fa-trash-o" title="Delete Entry"> </i> </a>
				</td>
				<td><div align="center">
						<?php echo str_replace(" ","&nbsp;",$row_rsAdminCallNum['left_cn']); ?>
					</div></td>


				<td><div align="center">
						<?php echo str_replace(" ","&nbsp;",$row_rsAdminCallNum['right_cn']); ?>
						</a>

					</div></td>


				<td>
					<div align="left">
						<?php echo $row_rsAdminCallNum['LocationDisplayName_cn']; ?>
						</a>
					</div>
				</td>
				<td><div align="center">
						<?php echo $row_rsAdminCallNum['BuildingCode_cn']; ?>
						</a>

					</div></td>

				<td><div align="center">
						<?php echo $row_rsAdminCallNum['FloorDB_cn']; ?>

					</div></td>

				<td><div align="center">
						<a class="itemout"
							href="setEndPoint.php?id=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;db=lctr_Octavos_cn"
							target="_blank"><?php echo $row_rsAdminCallNum['LocationMap_cn']; ?>
						</a>
												<?php 
							if ($row_rsAdminCallNum["x_point_cn"]==0||$row_rsAdminCallNum["y_point_cn"]==0) {
								?>
							<i title="Start Point Not Defined" class="fa fa-warning"> </i>
							<?php								
							}	
						?>
					</div></td>


				<td>
					<div align="right">
						<?php echo $row_rsAdminCallNum['Image_cn']; 
						$image 		= $row_rsAdminCallNum['Image_cn'];
						$build_loc 	= $row_rsAdminCallNum['BuildingCode_cn'];
						$filename 	= "../images/stage/$build_loc/".trim($image);
						
						if (!file_exists($filename)) {
							?>
						<i title="Image Missing" class="fa fa-warning"> </i>
						<?php
						}
						?>
					</div>

				</td>
				<td><div align="left">
						&nbsp &nbsp
						<?php

						if   ($row_rsAdminCallNum['message_cn'] == "") echo "none";
					else echo $row_rsAdminCallNum['message_cn']; ?>
					</div>
					<div align="left"></div></td>

				<td><div align="center">
						<?php echo $row_rsAdminCallNum['date_cn']; ?>
					</div>
				</td>
			</tr>
			<?php } while ($row_rsAdminCallNum = $rsAdminCallNum->fetch_assoc()); ?>
		</table>
		<form action="" method="post" name="form1" id="form1">
			<input name="hiddenField" type="hidden"
				value="<?php echo $row_rsAdminCallNum['id_cn']; ?>" />
		</form>
	</div>
	<?php page_footer(); ?>
</body>
</html>
