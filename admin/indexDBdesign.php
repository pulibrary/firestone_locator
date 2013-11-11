<?php 

/*
 * 
 * indexDBdesign.php
 * Configures the basic structure of the floors - starting points, and access to individual 
 * points on the floors.
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

if ((isset($_GET["action"])) && ($_GET["action"] == "insertCallNumber")) {
	$insertSQL = sprintf("REPLACE INTO lctr_Coordinates_cn (id_cn, FloorDB_cn, floor_cn, BuildingCode_cn, Image_cn) VALUES (%d, %s, %s, %s, %s)",
			GetSQLValueString($_GET['id_cn'], "int"),
			GetSQLValueString($_GET['building'] . "_" . $_GET['floor'], "text"),
			GetSQLValueString($_GET['floor'], "text"),
			GetSQLValueString($_GET['building'], "text"),
			GetSQLValueString($_GET['image'], "text"));

	if ($result = $dbconnects["stage"]->query($insertSQL)) {
		$insertSuccess = "Inserting of new floor $_GET[floor] successful.";
	} else {
		$insertFailure = "New floor $_GET[floor] not added.  Reason: ".$dbconnects["stage"]->error;
	}
}

//mysql_select_db($database_Locator, $Locator);

if (isset($_GET["order"])) {
	$order = $_GET['order'];
} else {
	$order = "";
}
if ($order == "") {
	$query_rsAdminCallNum = "SELECT * FROM lctr_Coordinates_cn ORDER BY id_cn ASC";
}
else {
	$query_rsAdminCallNum = "SELECT * FROM lctr_Coordinates_cn ORDER BY $order ASC";
}

if ($rsAdminCallNum = $dbconnects["stage"]->query($query_rsAdminCallNum) ) {
	$row_rsAdminCallNum = $rsAdminCallNum->fetch_assoc();
	$totalRows_rsAdminCallNum = $rsAdminCallNum->num_rows;
} else {
	$rowFailure = "Error retrieving locator rows: ".$dbconnects["stage"]->error;
}
/* $rsAdminCallNum = mysql_query($query_rsAdminCallNum, $Locator) or die(mysql_error());
$row_rsAdminCallNum = mysql_fetch_assoc($rsAdminCallNum);
$totalRows_rsAdminCallNum = mysql_num_rows($rsAdminCallNum); */

?>

<!DOCTYPE html>
<html>
<head>
<title>Firestone Locator Admin | Floor Plans</title>
<?php styles(); ?>
<?php javascript_admin();?>
<script type="text/javascript">
$(document).ready(function() {
	$("a.itemout").colorbox();
});
</script>
</head>
<body>
	<?php page_header(); ?>
	<div class="content">
	<h2>Configure floor plans.</h2>
	<ul>
		<li>Floor DB: Indicate the name of the floor.</li>
		<li>Building: Indicate the name of the building.</li>
		<li>Image: Indicate the image name of the floorplan.</li>
		<li><em><strong>Note:</strong> Click on the floor database name to
				specify the designated starting point for all collections on that
				floor.</em></li>
		<li><em><strong>Note:</strong> Click on the image name to configure
				the floor grid database.</em></li>
		<li><i class="fa fa-edit" title="Update Entry"> </i>: to modify entry.</li>
		<li><i class="fa fa-trash-o" title="Delete Entry"> </i>: to delete entry.</li>
	</ul>
	<table width="100%" border="0" class="floor_table">
		<tr>
			<th colspan="2" width="100px">&nbsp;</th>
			<th class="topheader">
					<a href="indexDBdesign.php?order=FloorDB_cn">Floor</a>
			</th>
			<th class="topheader">
					<a href="indexDBdesign.php?order=BuildingCode_cn">Building</a>
			</th>
			<th class="topheader">
					<a href="indexDBdesign.php?order=Image_cn">Image</a>
			</th>
			<th class="topheader">
					<a href="indexDBdesign.php?order=date_cn">Last Modified</a>
			</th>
		</tr>

		<tr>
			<form action="indexDBdesign.php" method="post" name="InsertCallNum" id="InsertCallNum">
				<th colspan="2"><input name="id_cn" type="hidden"
					value="<?php if(isset($_GET["id_cn"])) echo $_GET['id_cn']; ?>" />
					<?php if (isset($_GET['edit_mode'])) echo "Edit mode"; else echo "Create Mode"; ?>
				</th>
				<td>
					<div align="center" class="input">
						<input name="floor" type="text" id="floor"
							value="<?php if(isset($_GET["a"])) echo $_GET['a']; ?>" size="6" />
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="building" type="text" id="building"
							value="<?php if(isset($_GET["b"])) echo $_GET['b']; ?>" size="6" />
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="image" type="text" id="image"
							value="<?php if(isset($_GET["c"])) echo $_GET['c']; ?>" size="20" />
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="Submit" type="submit"
							onClick="MM_validateForm('location','','R');return document.MM_returnValue"
							value="Submit" />
					</div>
				</td> <input type="hidden" name="action" value="insertCallNumber" />
			</form>
		</tr>



		<?php do { ?>
		<tr
		<?php if ($row_rsAdminCallNum['id_cn'] == $_GET['id_cn']) echo "style=\"background-color: orange\""?>>
			<td class="">&nbsp;</td>
			<td class="topbody"><a
				href="indexDBdesign.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;order=<?php echo $order; ?>&amp;site=lctr_Coordinates_cn&amp;return=indexDBdesign.php
          <?php
		echo "&edit_mode=true";
		echo "&a=" . $row_rsAdminCallNum['floor_cn'];
		echo "&b=" . $row_rsAdminCallNum['BuildingCode_cn'];
		echo "&c=" . $row_rsAdminCallNum['Image_cn'];
				
		?>"><i class="fa fa-edit" title="Update Entry"> </i> </a>
		<a
				href="deleteCN.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;order=<?php echo $order; ?>&amp;site=lctr_Coordinates_cn&amp;return=indexDBdesign.php">
					<i class="fa fa-trash-o" alt="Delete Entry"> </i>
			
			</td>



			<td class="topbody"><div align="center">
					<a class="itemout"
						href="setEndPoint.php?id=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;db=lctr_Coordinates_cn&amp;base=true"
						target="_blank"><?php echo $row_rsAdminCallNum['FloorDB_cn']; ?> </a>
				</div></td>

			<td class="topbody"><div align="center">
					<?php echo $row_rsAdminCallNum['BuildingCode_cn']; ?>
				</div></td>

			<td class="topbody"><div align="right">
					<a class="itemout"
						href="gridCreator.php?id=<?php echo $row_rsAdminCallNum['id_cn']; ?>"
						target="_blank"><?php echo $row_rsAdminCallNum['Image_cn']; ?> </a>

					<?php
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
					<i title="Image Missing" class="fa fa-warning-sign"> </i>
					<?php
					}
					?>

				</div></td>


			<td class="topbody"><div align="center">
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
	<?php page_footer();?>
</body>
</html>
