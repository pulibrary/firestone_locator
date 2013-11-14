<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>
<?php 

/**
 * 
 * setEndPoint - Establishes the start point for the path.  This is typically near an elevator or 
 * staircase and allows the drawing of a path to an item from there.
 *
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Firestone Locator Admin | Set End Points</title>
<?php styles(); ?>
<?php javascript_admin(); ?>
</head>
<body>

	<div class="content">
		<?php 

		if(isset($_GET['id'])) { $id   = $_GET['id']; }
		if(isset($_GET['db'])) { $db   = $_GET['db']; }
		if(isset($_GET['base'])) {	$base   = $_GET['base']; } else { $base=""; }


		// Retreive information nec. for building map array
		$sql = "SELECT * FROM $db WHERE id_cn = '$id'";
		if ($resSelect = $dbconnects["stage"]->query($sql) ) {
			while ($row = $resSelect->fetch_assoc()) {
				$fldb   = $row['FloorDB_cn'];
				$image  = "../images/stage/f/".$row['Image_cn'];
				$end_x  = $row['x_point_cn'];
				$end_y  = $row['y_point_cn'];				
			}
			// Retreive information nec. for building map array
			$sql = "SELECT * FROM lctr_Coordinates_cn WHERE FloorDB_cn = '$fldb'";
			if ($resSelect = $dbconnects["stage"]->query($sql) ) {
				while ($row = $resSelect->fetch_assoc()) {
					$grid    = $row['grid_crd'];
					$lc      = $row['BuildingCode_cn'];
					$image_b = "../images/stage/f/".$row['Image_cn'];
					$scale_x = $row['x_scale_cn'];
					$scale_y = $row['y_scale_cn'];
					$shift_x = $row['x_shift_cn'];
					$shift_y = $row['y_shift_cn'];
					$start_x = $row['x_point_cn'];
					$start_y = $row['y_point_cn'];					
				}
			} else {
				$rowFailure = "Error retrieving locator rows: ".$dbconnects["stage"]->error;
			}
		} else {
			$rowFailure = "Error retrieving locator rows: ".$dbconnects["stage"]->error;
		}

		?>
	<ul>
		<li>Click and drag green dot to set endpoint! (Dot turns red if
			location not accessible to patrons).</li>
	</ul>
	<div id="displaycontent">
		<!-- Load image file is flash is not detected-->

		<p><IMG SRC="<?php  
			echo "$image"; 
			?>" usemap="#script"
			BORDER=1> <br /> The Firestone Item Locator project does not support
		your current Flash player. <br> For best results, please update your
		flash plug-in <a href="http://www.adobe.com/products/flashplayer/">
			here</a>. </p>
	</div>
		<script type="text/javascript">
				
		// Load flash movie
		var fl = new SWFObject("flash/setPoints.swf", "Set Points", "760", "640", "9", "#FFFFFF");
		
		fl.addVariable("id","<?php echo $id;?>");	
		fl.addVariable("db","<?php echo $db;?>");	
		
		fl.addVariable("lc","<?php echo $lc;?>");		
		fl.addVariable("imageFile","<?php echo $image;?>");
		
		fl.addVariable("base","<?php echo $base;?>");
		fl.addVariable("baseFile","<?php echo $image_b;?>");
		
		fl.addVariable("start_x","<?php echo $start_x;?>");	
		fl.addVariable("start_y","<?php echo $start_y;?>");		
		fl.addVariable("end_x","<?php echo $end_x;?>");
		fl.addVariable("end_y","<?php echo $end_y;?>");	
		fl.addVariable("shift_x","<?php echo $shift_x;?>");		
		fl.addVariable("shift_y","<?php echo $shift_y;?>");
		fl.addVariable("scale_x","<?php echo $scale_x;?>");		
		fl.addVariable("scale_y","<?php echo $scale_y;?>");
	
		fl.addVariable("gridXYstring","<?php echo $grid;?>");
		
		
		fl.write("displaycontent");
		
		
	  </script>

</div>

</body>
</html>