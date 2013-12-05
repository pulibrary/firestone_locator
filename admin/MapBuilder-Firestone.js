
// requires full directory path
var dir = "/Users/abarrera/apt_workspace/firestone_locator/images/stage/f/";



// Check to see if a document is open
if (app.documents.length > 0) {
	
	// Get total number of layers
	var totalLayers = app.activeDocument.layers.length;
	
	// Set all layers as invisible
	for (i = 0; i < totalLayers; i++){
		app.activeDocument.layers[i].visible = false;
	}
		
	// Find transparent background to ensure proper alignment
	// *Must have layer named "*-Background" in file*	
	for (i = 0; i < totalLayers; i++){
				
		var layer_array = app.activeDocument.layers[i].name.split("-");
		
		if (layer_array[1] == "Background") {
			
			floor_plan = layer_array[0];		
			app.activeDocument.layers[i].visible = true;
			var back_check = true;			
			var fileName = dir + "Background.png";
								
			// Export new document as PNG24 file
			var exportOptions = new ExportOptionsPNG24();
			var type = ExportType.PNG24;
			var fileSpec = new File(fileName);
			
			app.activeDocument.exportFile(fileSpec, type, exportOptions);
			
			break;
		}
	}

	// Find floor plan layer and keep visible
	for (i = 0; i < totalLayers; i++){
				
		var layer_array = app.activeDocument.layers[i].name.split("-");
		
		if (layer_array.length == 1) {
			
			// Export new document as SWF file
			app.activeDocument.layers[i].visible = true;
		
			floor_plan = layer_array[0];
			var fileName = dir + app.activeDocument.layers[i].name + ".SWF";
								
				fileName = fileName.replace(/\s+/g, '-')
				var exportOptions = new ExportOptionsFlash();
				var type = ExportType.FLASH;
				
				exportOptions.GenerateHTML = false;
				
				var fileSpec = new File(fileName);
				exportOptions.resolution = 150;
					
				app.activeDocument.exportFile(fileSpec, type, exportOptions);
				
		
		}
		
	}
		
		
	if (back_check) {	
		
		for (i = 0; i < totalLayers; i++){
			if (app.activeDocument.layers[i].name != floor_plan + "-Background") {
				if (app.activeDocument.layers[i].name != floor_plan) {
				
				// Set layer as visible
				app.activeDocument.layers[i].visible = true;
					
				var fileName = dir + app.activeDocument.layers[i].name + ".SWF";
				fileName = fileName.replace(/\s+/g, '-');
				
				// Save file as a SWF for Flash Locator Program
				var exportOptions = new ExportOptionsFlash();
				exportOptions.GenerateHTML = false;
				var type = ExportType.FLASH;
		
				var fileSpec = new File(fileName);
				exportOptions.resolution = 150;
					
				app.activeDocument.exportFile(fileSpec, type, exportOptions);
				
				// Save file as a PNG for non-Flash users	
				var fileName = dir + app.activeDocument.layers[i].name + ".png";
				fileName = fileName.replace(/\s+/g, '-');				
				
								
				//Export new document as PNG24 file
				var exportOptions = new ExportOptionsPNG24();
				exportOptions.transparency = false;
				var type = ExportType.PNG24;
				/*
				var exportOptions = new ExportOptionsGIF();
				var type = ExportType.GIF;
				*/
				var fileSpec = new File(fileName);
	
				app.activeDocument.exportFile(fileSpec, type, exportOptions);

				// Set layer as invisible
				app.activeDocument.layers[i].visible = false;
			}
			}
			
		}
		// Set all layers to visible
		for (i = 0; i < totalLayers; i++){
			app.activeDocument.layers[i].visible = true;
		}
		alert ("The script has finished succesfully!");
	}
	else {
		alert ("Please insert an invisible background layer (entitled *-Background) to ensure proper location placement.");
	}
	
	
}