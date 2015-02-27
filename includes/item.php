<?php

// Database requirements
// Retrieve item information
// $loc = $_GET['loc'];
// $id  = $_GET['id'];
if (isset($_GET['set'])) {
	$set_hit = $_GET['set'];
} else {
	$set_hit = "";
}
$hits = 0;
if (isset($_GET['loc'])) {
	$loc = $_GET['loc'];
} else {
	$loc = "";
}
if (strpos($_GET['id'], 'dedupmrg') === false) {
	$id = (int)str_replace("PRN_VOYAGER","", $_GET["id"]);


} else {
	$chd=curl_init();
	curl_setopt($chd,CURLOPT_URL,"http://library.princeton.edu/searchit/record/".$_GET["id"].".json");
	curl_setopt($chd,CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($chd);
	curl_close($chd);
	#echo "http://libwebprod.princeton.edu/searchit/record/".$_GET["id"].".json";
	$mergedrecord = json_decode($result, true);
	$i=0;
	foreach($mergedrecord as $bib => $otherInfo) {
		$bib = (int)str_replace("PRN_VOYAGER","", $bib);
		#echo $id;
		$bibs[$i]["bib"] = $bib;

		foreach($otherInfo["locations"] as $thisloc) {
			$locations[$bib]["$thisloc"] = "";
			if ($otherInfo["fulltext"]!="") {
				$locations[$bib]["$thisloc"]=$otherInfo["fulltext"];
			}
			if (!isset($id)) {
				if($thisloc==$loc) {
					$loc = $thisloc;
					$id = $bib;
				}
			}

		}
		$i++;
	}
}
if (!isset($id)) {

	$id = $bib;
}

// Retrieve item information from XML source
require_once('XMLinfo.php');

// Save all relevent information into one variable
class item{
	var $info, $id, $callnum, $call_display, $lc, $location, $fl, $image, $legend, $ref, $site, $charged, $status, $subject, $message;

	var $floorDB, $grid, $start_x, $start_y, $end_x, $end_y, $shift_x, $shift_y, $scale_x, $scale_y;

	var $external, $branch, $designated, $tmp_location="";
}

$item = new item();

$index = 0;
// Iterate through all returned firestone records
for($x = 0; $x < count($firestone_array); $x++){

	if ($loc == $firestone_array[$x]->location){
		global $index, $hits;
			
		// If temporary location exists, check if user specified which copy they are searching for
		if (($set_hit > 0)&&($hits == $set_hit-1)) {
			$hits++;
			$index = $x;
			break;
		}
			
		// If multiple items are present in location, display items that are currently not charged
		else if ($hits > 0) {
			if (strstr($firestone_array[$x]->status, "Not")){
				$hits++;
				$index = $x;
			}
		}
			
		// If only one copy exists
		else {
			$hits++;
			$index = $x;
		}
	}
}
// If multiple copies exist in one permanent location
if (($hits > 1) || ($set_hit > 0)) {

	$loc_flag = true;

	// Check if items have different temporary locations
	for($x=0;$x<count($firestone_array);$x++){
		if (($loc == $firestone_array[$x]->location)
				&& ($firestone_array[$x]->tmp_location != "")){
			$loc_flag = false;
			break;
		}
	}

	// If all copies exist in same location
	if ($loc_flag) {
		$multiple =  '<br>' . "At least one copy of this item may be available in " . $firestone_array[$index]->display.'<br>';
	}

	// If different copies have different locations
	else {

		displayMultipleCopies($firestone_array, $index);
			
	}
}

$callnum = 	 $firestone_array[$index]->call;

// Check for temporary locations
if (isset($firestone_array[$index]->tmp_location) &&  $firestone_array[$index]->tmp_location != "")
	$location_code = $firestone_array[$index]->tmp_location;
else $location_code = $firestone_array[$index]->location;

// Check policy
include('XMLpolicy.php');

// Display title information
if ($firestone_array[0]->title > ""){
	$title = $firestone_array[0]->title;

	if (strlen($title) > 150) {
		$title = substr($title, 0, 150);
		$title = $title . "...";
	}

	$title = str_replace("/", "", $title);

	$title = "<b>Title:</b> " . $title . '<br>';
	//echo $title;
}

// Display author information
if ($firestone_array[0]->author != ""){
	$author = "<b>Author:</b> " . $firestone_array[0]->author . '<br>';
} else {
	$author = "";
}

// Display item status: charged / not-charged
if ($firestone_array[$index]->status != ""){
	$status = "<b>Item status:</b> " . trim($firestone_array[$index]->status);
} else {
	$status = "";
}

// Display multiple information
if (!isset($multiple) ){
	$multiple = "";
}

// Save variables
if (isset($firestone_array[$index]->call_display)) {
	$item->call_display = $firestone_array[$index]->call_display;
} else {
	$item->call_display = "";
}
$item->info = str_replace("\"","&quot;",$title) . $author  . $status . $multiple. '<br />' . '<br />' . $firestone_array[$index]->display . " " . $item->call_display . '<br />' . $firestone_array[0]->policy . '<br />';

$item->id = $id;

if (preg_match('/^([A-Z]{2}.+\d\sQ)\s(.+)/', $callnum, $matches)) {
	$item->callnum = $matches[1].$string_oversize;
} else {
	$item->callnum = $callnum;
}

$item->lc = $location_code;
$item->status = $status;

// Program error check
if ((count($firestone_array) >= 1 ) && ($index < count($firestone_array))){

	// Find location of item
	if(BranchLibrary())  {
	}
	else if(noLocation()){
	}

	else if(DesignatedLocation()) {
		getFloorStats();
		compileInfo();
	}

	else if (RangeLocation()) {
		getFloorStats();
		compileInfo();
	}

	else loadError();
}

else{
	loadError();
}

// Check if the collection is located in a branch library-----------------------------
function BranchLibrary() {

	global $item, $Locator, $dbconnects;

	$sql = "SELECT * FROM lctr_Campus_cn WHERE left_cn = '$item->lc'";
	if ($subResult = $dbconnects["current"]->query($sql))  {
		if ($subResult->num_rows > 0) {
			while ($row = $subResult->fetch_array()) {
				$item->info = $item->info . $row['message_cn'] . '<br />';
				$item->image =  $row['ImageCode_cn'];
				$item->ref = $row['MapNumber_cn'];
				$item->site = $row['Website_cn'];
			}

			$item->branch = true;
		}
		return $subResult->num_rows;
	} else {
		$error = $dbconnects["current"]->error;
		return false;
	}

}

//Check if collection has no designated location----------------------------------------
function  noLocation() {
	global $item, $Locator, $dbconnects;

	$sql = "SELECT * FROM lctr_External_cn WHERE left_cn = '$item->lc'";

	if ($subResult = $dbconnects["current"]->query($sql))  {
		if ($subResult->num_rows > 0) {
			while ($row = $subResult->fetch_array()) {
				$item->info = $item->info . '<br /><br />' .$row['message_cn'];
				$item->site = $row['site_cn'];

			}

			$item->external = true;
		}
		return $subResult->num_rows;
	} else {
		$error = $dbconnects["current"]->error;
		return false;
	}
}

//Check if collection has designated location------------------------------------
function DesignatedLocation() {
	global $item, $Locator, $dbconnects;
		
	$sql = "SELECT * FROM lctr_Collections_cn WHERE left_cn = '$item->lc'";

	if ($subResult = $dbconnects["current"]->query($sql))  {
		if ($subResult->num_rows > 0) {
			while ($row = $subResult->fetch_array()) {

				$item->lc       = $row['BuildingCode_cn'];
				$item->location = $row['LocationMap_cn'];
				$item->image    = $row['Image_cn'];
				$item->floorDB  = $row['FloorDB_cn'];
				$item->end_x    = $row['x_point_cn'];
				$item->end_y    = $row['y_point_cn'];
				$item->message = $row['message_cn'];
				$item->subject = $row['LocationDisplayName_cn'];
			}

			$item->designated = true;
		}
		return $subResult->num_rows;
	} else {
		$error = $dbconnects["current"]->error;
		return false;
	}
}

//Check if collection is located in Firestone -------------------------------------
function RangeLocation(){

	global $item, $Locator, $dbconnects;

	//default set to regular collection
	$collection = "Octavos";
	//Check for oversize collection
	$oversize_key = array("q"); # , "f", "e");
	$lastindex = strlen($item->callnum);
	if ($lastindex!=0) {
		$last = $item->callnum[$lastindex-1];
		for ($i = 0; $i < sizeof($oversize_key); $i++){
			if (strcasecmp($oversize_key[$i], $last) == 0){
				$collection = "Oversize";
			}
		}
	}

	$lc = $item->lc;
	if ($lc == "fnc")
		$lc = "f";
	// Match item's callnumber within range and location code
	$sql = "SELECT * FROM lctr_".$collection."_cn WHERE left_cn <= '$item->callnum'
	AND right_cn >= '$item->callnum' AND BuildingCode_cn = '$lc' ORDER BY left_cn ASC";

	if ($subResult = $dbconnects["current"]->query($sql))  {
		if ($subResult->num_rows > 0) {
			while ($row = $subResult->fetch_array()) {
				$item->lc       = $row['BuildingCode_cn'];
				$item->location = $row['LocationMap_cn'];
				$item->floorDB  = $row['FloorDB_cn'];
				$item->end_x    = $row['x_point_cn'];
				$item->end_y    = $row['y_point_cn'];
				$item->image = $row['Image_cn'];

				$item->subject        = $row['LocationDisplayName_cn'];
				$item->message        = $row['message_cn'];

			}
				
			// Pitney collection has special case!
			$findme   = "PITN";
			$pos = strpos($item->callnum, $findme);

			if ($pos !== false) {
				$item->message = "";
				//$item->subject = "Pitney Classification";

				//$item->image = "B-12-F.SWF";
			}

			$item->designated = true;
		}
		return $subResult->num_rows;
	} else {
		$error = $dbconnects["current"]->error;
		return false;
	}

}


//Compile information for index card -------------------------------------
function compileInfo(){
	global $item, $Locator, $dbconnects;
	

	$content_var = array();
	$num = 0;

	// Retreive information nec. for building map array
	$sql = "SELECT * FROM lctr_Messages_cn";


	if ($subResult = $dbconnects["current"]->query($sql))  {
		while ($row = $subResult->fetch_array()) {
			$content_var[$num] = $row['content_cn'];
			$content_var[$num] = str_replace("#floor",    $item->fl,       $content_var[$num]);
			$content_var[$num] = str_replace("#location", $item->location, $content_var[$num]);
			$content_var[$num] = str_replace("#subject",  $item->subject,  $content_var[$num]);
			$num++;
		}
		// Set text if item is not charged (available)
		if (strstr($item->status, "Not")) {
			$item->charged = "false";
			$item->info .= "<br \>" . $content_var[0];
		}
		
		// Set text if item has no status, and there is no message
		else if ($item->status == "" && $item->message == "") {
			$item->charged = "false";
			$item->info .= "<br \>" . $content_var[1];
		}
		
		// Set text if item is charged (not available)
		else if ($item->status != ""){
			$item->charged = "true";
			$item->info .= "<br \>" . $content_var[2];;
		}
		
		$item->info .= "<br \>" . $item->message;
		//$item->info = flash_encode($item->info);
	} else {
		return false;
	}


}


//Find map placement coordinates ----------------------------------
function getFloorStats() {

	global $item, $Locator, $dbconnects;
	
	// Retreive information nec. for building map array
	$sql = "SELECT * FROM lctr_Coordinates_cn WHERE FloorDB_cn = '$item->floorDB'";

	if ($subResult = $dbconnects["current"]->query($sql))  {
		while ($row = $subResult->fetch_array()) {
			$item->start_x   = $row['x_point_cn'];
			$item->start_y   = $row['y_point_cn'];
			$item->shift_x   = $row['x_shift_cn'];
			$item->shift_y   = $row['y_shift_cn'];
			$item->scale_x   = $row['x_scale_cn'];
			$item->scale_y   = $row['y_scale_cn'];
			$item->fl        = $row['floor_cn'];
			$item->legend    = "legend.PNG";//$row['legend_cn'];
			$item->grid		 = $row['grid_crd'];
		}
	} else {
		return false;
	}
}


//Compile multiple locations -------------------------------------

function displayMultipleCopies($firestone_array, $index) {
	global $loc, $id;

	echo "Copies may be available in these locations: ".$firestone_array[$index]->display.'<br>';
	$hits = 1;

	for($x = 0; $x < count($firestone_array); $x++){

		if ($loc == $firestone_array[$x]->location){

			?>

<A
	href="../index.php?loc=<?php echo  $loc; ?>&amp;id=<?php echo $id; ?>&amp;set=<?php echo $hits; ?>">
	<?php echo $hits++ . ". " . $firestone_array[0]->title . " " . $firestone_array[$x]->status; ?>
</A>
<br>

<?php
		}
	}

}




function flash_encode($string) {
	return  str_replace("&", "%26", $string);
}

/*
 echo "info 		$item->info <br>";
echo "id 		$item->id <br>";
echo "callnum 	$item->callnum <br>";
echo "lc 		$item->lc <br>";
echo "location	$item->location <br>";
echo "image 	$item->image <br>";
echo "floor		$item->fl <br>";
echo "ref 		$item->ref <br>";
echo "site 		$item->site <br>";
echo "charged 	$item->charged <br>";
echo "status 	$item->status <br>";
echo "floorDB 	$item->floorDB <br>";
echo "grid 		$item->grid <br>";
echo "start_x 	$item->start_x <br>";
echo "start_y 	$item->start_y <br>";
echo "end_x 	$item->end_x <br>";
echo "end_y 	$item->end_y <br>";
echo "shift_x 	$item->shift_x <br>";
echo "shift_y 	$item->shift_y <br>";
echo "scale_x 	$item->scale_x <br>";
echo "scale_y 	$item->scale_y <br>";
*/

// Load other locator links if merged records --------------------------------------------
function showOtherItems($bib_array, $locations_array, $selected_loc) {
	if (sizeof($bib_array) > 1) {
		echo "<h2>View this item:</h2>";
		echo "<ul>\n";
		mysql_select_db("requests",$tempconn);

		foreach($bib_array as $bib) {

			$bibid = (int)str_replace("PRN_VOYAGER","", $bib["bib"]);
			foreach($locations_array[$bibid] as $loc => $info) {
				if ($loc != $selected_loc) {
					$sql = "select * from voyagerLocations where voyagerLocationCode='$loc'";
					$res = mysql_query($sql, $tempconn);
					if (mysql_num_rows($res)==0) {
						$locname = "Other";
					} else {
						$tempInfo = mysql_fetch_array($res);
						$locname = $tempInfo['libraryDisplay'];
						if ($tempInfo["collectionDisplay"] != "") $locname .= " - ".$tempInfo["collectionDisplay"];
					}
					if ($info=="") {
						echo "<li>In Location: <a href='index.php?id=$bibid&amp;loc=$loc'>$locname</a>.</li>\n";
					} else {
						echo "<li><a href='$info'>Online</a></li>\n";
					}
				}
			}
		}
		echo "</ul>\n";
	}

}

// Error Message-----------------------------------------------------------------------
function loadError($msg=""){
	global $item;

	#include('../locInfo.php?$_GET[loc]');
	?>
	<table class="item_table" align="left">
		<tr>
			<td width="600" valign="top"><div id="info">
					<?php echo $item->info; ?>
				</div></td>
		</tr>
		<tr>
			<td width="600" valign="top"><?php echo "<p>Please consult a member of the Library staff for help in locating this item, or send a copy of the catalog record to ";
	
			?> <a href=mailto:refdesk@princeton.edu>refdesk@princeton.edu</a> <?php
	
			echo " .</p><p> Please use the <a href=\"http://libserv5.princeton.edu/requests/index.php?bib=".$_GET["id"]."\" target=\"_blank\">In Process Request</a> service if the item has no call number, is \"on order\", or is \"in the pre-order process\". </p>" . '<p>' . "$msg<br>";
	
			echo '</p>' ;
			?>
			</td>
		</tr>
		<tr>
			<td valign="top"><a href="<?php echo $item->site; ?>">Access campus
					library website</a></td>
			<td valign="top"><a
				href="http://library.princeton.edu/about/locations">View map of
					campus libraries</a></td>
	
		</tr>
	</table>
<?php
}

?>
