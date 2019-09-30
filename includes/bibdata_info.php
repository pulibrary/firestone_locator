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

	$bibdata_solr_url = "https://bibdata.princeton.edu/bibliographic/" . $id . "/solr";
	$solr_json = file_get_contents($bibdata_solr_url);
	$bibdata_solr_array = json_decode($solr_json);

	$f_array[0]->title=$bibdata_solr_array->title_display[0];
	$f_array[0]->call=$bibdata_solr_array->call_number_display[0];
	$f_array[0]->author=$bibdata_solr_array->author_display[0];
	$f_array[0]->display=$bibdata_solr_array->call_number_display[0];
	$f_array[0]->location=$bibdata_solr_array->location_code_s[0];
	$f_array[0]->status='';
	$f_array[0]->tmp_location='';
	$f_array[0]->display='';

	$bibdata_items_url = "https://bibdata.princeton.edu/bibliographic/" . $id . "/items";
	$json = file_get_contents($bibdata_items_url);
	$bibdata_array = json_decode($json);

	$copies = count($bibdata_array->f);
	for ($i = 0; $i < $copies; $i++) {
		$this_item->location = $bibdata_array->f[$i]->items[0]->perm_location;
		$this_item->call = $bibdata_array->f[$i]->sortable_call_number;
		$this_item->call_display = $bibdata_array->f[$i]->call_number;
		$this_item->display = '';
		$this_item->status = implode(",",$bibdata_array->f[$i]->items[0]->status);
		$this_item->tmp_location = $bibdata_array->f[$i]->items[0]->temp_location;
		array_push($f_array, $this_item);
	}

}

?>
