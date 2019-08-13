<?php

if ($id > 0){

	// $xml_location_key = "*COLLECTION*RECORD*MFHD*LOCATION_CODE";
	// $xml_call_display =  "*COLLECTION*RECORD*MFHD*DISPLAY_CALL_NO";
	// $xml_call_key = "*COLLECTION*RECORD*MFHD*NORMALIZED_CALL_NO";
	// $xml_author_key = "*COLLECTION*RECORD*BIB*AUTHOR";
	// $xml_title_key = "*COLLECTION*RECORD*BIB*TITLE_BRIEF";
	// $xml_display_key = "*COLLECTION*RECORD*MFHD*LOCATION_DISPLAY_NAME";
	// $xml_status_key = "*COLLECTION*RECORD*ITEM*ITEM_STATUS_DESC";
	// $xml_circ_policy = "*DOCUMENT*LOCINFO*CIRC_POLICY";
	// $xml_MFHD_A = "*COLLECTION*RECORD*MFHD*MFHD_ID";
	// $xml_MFHD_B = "*COLLECTION*RECORD*ITEM*MFHD_ID";
	// $xml_tmp_location = "*COLLECTION*RECORD*ITEM*TEMP_LOCATION_CODE";
	// $xml_tmp_display  = "*COLLECTION*RECORD*ITEM*TEMP_LOCATION_DISPLAY_NAME";

	$bibdata_url = "https://bibdata.princeton.edu/bibliographic/" . $id . "/items";
	$json = file_get_contents($bibdata_url);
	$bibdata_array = json_decode($json);

	$f_array[0]->title='foo';
	$f_array[0]->call='';
	$f_array[0]->author='bar';
	$f_array[0]->display='';
	$f_array[0]->location='f';

	$copies = count($bibdata_array->f);
	echo "copies: " . $copies;
	for ($i = 0; $i < $copies; $i++) {
		$this_item->location = $bibdata_array->f[$i]->items[0]->perm_location;
		$this_item->call = $bibdata_array->f[$i]->call_number;
		$this_item->call_display = $bibdata_array->f[$i]->call_number;
		$this_item->status = implode(",",$bibdata_array->f[$i]->items[0]->status);
		$this_item->tmp_location = $bibdata_array->f[$i]->items[0]->temp_location;
		array_push($f_array, $this_item);
	}

}

?>
