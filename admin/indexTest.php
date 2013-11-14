<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>
<?php 

/*
 *
* Entry Page, contains help information as well.
*
*/

?>

<!DOCTYPE html>
<html>
<head>

<title>Firestone Locator | Test Center</title>
<?php styles(); ?>
<?php javascript_admin(); ?>
</head>
<body>
	<?php page_header(); ?>
	<div class="content">
		<h2>Floor Plan Testing</h2>
		<p>Enter bib id and location code.</p>
		<form action="../index.php" method="get" name="testBIB" id="testBIB">

			<table width="60%" border="0" class="topic">
				<tr>
					<th>BIB ID</th>
					<th>Location Code</th>
					<th colspan="2">Environment</th>
					<th colspan="2">Catalog</th>

					<th><p align="center">&nbsp;</p>
					</th>
				</tr>

				<tr>

					<td><input name="id" type="text" id="id" size="40" />
					</td>

					<td><input name="loc" type="text" id="loc" size="10" />
					</td>
					<td>Stage<br />Production
					</td>
					<td><input name="env" type="radio" id="env" value='stage'
						checked='checked' /><br /> <input name="env" type="radio" id="env"
						value='production' />
					</td>
					<td>Production<br />Test
					</td>
					<td><input name="catalog" type="radio" id="catalog"
						value='production' checked='checked' /><br /> <input
						name="catalog" type="radio" id="catalog" value='test' />
					</td>
					<td>
						<div align="center" class="input">
							<input name="Submit" type="submit" value="Test!" />
						</div>
					</td>
			
			</table>
		</form>
	</div>
	<?php page_footer();?>
</body>
</html>
