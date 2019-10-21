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
// require_once('XMLinfo.php');

require_once('item_proc.php');

$item_proc = new ItemProc();
$item = $item_proc->get_item($set_hit, $loc, $id);

?>
