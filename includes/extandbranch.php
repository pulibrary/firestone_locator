<?php function loadBranch(){	
	global $item;
	$image = "http://www.princeton.edu/~pumap/images/". $item->image . ".jpg";
	$ref = "http://www.princeton.edu/~pumap/buildings/" . $item->ref . ".png";
	?>
</p>

<table width="200" align="left">


	<TR>
		<TH colspan="2" class="inverse_field"><?php echo $item->info; ?>
		
		<TH rowspan="3"><img src="<?php echo $ref; ?>" />
	
	
	<TR>
		<TH valign="top"><img src="<?php echo $image; ?>" />
	
	
	<TR>
		<TH valign="bottom"><a href="<?php echo $item->site; ?>">Access campus
				library website</a><br /> <a href="http://library/libraries/map.php">View
				map of campus libraries</a><br /> <br />

</TABLE>
<?php }
// Load page, with links and site for externally located items-----------------------------------
function loadExternal() {

	global $item;


	?>
<table class="item_table" align="left">
	<tr>
		<td width="400" valign="top"><div id="info">
				<?php echo $item->info; ?>
			</div></td>
	</tr>
	<tr>
		<td valign="top"><?php
		if ($item->site != "" ) {
			$item->site = $item->site . $item->id;
			?>
			<h2>
				<a href="<?php echo $item->site;?>">Request Item</a>
			</h2> <?php
		}
		?>
		</td>
	</tr>
</table>

<?php		

}
?>