<?php 
/*
 * indexCollections.php
 * 
 * Configures designated locations.
 * 
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
		$selectSQL = sprintf("SELECT * FROM lctr_Collections_cn WHERE id_cn=%s",
				GetSQLValueString($_POST["id_cn"], "int"));
	} else {
		$selectSQL = "SELECT * FROM lctr_Collections_cn ORDER BY date_cn DESC LIMIT 0,1";
	}
	$insertSQL = sprintf("REPLACE INTO lctr_Collections_cn (id_cn, left_cn, LocationDisplayName_cn, BuildingCode_cn, FloorDB_cn, LocationMap_cn, Image_cn, message_cn, x_point_cn, y_point_cn, date_cn) VALUES (%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW())",
			GetSQLValueString($_POST['id_cn'], "int"),
			GetSQLValueString($_POST['code'], "text"),
			GetSQLValueString($_POST['location_display'], "text"),
			GetSQLValueString($_POST['building'], "text"),
			GetSQLValueString($_POST['floordb'], "text"),
			GetSQLValueString($_POST['location'], "text"),
			GetSQLValueString($_POST['image'], "text"),
			GetSQLValueString($_POST['message'], "text"),
			GetSQLValueString($_POST['x_point_cn'], "int"),
			GetSQLValueString($_POST['y_point_cn'], "int"));
	if ($dbconnects["stage"]->query($insertSQL))  {
		if ($subResult = $dbconnects["stage"]->query($selectSQL)) {
			$subRecord = $subResult->fetch_assoc();
			$success = "<div class='response'>\n";	
			$success .= "<strong>Location Name:</strong>".$subRecord["LocationDisplayName_cn"]."<br/>\n";	
			$success .= "<strong>Range Added:</strong><br/>\n";
			$success .= "<blockquote><strong>Left CN:</strong> ".$subRecord["left_cn"]."<br/>\n";
			$success .= "<strong>Right CN:</strong> ".$subRecord["right_cn"]."<br/>\n";
			$success .= "</blockquote>\n";
			$success .= "<strong>Building:</strong> ".$subRecord["BuildingCode_cn"]."<br/>\n";
			$success .= "<strong>Location:</strong> ".$subRecord["LocationMap_cn"]."<br/>\n";
			$success .= "<strong>Image File:</strong> ".$subRecord["Image_cn"]."<br/>\n";
			$success .= "<strong>Floor:</strong> ".$subRecord["FloorDB_cn"]."<br/>\n";
			$success .= "<strong>Message:</strong> ".$subRecord["message_cn"]."<br/>\n";
			$success .= "</div>\n";
			
		} else {
			$error = $dbconnects["stage"]->error;
		}
	
	} else {
		$error = $dbconnects["stage"]->error;
	}
	
	
	/* $updateSQL = sprintf("UPDATE locator_production.lctr_Collections_cn SET message_cn = %s where id_cn = %s", GetSQLValueString($_POST['message'], "text"), GetSQLValueString($_POST['id_cn'], "int") );
	 mysql_query($updateSQL, $Locator) or die (mysql_error()); */

}

if (isset($_GET['order'])) {
	$order = $_GET['order'];
	$query_rsAdminCallNum = "SELECT * FROM lctr_Collections_cn ORDER BY $order ASC";
} else {
	$order="";
	$query_rsAdminCallNum = "SELECT * FROM lctr_Collections_cn ORDER BY LocationDisplayName_cn ASC";
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
<title>Firestone Locator | Designated Locations</title>
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
		<h2>Configure designated locations.</h2>
		<ul>
			<li>Code: Indicate location code of collection.</li>
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
			<li><i class="fa fa-edit" title="Update Entry"> </i>: to modify entry.</li>
			<li><i class="fa fa-trash-o" title="Delete Entry"> </i>: to delete entry.</li>
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
		<table width="100%" border="0" class="code_table table_striped" >
		<tbody>
		
			<tr>
				<th colspan="2" class="topheader">&nbsp</th>
				<th class="code">
						<a href="indexCollections.php?order=left_cn">Code</a>
				</th>
				<th class="location_display">
						<a href="indexCollections.php?order=LocationDisplayName_cn">Location
							Display</a>
				</th>

				<th class="building">
						<a href="indexCollections.php?order=BuildingCode_cn">Building </a>
				</th>
				<th class="floor">
						<a href="indexCollections.php?order=FloorDB_cn">Floor DB</a>
				</th>
				<th class="location_code">
						<a href="indexCollections.php?order=LocationMap_cn">Location</a>
				</th>
				<th class="floor_plan">
						<a href="indexCollections.php?order=Image_cn">Image</a>
				</th>
				<th class="message">
						<a href="indexCollections.php?order=message_cn">Message</a>
				</th>

				<th class="last_mod">
						<a href="indexCollections.php?order=date_cn">Last Modified</a>
				</th>
			</tr>
			<tr>
			<form action="indexCollections.php" method="post"
				name="InsertCallNum" id="InsertCallNum">
				<th colspan="2"><input name="id_cn" type="hidden"
					value="<?php if(isset($_GET["a"])) echo $_GET['id_cn']; ?>" /> <?php if (isset($_GET['edit_mode'])) echo "Edit mode"; else echo "Create Mode"; ?>
				</th>
				<td>
					<div align="center" class="input">
						<input name="code" type="text" id="code"
							value="<?php if(isset($_GET["a"])) echo $_GET['a']; ?>" size="6" />
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="location_display" type="text" id="location_display"
							value="<?php if(isset($_GET["b"])) echo $_GET['b']; ?>" size="40" />
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="building" type="text" id="building"
							value="<?php if(isset($_GET["c"])) echo $_GET['c']; ?>" size="3" />
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="floordb" type="text" id="floordb"
							value="<?php if(isset($_GET["d"])) echo $_GET['d']; ?>" size="3" />
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="location" type="text" id="location"
							value="<?php if(isset($_GET["e"])) echo $_GET['e']; ?>" size="6" />
					</div>
				</td>

				<td>

					<div align="left" class="input">
						<div align="center">
							<input name="image" type="text" id="image"
								value="<?php if(isset($_GET["f"])) echo $_GET['f'];?>" size="20">
						</div>
					</div>
				</td>


				<td class="input"><input name="message" type="text" id="message"
					value="<?php if(isset($_GET["g"])) echo $_GET['g']; ?>" size="35"></td>
				<td>
					<div align="center" class="input">
					<input type="hidden" name="site" id="site" value="lctr_Collections_cn" />
					<input name="x_point_cn" type="hidden" id="x_point_cn"
					value="<?php if(isset($_GET["h"])) echo $_GET['h']; else echo "0"; ?>" >
					<input name="y_point_cn" type="hidden" id="y_point_cn"
					value="<?php if(isset($_GET["i"])) echo $_GET['i']; else echo "0"; ?>" size="35">
						<input name="Submit" type="submit"
							onClick="MM_validateForm('location','','R');return document.MM_returnValue"
							value="Submit" />
					</div>
				</td> <input type="hidden" name="MM_insert" value="InsertCallNum" />
			</form>
			</tr>



			<?php do { ?>
			<tr
			<?php if ($row_rsAdminCallNum['id_cn'] == $_GET['id_cn']) echo "style=\"background-color: orange\""?>>
				<td class="">&nbsp;</td>
				<td class="topbody">
				<a
					href="indexCollections.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;site=lctr_Collections_cn<?php
				echo "&edit_mode=true";
		echo "&a=" . $row_rsAdminCallNum['left_cn'];
		echo "&b=" . $row_rsAdminCallNum['LocationDisplayName_cn'];
		echo "&c=" . $row_rsAdminCallNum['BuildingCode_cn'];
		echo "&d=" . $row_rsAdminCallNum['FloorDB_cn'];
		echo "&e=" . $row_rsAdminCallNum['LocationMap_cn'];
		echo "&f=" . $row_rsAdminCallNum['Image_cn'];
		echo "&g=" . $row_rsAdminCallNum['message_cn'];
		echo "&h=" . $row_rsAdminCallNum['x_point_cn'];
		echo "&i=" . $row_rsAdminCallNum['y_point_cn'];
		?>"><i class="fa fa-edit" title="Update Entry"> </i></a> 
				<a href="deleteCN.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;order=<?php echo $order;?>&amp;site=lctr_Collections_cn&amp;return=collections">
				<i class="fa fa-trash-o" title="Delete Entry"> </i></a></td>



				<td class="topbody"><div align="center">
						<?php echo $row_rsAdminCallNum['left_cn']; ?>
					</div></td>


				<td class="topbody">
					<div align="left">
						<?php echo $row_rsAdminCallNum['LocationDisplayName_cn']; ?>
						</a>
					</div>
				</td>


				<td class="topbody"><div align="center">
						<?php echo $row_rsAdminCallNum['BuildingCode_cn']; ?>
						</a>

					</div></td>


				<td class="topbody"><div align="center">
						<?php echo $row_rsAdminCallNum['FloorDB_cn']; ?>
					</div></td>

				<td class="topbody"><div align="center">
						<a
							class="itemout" href="setEndPoint.php?id=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;db=lctr_Collections_cn"
							target="_blank"><?php echo $row_rsAdminCallNum['LocationMap_cn']; ?>
						</a>
					</div></td>



				<td class="topbody">
					<div align="right">
						<?php echo $row_rsAdminCallNum['Image_cn']; 
						$image 		= $row_rsAdminCallNum['Image_cn'];
						$build_loc 	= $row_rsAdminCallNum['BuildingCode_cn'];
						$filename 	= "../images/stage/$build_loc/$image";
						if (file_exists($filename)) {
								
							?>
						<i title="Image Found" class="fa fa-check"> </i>
						<?php
						}
						else {
							?>
						<i title="Image Missing" class="fa fa-warning"> </i>
						<?php
						}
							?>
						</div>
				</td>
				<td class="topbody">
					<div align="left">
						&nbsp; &nbsp;

						<?php

						if   ($row_rsAdminCallNum['message_cn'] == "") echo "none";
						else echo $row_rsAdminCallNum['message_cn']; ?>
					</div>
					<div align="left"></div>
				</td>

				<td class="topbody"><div align="center">
						<?php echo $row_rsAdminCallNum['date_cn']; ?>
					</div>
				</td>
			</tr>
			<?php } while ($row_rsAdminCallNum = $rsAdminCallNum->fetch_assoc()); ?>
			</tbody>
		</table>
		<form action="" method="post" name="form1" id="form1">
			<input name="hiddenField" type="hidden"
				value="<?php echo $row_rsAdminCallNum['id_cn']; ?>" />
		</form>
	</div>
	<?php page_footer();?>
</body>

</html>
