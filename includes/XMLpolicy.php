
<?php
	
	$file = "http://libweb5.princeton.edu/LocInfo/locinfo.aspx?&xml=1&loc=" . $location_code;
	$counter = 0;

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


?>	




