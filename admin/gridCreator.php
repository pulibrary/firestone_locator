<?php 

/*
 * 
 * gridCreator.php - Creates the coordinates for a floor plan.
 * 
 * Admin marks each coordinate as necessary and can position or zoom the plan.
 * The flash file for this action is flash/gridTool.swf and the original file is
 * flash/gridTool.fla
 * 
 */

?>

<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>
<?php 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Firestone Locator Admin | Set End Points</title>
<?php styles(); ?>
<?php javascript_admin(); ?>
</head>
<body>

<?php 

	page_header();
?>


<div class="content">
<h2>Set End Points</h2>
<?php
	$id   = $_GET['id'];
	
	// Retreive information nec. for building map array
	$sql = "SELECT * FROM lctr_Coordinates_cn WHERE id_cn = '$id'";

	if ($resSelect = $dbconnects["stage"]->query($sql) ) {
		while ($row = $resSelect->fetch_assoc()) {
			$grid    = $row['grid_crd'];
			$lc      = $row['BuildingCode_cn'];
			$image   = "../images/stage/f/".$row['Image_cn'];	
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
	
	?>
		
    <div id="displaycontent">
		<!-- Load image file is flash is not detected-->
		<img src="<?php  
			echo "$image"; 
			?>" usemap="#script" border="1">
		<br />
		The Firestone Item Locator project does not support your current Flash player. <br>	For best results, please update your flash plug-in <a href="http://www.adobe.com/products/flashplayer/"> here</a>. <br />				
</div>
    <p>
      <script type="text/javascript">
				
		// Load flash movie
		var fl = new SWFObject("flash/gridTool.swf", "grid Tool", "760", "640", "9", "#FFFFFF");
		
		fl.addVariable("id","<?php echo $id;?>");	
		fl.addVariable("lc","<?php echo $lc;?>");		
		fl.addVariable("imageFile","<?php echo $image;?>");
		
		fl.addVariable("start_x","<?php echo $start_x;?>");	
		fl.addVariable("start_y","<?php echo $start_y;?>");		

		fl.addVariable("shift_x","<?php echo $shift_x;?>");		
		fl.addVariable("shift_y","<?php echo $shift_y;?>");
		fl.addVariable("scale_x","<?php echo $scale_x;?>");		
		fl.addVariable("scale_y","<?php echo $scale_y;?>");
		
		fl.addVariable("gridXYstring","<?php echo $grid;?>");
		
		
		fl.write("displaycontent");
		
		
	  </script>
      
      <?php
      /** fl.addVariable("end_x","<?php echo $end_x;?>");
      fl.addVariable("end_y","<?php echo $end_y;?>"); **/
	
		
?>
</div>
<?php page_footer(); ?>
</body>
</html>