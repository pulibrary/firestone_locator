<?php
function styles() {
	?>
<link
	rel="stylesheet" href="../css/Font-Awesome/css/font-awesome.css">
<link
	rel="stylesheet" href="../css/themes/pulcore/stylesheets/styles.css">
<link rel="stylesheet"
	href="../css/locator.css">
<link rel="stylesheet"
	href="../css/colorbox.css">
<?php
}
function styles_public() {
	?>
<link
	rel="stylesheet" href="css/humanity/jquery-ui-1.8.11.custom.css"
	type="text/css" charset="utf-8">
<link
	rel="stylesheet" href="css/pagestyle.css" type="text/css"
	charset="utf-8">
<link
	rel="stylesheet" href="css/Font-Awesome/css/font-awesome.css">
<link
	rel="stylesheet" href="css/themes/pulcore/stylesheets/styles.css">
<link rel="stylesheet"
	href="css/locator.css">
<link rel="stylesheet"
	href="css/colorbox.css">
<?php
}
function javascript_admin() {
	?>
<script
	type="text/javascript" src="../js/swfobject.js"></script>
<script
	type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<script
	type="text/javascript" src="../js/colorbox/jquery.colorbox-min.js"></script>
<?php 
}
function javascript_public() {
	?>
<script
	type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script
	type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
<script
	type="text/javascript" src="js/astar.js"></script>
<script
	type="text/javascript" src="js/raphael-min.js"></script>
<script
	type="text/javascript" src="js/locator.js"></script>

<?php 


}
function page_header() {
	?>

<div class="header">
	<img src="../images/pul-logo.gif" alt="Library Logo" />
	<h1>Firestone Locator</h1>
</div>
<div id="nav">
	<ul class="level1">

		<li class="submenu">
			<div align="center">
				<a href="../admin/">Maintenance</a>
				<ul class="level2">
					<li><a href="indexExternal.php">External Locations </a></li>
					<li><a href="indexCollections.php">Designated Locations </a></li>
					<li><a href="indexOctavos.php">Octavos </a></li>
					<li><a href="indexOversize.php">Oversize </a></li>
					<li><a href="indexMessages.php">Index Card Messages </a></li>
				</ul>
			</div>
		</li>
		<li>
			<div align="center">
				<a href="indexDBdesign.php">Manage Maps</a>
			</div>
		</li>
		<li>
			<div align="center">
				<a href="indexUpdateDB.php">Manage Databases</a>
			</div>
		</li>
		<li>
			<div align="center">
				<a href="indexTest.php">Test Center</a>
			</div>
		</li>
		<li>
			<div align="center">
				<a href="log/logout.php">Logout </a>
			</div>
		</li>


	</ul>
</div>


<?php 
}

function page_footer() {
	?>
<div id="footer">
	&copy; 2005-
	<?php echo date("Y");?>.
 The Trustees of <a href="http://www.princeton.edu">Princeton University</a>.  All Rights Reserved.<br/>
 <a href="http://library.princeton.edu">Princeton University Library</a>
</div>
<?php 
}
?>

