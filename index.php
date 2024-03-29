<?php
require_once('includes/db_config.php');
require_once('includes/layout.php');

require_once('includes/item.php');
require_once('includes/extandbranch.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="IE=Edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Princeton University | Library Locator</title>

<?php javascript_public(); ?>
<?php styles_public(); ?>
</head>
<body>
	<?php if (!isset($_GET["embed"])||$_GET["embed"]==false) { ?>
	<div id="tabs">
		<ul>
			<?php if ($item->message) { ?>
			<li id="tab-message"><a href="#message">Messages</a></li>
			<?php } ?>
			<li id="tab-item-details"><a href="#item-details">Item details</a></li>
			<li id="tab-print"><a href="#print-page"><strong>Print this page</strong>
			</a></li>
			<li id="tab-contact-us"><a href="#contact-us">Contact us</a></li>
			<!--  <li id="tab-locInfo"><a href="#locInfo">Location info</a></li> -->
		</ul>
		<?php if ($item->message) { ?>
		<div id="message">
			<button class="ui-icon ui-icon-close">Close Panel</button>
			<p>
				<strong><?php echo $item->message;?> </strong>
			</p>
		</div>
		<?php } ?>
		<!--  <div id="locInfo">
			<button class="ui-icon ui-icon-close">Close Panel</button>
			<?php #include('includes/locInfo.php') ?>
		</div> //-->
		<div id="item-details">
			<button class="ui-icon ui-icon-close">Close Panel</button>
			<p>
				<?php echo $item->info;?>
			</p>
		</div>
		<div id="contact-us">
			<button class="ui-icon ui-icon-close">Close Panel</button>
                        <?php if(isset($_REQUEST['id'])) {
                                      $id = $_REQUEST['id'];
                              } else {
				      												$id = null;
                              }
                        ?>
			<!--
			<form id="contact-form" action="SendMail.php" method="post">
				Name:<br /> <input type="text" name="name" /><br /></br> E-mail:<br />
				<input type="text " name="email"><br /> <br /> Comment:<br />
				<textarea name="com" rows="5" cols="50"></textarea>
				<br /> <br /> <input type="hidden"
					value="<?php echo $id ?>" name="bib" /> <input
					type="submit" name="submit" value="Send" />
			</form>
			-->
			<?php if (!is_numeric($id)) {
				$id = null;
			} else {
				$id = urlencode($id);
			}
			?>
			<p><a href="https://library.princeton.edu/help/e-mail?id=<?php echo $id; ?>">Contact the Library
			About this Record.</a></p>
		</div>
	</div>
	<?php } ?>
	<?php
	if ($item->external === true) {
		loadExternal();
		showOtherItems($bibs, $locations, $loc);
	} else if ($item->branch === true) {
		loadBranch();
		showOtherItems($bibs, $locations, $loc);
	} else if ($item->designated === true) {
		?>
	<div id="locator"></div>
	<?php };

	?>
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
		<?php if (!isset($_GET["embed"])||$_GET["embed"]==false) page_footer();  ?>
</body>
</html>
