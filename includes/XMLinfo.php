<?php


if ($id > 0){

	$firestone_array = array();
		
	$xml_location_key = "*COLLECTION*RECORD*MFHD*LOCATION_CODE";
	$xml_call_display =  "*COLLECTION*RECORD*MFHD*DISPLAY_CALL_NO";
	$xml_call_key = "*COLLECTION*RECORD*MFHD*NORMALIZED_CALL_NO";
	$xml_author_key = "*COLLECTION*RECORD*BIB*AUTHOR";
	$xml_title_key = "*COLLECTION*RECORD*BIB*TITLE_BRIEF";
	$xml_display_key = "*COLLECTION*RECORD*MFHD*LOCATION_DISPLAY_NAME";
	$xml_status_key = "*COLLECTION*RECORD*ITEM*ITEM_STATUS_DESC";
	$xml_circ_policy = "*DOCUMENT*LOCINFO*CIRC_POLICY";
	$xml_MFHD_A = "*COLLECTION*RECORD*MFHD*MFHD_ID";
	$xml_MFHD_B = "*COLLECTION*RECORD*ITEM*MFHD_ID";
	$xml_tmp_location = "*COLLECTION*RECORD*ITEM*TEMP_LOCATION_CODE";
	$xml_tmp_display  = "*COLLECTION*RECORD*ITEM*TEMP_LOCATION_DISPLAY_NAME";

	class xml_firestone{
		var $location="", $call="", $author="", $title="", $display="", $status="", $policy="", $MFHD="", $tmp_location="", $tmp_display="";
	}
	
	
	$counter = 0;	 
	$firestone_array[$counter] = new xml_firestone();	
	
	function startTag($parser, $data){
		global $current_tag;
		$current_tag .= "*$data";
	}
	
	function endTag($parser, $data){
		global $current_tag;
		$tag_key = strrpos($current_tag, '*');
		$current_tag = substr($current_tag, 0, $tag_key);
	}
	
	function contents($parser, $data){
		
		global $firestone_array, $current_tag, $xml_call_display, $xml_display_key, $xml_location_key, $xml_author_key, $xml_title_key, $xml_call_key, $xml_status_key, $xml_circ_policy, $counter, $xml_MFHD_A, $xml_MFHD_B, $xml_tmp_location, $xml_tmp_display;
		
		//echo "NEW: " . $current_tag . '<br />';
		switch($current_tag){

			case $xml_title_key:
				//echo "TITLE: " . $data;
				$firestone_array[0]->title = $firestone_array[0]->title . "" . $data;
			break;
			
			case $xml_display_key:
				$firestone_array[$counter]->display = $data;
			break;
						
			case $xml_location_key:							
				$firestone_array[$counter]->location = $data;
			break;
							
			case $xml_author_key:
				$firestone_array[$counter]->author = $data;
			break;
			
			case $xml_circ_policy:
				$firestone_array[$counter]->policy = $data; 
			break;								
			
			case $xml_call_key:
				$firestone_array[$counter]->call = $data;
			break;	
			
			case $xml_call_display:
				$firestone_array[$counter]->call_display = $data;
			break;		
			
			//MFHD ID number must be first line retrieved			
			case $xml_MFHD_A:
				$counter++;
				$firestone_array[$counter]->MFHD= $data;
			break;
			
			case $xml_MFHD_B:
				for ($i=0; $i<count($firestone_array); $i++) { 
					if ($firestone_array[$i]->MFHD == $data){
						$counter = $i;
					}
				}
			break;
			
			case $xml_status_key:
				$firestone_array[$counter]->status = $data;
			break;
			
			case $xml_tmp_location:
				$firestone_array[$counter]->tmp_location = $data;
			break;		
			
			case $xml_tmp_display:
				$firestone_array[$counter]->display = $data;
			break;	
		}

	}
    $url = (isset($_GET['useTestCatalog']) && $_GET['useTestCatalog'] == "on") ? "http://libweb5.princeton.edu/GetVoyRecTestCat/getvoyrec.aspx?item=1&bib=1&mfhd=1&id=" : "http://libweb5.princeton.edu/getvoyrec/getvoyrec.aspx?item=1&bib=1&mfhd=1&id=";
    
	$file = $url . $id;

	$xml_parser = xml_parser_create();
	xml_set_element_handler($xml_parser, "startTag", "endTag");
	xml_set_character_data_handler($xml_parser, "contents");
				
	if ($file_stream = fopen($file, "r")) {
	   while ($data = fread($file_stream, 4096)) {
	
		   $this_chunk_parsed = xml_parse($xml_parser, $data, feof($file_stream));
		   if (!$this_chunk_parsed) {
			   $error_code = xml_get_error_code($xml_parser);
			   $error_text = xml_error_string($error_code);
			   $error_line = xml_get_current_line_number($xml_parser);
		
			   $output_text = "Parsing problem at line $error_line: $error_text";
			   die($output_text);
		   }
		}
		
	} 
	else {
		die("Can't open XML file.");
	}
	
	xml_parser_free($xml_parser);
	fclose($file_stream);
}

?>




