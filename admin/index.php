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

<title>Firestone Locator Admin</title>
<?php styles(); ?>
<?php javascript_admin(); ?>
</head>
<body>
	<?php page_header(); ?>
	<div class="content">


		<h2>Locator Guide</h2>

		<p>Hi! Welcome to the Item Locator project&rsquo;s administration
			website. This guide has been written to give you a brief introduction
			to the system, and should help answer any questions you may have
			regarding the general upkeep of the program.Let&rsquo;s begin!</p>
		<p>In the production environment, the Item Locator application
			retrieves all pertinent item information via the Getvoyrec
			application.For example, Harper Lee&rsquo;s &ldquo;To Kill a
			Mockingbird&rdquo; (bib id = 652404) displays two available copies in
			Firestone library as well as the item&rsquo;s location code, call
			number, and status and circulation policy information.</p>
		<p>
			To view the resulting getvoyrec.aspx entry in your browser, click <a
				href="http://libweb5.princeton.edu/getvoyrec/getvoyrec.aspx?item=1&amp;bib=1&amp;mfhd=1&amp;id=652404"
				title="http://libweb5.princeton.edu/getvoyrec/getvoyrec.aspx?item=1&amp;bib=1&amp;mfhd=1&amp;id=652404"  target="_blank">here</a>.
		</p>
		<p>From an item&rsquo;s location code and call number information, the
			Locator application parses and displays the corresponding location of
			the item, or its access details if no physical location exists.</p>
		<h2>System Maintenance</h2>
		<h3>Branch Libraries</h3>
		<p>
			An item is mapped to a branch library location if the item&rsquo;s
			location code matches a location code in the branch library
			collections database.For example, <a
				href="../index.php?loc=sz&amp;id=1620442"
				title="../index.php?loc=sz&amp;id=1620442"  target="_blank">Jay
				Savage&rsquo;s Evolution</a> is mapped to the Biology
			Library&rsquo;s SZ location code, without even considering the
			item&rsquo;s call number information.
		</p>
		<p>Each entry in the branch library collections database contains the
			following information:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{ location code, website link, image code, map id, message}</p>
		<p>For every location code, the corresponding branch library&rsquo;s
			website is provided, along with an optional message that may be
			included in the index card portion of the page.</p>
		<p>

			The image code corresponds to the branch library&rsquo;s photo
			location on Princeton University&rsquo;s <em>pumap</em> server (the
			Biology Library is saved as <a
				href="http://www.princeton.edu/~pumap/images/fine.jpg"
				title="http://www.princeton.edu/~pumap/images/fine.jpg">fine.png</a>),
			while the map id corresponds to the stored campus map image (Fine
			Hall is mapped to <a
				href="http://www.princeton.edu/~pumap/buildings/131.png">id 131</a>).
		</p>
		<p>As floor plans become available and are processed for the Locator
			system, branch library items may be reclassified within the
			designated location database.</p>

		<h3>External Locations</h3>

		<p>
			If an item has no physical or patron-accessible location, its
			location code is mapped to the external locations database. For
			example, all electronic resources (such as <a
				href="../index.php?loc=elf1&amp;id=4652411"
				title="External Locations" target="_blank">McGraw-Hill&rsquo;s
				LSAT Curvebreakers</a>, with location code elf1) and recap books
			(such as <a
				href="../index.php?loc=rcppa&amp;id=1221302"
				title="../index.php?loc=rcppa&amp;id=1221302"  target="_blank">Pierre
				Vilar&rsquo;s Science</a>, with location code rcppa) are classified
			as external locations.
		</p>
		<p>Each entry in the external locations database contains the
			following information:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{location code, website link, message}</p>
		<p>For any location code, a website may be specified to help patrons
			navigate to the requested item, and a special message may be included
			to provide further information.\</p>

		<h3>Designated Locations, Octavos &amp; Oversize Collections</h3>
		<p>
			All items containing a specific designated location have been mapped
			to the designated location database. Just like items mapped to the
			branch library and external location databases, an item with a
			designated location is mapped to its physical location without
			consideration of its call number. For example, <a
				href="../index.php?loc=ctsn&amp;id=4753526"
				title="Designated Locations"  target="_blank">J.K.
				Rowling&rsquo;s Harry Potter and the Chamber of Secrets</a>, with
			location code CTSN, is mapped to the Rare Books collection (Cotsen
			Chlidren&rsquo;s Library).
		</p>
		<p>
			If an item&rsquo;s location code classifies its location within the
			Firestone Library Stacks (or another library&rsquo;s stacks in which
			the floor plans have been processed), then its physical location is
			determined by its call number. All Octavos and Oversize collections
			are classified separately in different databases. For example, <a
				href="../index.php?loc=f&amp;id=1476888"
				title="Oversized"  target="_blank">Garcia
				de Miranda&rsquo;s Atlas</a> and <a
				href="../index.php?loc=f&amp;id=847821"
				title="Standard Size"  target="_blank">Catherine
				Lutz&rsquo;s Reading National Geographic</a> both have a Firestone
			location code and G call number, but are in different locations
			because the former is an oversized item.
		</p>
		<p>Each designated location and call number collection is mapped to a
			single image file, highlighting its approximate location in the
			stacks.Each processed floor plan has been created as an Illustrator
			file for easy up keeping, in which each physical location is saved as
			a unique layer within the file.For example, there is a single
			Illustrator file for every floor plan in Firestone Library. The file
			A.ai is comprised of multiple layers, so that each location belonging
			on the A floor is represented, such as A-15-F (call numbers H1
			&ndash; H99), A-8-B (call numbers HG), etc.</p>
		<p>When making updates to the designated locations, octavos and
			oversize collections, the following guidelines should be observed:</p>
		<ol>
			<li>Each location must be mapped to an image.An easy way to do this
				is to create each location as its own layer within the corresponding
				Illustrator file.By running the Locator Illustrator script, each
				layer will be saved as a unique image file, designating the given
				layer name as the image filename. There is no file-naming
				convention, but each filename should give a clear indication to its
				designated location.</li>
			<li>All image files should be uploaded to the server into the images
				folder. Locations classified in the same library stacks should also
				be sub-grouped into the same folder. For example, all locations in
				Firestone Library are found in the root folder images/stage/f/,
				while all locations in the Engineering Library are found in the root
				folder images/stage/st/.</li>
			<li>When updating or inputting a new database entry, make sure to
				include all designated fields.Each entry should contain either a
				designated location code, or left and right call number endpoints,
				along with the corresponding building code. Locations should also
				include the location coordinates and the corresponding image file
				that highlights the correct location.</li>
			<li>Once a new database entry has been inputted, either a checkmark
				or warning symbol will appear next to the image filename indicating
				whether or not the given image has been correctly uploaded to the
				server.</li>
			<li>Once the image for the given entry has been correctly located on
				the server, click on the orange location link. In the new window,
				click on the map where the &ldquo;breadcrumbs&rdquo; path should
				lead the patron to the endpoint.</li>
		</ol>
		<h3>Floor Plan Databases</h3>
		<p>
			Every new floor plan entered into the system must be processed and
			mapped to indicate all patron-accessible areas.By navigating to the
			&ldquo;<a
				href="setStartingPoints.php"
				title="setStartingPoints.php">Manage
				Maps</a>&rdquo; section of the site, each floor plan database can be
			administered and new databases can be created.
		</p>
		<p>The default starting point for the &ldquo;breadcrumbs&rdquo; path
			for all designated locations, octavos and oversize items begin at the
			main elevators for each floor. Clicking on an entry&rsquo;s orange
			floor link will launch the XY Creator tool to select a new starting
			point for all items on the given floor.</p>
		<p>By clicking the orange image link, the Grid Creator tool is
			launched to update the grad matrix for a given floor entry. This
			matrix determines the breadcrumbs path used to connect the starting
			point and end point for all items.</p>
	</div>
	<?php 
	page_footer();
?>
</body>
</html>
