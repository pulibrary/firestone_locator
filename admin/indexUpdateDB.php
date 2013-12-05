<?php 
/*
 * indexUpdateDB.php
*
* Updates Production DB
*
*
*/
?>

<?php include_once("../includes/locator.php"); ?>
<?php include_once('log/login.php'); ?>

<!DOCTYPE html>
<html>
<head>
<title>Firestone Locator | Update Database</title>
<?php styles(); ?>
<?php javascript_admin(); ?>
<script type="text/javascript">
$(document).ready(function() {
	$("#stage_sub").click(function () { 
	    $.post("restoreDB.php",        
	      $("#stage_form").serialize(),      
	      function(data){                
	        $.colorbox({
	          html:   data,
	          open:   true,
	          width: "600px",
	          height: "300px",
	          iframe: false            
	        });
	      },
	      "html");
	  });
	$("#prod_sub").click(function () { 
	    $.post("restoreDB.php",        
	      $("#prod_form").serialize(),      
	      function(data){                
	        $.colorbox({
	          html:   data,
	          open:   true,
	          width: "600px",
	          height: "300px",
	          iframe: false            
	        });
	      },
	      "html");
	  });

	$("input.deploy").click(function () { 
		
	    $.post("deployDB.php",       
	      $("#deploy_form").serialize(),      
	      function(data){                
	        $.colorbox({
	          html:   data,
	          open:   true,
	          width: "600px",
	          height: "400px",
	          iframe: false            
	        });
	      },
	      "html");
	  });
	$("input.backup").click(function () { 
		
	    $.post("backupDB.php",       
	      $("#backup_form").serialize(),      
	      function(data){                
	        $.colorbox({
	          html:   data,
	          open:   true,
	          width: "600px",
	          height: "400px",
	          iframe: false            
	        });
	      },
	      "html");
	  });
	  
});
</script>
</head>
<body>
	<?php page_header(); ?>

	<div class="content">
		<h2>Database Updates</h2>
		<h3>Backup on Demand</h3>
		<div class="indent">
			<p>Creates a backup of the stage environment..</p>
			<form action="#" id="backup_form">
				<input type="submit" value="Backup" class="backup btn" />
			</form>
		</div>
		<h3>Deploy to Production</h3>
		<div class="indent">
			<p>Deploy the current staging environment to production. Deploying
				will backup both environments before overwriting production.</p>
			<form action="#" id="deploy_form">
				<input type="submit" value="Deploy" class="deploy btn" />
			</form>
		</div>

		<h3>Restore Databases</h3>
		<?php 

		db_backuplist();

		?>

	</div>
	<?php page_footer();?>
</body>
</html>
