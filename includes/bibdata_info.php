<?php

class BibdataInfo {

	public function get_data($id, $loc) {
		// var_dump('<p>input id '.$id.' loc: '.$loc.'<p>');
		$f_array = array();
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

			$bibdata_solr_url = "https://catalog-alma-qa.princeton.edu/catalog/" . $id . "/raw";
			$solr_json = file_get_contents($bibdata_solr_url);
			$bibdata_solr_array = json_decode($solr_json);
			$f_array[0] = new stdClass();
			$f_array[0]->title=$bibdata_solr_array->title_display[0];
			$f_array[0]->call=$this->force_number_part_to_have_4_digits($bibdata_solr_array->call_number_display[0]);
			if (isset($bibdata_solr_array->author_display)) {
				$f_array[0]->author=$bibdata_solr_array->author_display[0];
			}	elseif (isset($bibdata_solr_array->author_s)){
				$f_array[0]->author=$bibdata_solr_array->author_s[0];
			} else {
				$f_array[0]->author = '';
			}

			// if one of the holdings includes the location the parameters are asking for set that as the location
			if (($loc) && (in_array($loc, $bibdata_solr_array->location_code_s))) {
				$f_array[0]->location=$loc;
			} else {
				$f_array[0]->location=$bibdata_solr_array->location_code_s[0];
			}

			$f_array[0]->status='';
			$f_array[0]->tmp_location='';
			$f_array[0]->display='';

			// We are in firestone, so we need all information from items to product the correct map
			if ($loc == 'f') {
				try {
					$bibdata_items_url = "https://bibdata-alma-staging.princeton.edu/bibliographic/" . $id . "/items";
					$json = file_get_contents($bibdata_items_url);
				} catch (Exception $e) {
					// echo 'Caught exception: ',  $e->getMessage(), "\n";
					$json = '';
				}
			
				if ($json) {
					$bibdata_array = json_decode($json);
					$location = $bibdata_array->{'firestone$stacks'};
					foreach ($location as $bibdata_item) {
					// for ($i = 0; $i < $copies; $i++) {
						// only parse the f field if it includes items
						if ($bibdata_item->items) {
							$this_item = new stdClass();
							$this_item->location = "f"; //$bibdata_item->items[0]->perm_location;
							if (property_exists($bibdata_item,'sortable_call_number')) {
								$this_item->call = $bibdata_item->sortable_call_number;
							} else {

							}
							$this_item->call_display = $bibdata_item->call_number;
							$this_item->display = '';
							//$this_item->status = implode(",",$bibdata_item->items[0]->status);
							$this_item->tmp_location = $bibdata_item->items[0]->temp_location;
							array_push($f_array, $this_item);
						}
					}
				
				// we can not get item information we are just going to set the temporary location
				//  to the one they are looking for assuming the data they are asking for is correct
				} else {
					$f_array[0]->tmp_location= $loc;
					$f_array[0]->call_display=$bibdata_solr_array->call_number_display[0];
				}
	
			// The catalog has told us an alternative location
			//  lets just give them back the map they asked for
			} else {
				$f_array[0]->tmp_location= $loc;
			  $f_array[0]->call_display=$bibdata_solr_array->call_number_display[0];
			}
		} 
		return $f_array;
	}

	private function force_number_part_to_have_4_digits($call_no) {
    $all_dots =str_replace(',', '.', $call_no);
		$dot_parts = preg_split("/\./", $all_dots);

		if (count($dot_parts)<=1){
			return $call_no;
		}
		preg_match("/[A-Za-z]+/", $dot_parts[0], $parts);
		if (count($parts) > 0){
			$letter_part = $parts[0];
		} else{
			$letter_part = '';
		}
		
		preg_match("/\d+/", $dot_parts[0], $parts);
		$number_part = $parts[0];
		$number_part =  str_pad($number_part, 4, "0", STR_PAD_LEFT);
		$dot_parts[0] = $letter_part.".".$number_part;
		return implode(".", $dot_parts);
	}
}
?>
