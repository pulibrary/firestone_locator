<?php
include('includes/db_config.php');
include('includes/layout.php');

include('includes/item.php');
include('includes/extandbranch.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Princeton University | Library Locator</title>

		<?php javascript_public(); ?>
		<?php styles_public(); ?>
	</head>
	<body>
		<div id="tabs">
			<ul>
				<?php if ($item->message) { ?>
				<li id="tab-message"><a href="#message">Messages</a></li>
				<?php } ?>
				<li id="tab-item-details"><a href="#item-details">Item details</a></li>
				<li id="tab-print"><a href="#print-page"><strong>Print this page</strong></a></li> 
				<li id="tab-contact-us"><a href="#contact-us">Contact us</a></li>
				<li id="tab-locInfo"><a href="#locInfo">Location info</a></li> 
			</ul>
				<?php if ($item->message) { ?>
			<div id="message">
				<button class="ui-icon ui-icon-close">Close Panel</button>
				<p><strong><?php echo $item->message;?></strong></p>
			</div>		
				<?php } ?>
			<div id="locInfo">
				<button class="ui-icon ui-icon-close">Close Panel</button>
				<?php include('includes/locInfo.php') ?>
			</div>
			<div id="item-details">
				<button class="ui-icon ui-icon-close">Close Panel</button>
				<p><?php echo $item->info;?></p>
			</div>
			<div id="contact-us">
				<button class="ui-icon ui-icon-close">Close Panel</button>
				<form id="contact-form"
					action="SendMail.php" method="post">
					Name:<br/>
					<input type="text" name="name" /><br/></br>
					E-mail:<br/>
					<input type="text "name="email" ><br/><br/>
					Comment:<br/>
					<textarea name="com" rows="5" cols="50" ></textarea><br/><br/>
					<input type="hidden" value="<?php echo $_REQUEST['id'] ?>" name="bib" />	
					<input type="submit" name="submit" value="Send" /> 
				</form>
			</div>
		</div>
		<?php 	
			if ($item->external === true) { 
				loadExternal(); 
				showOtherItems($bibs, $locations, $loc);
			} else if ($item->branch === true) {
				loadBranch();
				showOtherItems($bibs, $locations, $loc);
			} else if ($item->designated === true) {
		?>
		<div id="locator" >
		</div>
		<?php }; ?>
		<script type="text/javascript" charset="utf-8">
		var data = <?php echo json_encode($item); ?>;		
			if ($("#locator").length != 0)
				locator("locator", data,'<?php echo $env; ?>');
			
			$( "#tabs" ).tabs({
						collapsible: true,
						selected: -1
			});
			<?php if ($item->message) { ?>
				$("#tabs").tabs("option", "selected", 0);
			<?php }  ?>
			$("#tab-print").unbind();
			$("#tab-print a").unbind();
			$("#tab-print a").attr("href", "javascript:print()");
			$(".ui-icon-close").click(function() {
				var id = $(this).parent().attr("id");
				$("#tabs").tabs("select", id);
			});
			$("#contact-form").submit(function() {
				var args = {
					name : $.trim($("input[name=name]", this).val()),
					email : $.trim($("input[name=email]", this).val()),
					com : $.trim($("textarea[name=com]", this).val()),
					bib : $.trim($("input[name=bib]", this).val())
				};
				if (!args.name) {
					alert("Please enter your name");
					return false;
				}
				if (!args.com) {
					alert("Please enter your comments");
					return false;
				}
				$.post("SendMail.php", args, function(response) {
					$("#tabs").tabs("select", "contact-us");
					alert(response);
				});	
				return false;
			});
		</script>
		<div id="footer">
        <div id="footercontent">
        <div id="footer_shield"></div>
        <p><a href="http://www.princeton.edu"><img src="/images/pul-logo.gif"
        	alt="Princeton University Shield" border="0" height="42" width="30"></a><strong>Princeton
        University Library</strong><br> One Washington Road, Princeton, New
        Jersey 08544 USA 


        <br> 609.258.1470 phone | 609.258.0441 fax | 


        <a href="/about/webfeedback.php">Web Site Feedback</a><br>


        <a href="/about/a-zlisting.php">Princeton Library A-Z</a> | <a
        	href="/search/">Search This Site</a> | <a href="/about/hours/">Library
        Hours</a> | <a href="/about/staff.php">For Staff</a></p>
        <p>© 2011 The Trustees of Princeton University. All rights reserved.<br>
        Last updated: June 9, 2011 

        </p>
        </div>
        </div>
        </div>
	</body>
</html>