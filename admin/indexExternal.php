<?php 

/*
 * 
 * indexExternal
 * 
 * Configures information about locations external to Firestone. - May not be needed.
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

	// Set default values for different branch libraries here
	$website = trim($_POST['site']);
	$check1  = "recap";
	$check2  = "none";

	if (strcmp($website, $check1) == 0) {
		$val1 = "http://libweb5.princeton.edu/recap/getrecord.aspx?xsl=recapForm.xslt&bbid=";
	}

	if (strcmp($website, $check2) == 0) {
		$val1 = "";
	}

	$insertSQL = sprintf("REPLACE INTO lctr_External_cn (id_cn, LocationDisplayName_cn, left_cn, site_cn, message_cn) VALUES (%d, %s, %s, %s, %s)",
			GetSQLValueString($_POST['id_cn'], "int"),
			GetSQLValueString($_POST['display_name'], "text"),
			GetSQLValueString($_POST['location_code'], "text"),
			GetSQLValueString($val1, "text"),
			GetSQLValueString($_POST['message'], "text"));
	
	if ($dbconnects["stage"]->query($insertSQL)===FALSE) {
		$error = $dbconnects["stage"]->error;
	} else {
		$success = "<div class='response'><strong>Location:</strong> ".$_POST['display_name']."<br/>\n";
		$success .= "<strong>Location Code:</strong> ".$_POST['location_Code']."<br/>\n";
		$success .= "<strong>Message Display:</strong> ".$_POST['message']."<br/>\n";
		$success .= "</div>\n";
	}
}
if (isset($_GET["order"])&&$_GET["order"]!="") {
	$order = $_GET['order'];
	$query_rsAdminCallNum = "SELECT * FROM lctr_External_cn ORDER BY $order ASC";
} else {
	$order = "";
	$query_rsAdminCallNum = "SELECT * FROM lctr_External_cn ORDER BY left_cn ASC";
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
<title>Firestone Locator | External Locations</title>
<?php styles(); ?>
</head>
<body>
	<?php page_header(); ?>
	<div class="content">
		<h2>Configure external locations.</h2>
		<ul>
			<li>Location Code: Indicate location code of collection.</li>
			<li>Website: Indicate a website link to be included with item's
				information (<em>for recap items, the link is automatically
					generated for specific item)</em>.
			</li>
			<li>Message: Include a brief message that will be appended to the end
				of the index card.</li>
			<li><em><strong>Note:</strong> </em><em> Refer to
					admin/indexExternal.php to modify stored recap link creation.</em>
			</li>
			<li><i class="fa fa-edit" title="Update Entry"> </i>: to modify entry.</li>
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
				<th class="" colspan="2">&nbsp;</th>
				<th class="display_name">
					<a href="indexExternal.php?order=LocationDisplayName_cn">Display Name</a>
				</th>
				
				<th class="code">
				<a href="indexExternal.php?order=left_cn">Code</a>
				</th>

				<th class="sitelink"><a href="indexExternal.php?order=site_cn">Website Link</a>
				</th>
				<th class="message"><a href="indexExternal.php?order=message_cn">Message</a>
				</th>

				<th class="last_mod"><a href="indexExternal.php?order=date_cn">Last
						Modified</a>
				</th>
			</tr>

			<tr>
				<form action="indexExternal.php" method="post" name="InsertCallNum"
					id="InsertCallNum">
					<th colspan="2"><input name="id_cn" type="hidden"
						value="<?php if(isset($_GET["a"])) echo $_GET['id_cn']; ?>" /> <?php if (isset($_GET['edit_mode'])) echo "Edit mode"; else echo "Create Mode"; ?>
					</th>
					<td>
						<div align="center" class="input">
							<input name="display_name" type="text" id="display_name"
								value="<?php if(isset($_GET['display_name'])) echo $_GET['display_name']; ?>"
								size="20" />
						</div>
					</td>
					<td>
						<div align="center" class="input">
							<input name="location_code" type="text" id="location_code"
								value="<?php if(isset($_GET['a'])) echo $_GET['a']; ?>"
								size="10" />
						</div>
					</td>

					<td>
						<div align="center" class="input">
							<label> <select name="site" id="site">
									<option value="recap" selected>recap</option>
									<option value="none"></option>
							</select>
							</label>
						</div>
					</td>

					<td>

						<div align="left" class="input">
							<div align="center">
								<textarea name="message" id="message"
					rows="4" maxlength="1000" cols="100"><?php if(isset($_GET["c"])) echo $_GET['c']; ?></textarea>
							</div>
						</div>
					</td>

					<td>
						<div align="center" class="input">
							<input name="Submit2" type="submit"
								onClick="MM_validateForm('start','','R');return document.MM_returnValue"
								value="Submit" />
						</div>
					</td> <input type="hidden" name="MM_insert" value="InsertCallNum" />
				</form>
			</tr>









			<?php do { ?>
			<tr
			<?php if (isset($_GET['id_cn'])&&$row_rsAdminCallNum['id_cn'] == $_GET['id_cn']) echo "class='edit_row'"?>>
				<td class="">&nbsp;</td>

				<td class="topbody"><a
					href="indexExternal.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;order=<?php echo $order; ?>&amp;site=lctr_External_cn&amp;return=../indexExternal.php
					<?php
					echo "&edit_mode=true";
					echo "&a=" . $row_rsAdminCallNum['left_cn'];
					echo "&b=" . $row_rsAdminCallNum['site_cn'];
					echo "&c=" . $row_rsAdminCallNum['message_cn'];
				?>"> <i class="fa fa-edit" title="Update Entry"> </i>
				</a> <a
					href="deleteCN.php?id_cn=<?php echo $row_rsAdminCallNum['id_cn']; ?>&amp;order=<?php echo $order; ?>&amp;site=lctr_External_cn&amp;return=../indexExternal.php">
						<i class="fa fa-trash-o" title="Delete Entry"> </i>
				</a>
				</td>

				<td class="topbody"><?php echo $row_rsAdminCallNum['LocationDisplayName_cn']; ?>
				</td>
				<td class="topbody"><?php echo $row_rsAdminCallNum['left_cn']; ?>
				</td>



				<td class="topbody"><?php if ($row_rsAdminCallNum['site_cn'] == "") echo "none"; 
				else echo substr($row_rsAdminCallNum['site_cn'], 0, 30) . "...";
					
				?></td>
				<td class="topbody"><?php

				if   ($row_rsAdminCallNum['message_cn'] == "") echo "none";
				else echo $row_rsAdminCallNum['message_cn']; ?></td>
				<td class="topbody"><?php echo $row_rsAdminCallNum['date_cn']; ?>
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
