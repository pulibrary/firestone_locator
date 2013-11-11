<?php 
/*
 * indexMessages.php
*
* Configures Messages.  Is this needed anymore
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

if ( (isset($_POST["MM_insert"])) && ( ($_POST["MM_insert"] == "InsertM1")||($_POST["MM_insert"] == "InsertM2")||($_POST["MM_insert"] == "InsertM3"))) {

	// Set default values for different branch libraries here
	$id		 = trim($_POST['key']);
	$content = trim($_POST['content']);

	$insertSQL = "UPDATE lctr_Messages_cn SET content_cn = '$content' WHERE id_cn = '$id'";
	$selectSQL = "SELECT * from lctr_Messages_cn WHERE id_cn = '$id'";
	
	if ($reqResult = $dbconnects["stage"]->query($selectSQL) ) {
		$reqRecord = $reqResult->fetch_assoc();
		if ($dbconnects["stage"]->query($insertSQL)===FALSE) {
			$error = $dbconnects["stage"]->error;
		} else {
			$success = "<div class='response'><strong>Display When:</strong> ".$reqRecord["message_cn"]."<br/>\n";
			$success .= "<strong>Message Content:</strong> ".$reqRecord["content_cn"]."<br/>\n";
			$success .= "</div>\n";
		}

	} else {
		$error = $dbconnects["stage"]->error;
	}
}





?>
<!DOCTYPE html>
<html>
<head>
<title>Firestone Locator | Designated Locations</title>
<?php styles(); ?>
</head>
<body>
	<?php page_header(); ?>
	<div class="content">
		<h2>Configure branch library collections.</h2>

		<?php

		$message_var = array();
		$content_var = array();

		// Retreive information nec. for building map array
		$selectSQL = "SELECT * FROM lctr_Messages_cn";


		// Perform a query getting, identifying the connection
		if ($reqResult = $dbconnects["stage"]->query($selectSQL) ) {
			// Iterate through the results
			$num = 0;
			while ($row = $reqResult->fetch_assoc()) {
				$mess_var[$num] 	 = $row['message_cn'];
				$content_var[$num] = $row['content_cn'];			
				$num++;
			}
		} else {
			$error = $dbconnects["stage"]->error;
		}
		?>
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
	<ul>
		<li>Once updates are complete, make sure to click submit to save
			changes.</li>
		<li>Use: #floor to indicate the appropriate floor, #location to
			indicate the appropriate location, and #subject to display the
			subject infomation.
			<ul>
				<li>For example: Go to #floor Floor and navigate to #location:
					#subject = <em>Go to B Floor and navigate to B-7-E: Modern
						Languages and Literature.</em>
				</li>
			</ul>
		</li>
	</ul>
	<table width="100%" border="0" class="topic">
		<tr>
			<td class="topheader"><div align="center">Display When:</div></td>
			<td class="topheader"><div align="center">Message Content</div>
			</td>
			<td class="topheader"><p align="center">Submit</p></td>
		</tr>

		<tr>
			<form action="<?php echo $editFormAction; ?>" method="post"
				name="InsertM1" id="InsertM1">

				<td>

					<div class="input">
						<?php echo $mess_var[0]; ?>
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="content" type="text" id="content"
							value="<?php echo $content_var[0]; ?>" size="120" />
					</div>
				</td>

				<td><div aling="center" class="input">
						<input name="Submit1" type="submit" id="Submit1"
							onClick="MM_validateForm('start','','R');return document.MM_returnValue"
							value="Submit" /> <input name="key" type="hidden"
							id="hiddenField" value="1" />
				
				</td> <input type="hidden" name="MM_insert" value="InsertM1" />
			</form>
		</tr>



		<tr>
			<form action="<?php echo $editFormAction; ?>" method="post" name="InsertM3" id="InsertM3">

				<td>
					<div class="input">
						<?php echo $mess_var[2]; ?>
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="content" type="text" id="content"
							value="<?php echo $content_var[2]; ?>" size="120" />
					</div>
				</td>

				<td><div aling="center" class="input">
						<input name="Submit3" type="submit" id="Submit3"
							onClick="MM_validateForm('start','','R');return document.MM_returnValue"
							value="Submit" /> <input name="key" type="hidden" id="key"
							value="3" />
				
				</td> <input type="hidden" name="MM_insert" value="InsertM3" />
			</form>
		</tr>

		<tr>
			<form action="<?php echo $editFormAction; ?>" method="post"
				name="InsertM2" id="InsertM2">

				<td>
					<div class="input">
						<?php echo $mess_var[1]; ?>
					</div>
				</td>

				<td>
					<div align="center" class="input">
						<input name="content" type="text" id="content"
							value="<?php echo $content_var[1]; ?>" size="120" />
					</div>
				</td>

				<td><div aling="center" class="input">
						<input name="Submit2" type="submit"
							onClick="MM_validateForm('start','','R');return document.MM_returnValue"
							value="Submit" /> <input name="key" type="hidden" id="key"
							value="2" />
				
				</td> <input type="hidden" name="MM_insert" value="InsertM2" />
			</form>
		</tr>
	</table>
	<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd -->
</html>
