function locator(elementId, data, env) {
	function createGrid(gridXYstring, numRows, numCols) {//for making 2D grid
		var gridXY = gridXYstring.split(",");
		if (gridXY[gridXY.length-1] == "") {
	           gridXY.pop();
	       }
		var grid = [];
		var i = 0;
		for (y=0; y<numRows; y++) {
			grid.push([]);
			for (x=0; x<numCols; x++) {
				grid[y].push(parseInt(gridXY[i]));
				i++;
			}
		}
		return grid;
	}

	function drawGrid(canvas, grid, tileWidth, tileHeight, opacity) {
		if (opacity == null)
			opacity = 0.1;
		for (var i=0; i<grid.length; i++) {
			for (var j=0; j<grid[0].length; j++) {
				var rect = canvas.rect(j*tileWidth, i*tileHeight, tileWidth, tileHeight);
				if (grid[i][j]==0) {
				    rect.attr("fill", "red");//not accessible
				} else if (grid[i][j] == 1) {
				    rect.attr("fill", "green");  //major hallway
				} else if (grid[i][j] == 2) {
				    rect.attr("fill", "blue");   //   hallway
				} else if (grid[i][j] == 3) {
				    rect.attr("fill", "yellow");  //stacks
				}
				rect.attr("opacity", opacity);
			}
		}
	}

	function drawPath(canvas, path) {
		var pixelPath = [];
		for (var i=path.length-1; i>=0; i--) {
			pixelPath.push([ (path[i][1]+0.5)*tileWidth, (path[i][0]+0.5)*tileHeight ])
		}
		var lines = [];
		var i = 0;
		var duration = 600 / (path.length-1)
		function recursiveDraw() {
			if (i == pixelPath.length-1)
				return;
			lines.push( animateLine(canvas, pixelPath[i][0], pixelPath[i][1],
											pixelPath[i+1][0], pixelPath[i+1][1],
											duration, recursiveDraw) );
			/* TODO: Need to figure out how to handle interruptions from user
			 * moving the start point and triggering a redraw before current
			 * animation completes
			 */
			i++;
		};
		recursiveDraw();

		return lines;
	}

	function animateLine(canvas, startX, startY, endX, endY, duration, callback) {
		var line = canvas.path("M"+startX+" "+startY);
		line.attr({stroke: "red", "stroke-width":5, "stroke-opacity": 0.5, "stroke-linecap": "round"});
		line.animate({path: "M"+startX+" "+startY+"L"+endX+" "+endY}, duration, callback);
		pointer.toFront();
		item.toFront();
		return line;
	}

	function removeLines(lines) {
		for (var i=0; i<lines.length; i++) {
			lines[i].remove();
		}
	}

	function snapX(x) {
		var	xTile = Math.round((x-tileWidth/2)/tileWidth);
		return (xTile+0.5)*tileWidth;
	}

	function snapY(y) {
		var yTile = Math.round((y-tileHeight/2)/tileHeight);
		return (yTile+0.5)*tileHeight;
	}

	var fpSizes = {
		"1" : { width: 688, height: 487},
		"2" : { width: 549, height: 528},
		"3" : { width: 557, height: 523},
		"A" : { width: 636, height: 495},
		"B" : { width: 608, height: 571},
		"C" : { width: 636, height: 494},
	};
	var fpSize = fpSizes[data.location.substring(0,1)];

	var gridHeight = 55;
	var gridWidth = 75;
	var tileWidth = 10;
	var tileHeight = 10;

	var grid = createGrid(data.grid, gridHeight, gridWidth);

	var xTileStart = Math.round((data.start_x-5)/10);
	var yTileStart = Math.round((data.start_y-5)/10);
	var xTileEnd = Math.round((data.end_x-5)/10);
	var yTileEnd = Math.round((data.end_y-5)/10);


	var canvas = Raphael("locator", 750, 565+56);
	var floorPlan = canvas.image("images/"+env+"/"+data.lc+"/"+data.image.replace(".SWF", ".png"),
	 								data.shift_x, data.shift_y,
	 								fpSize.width * data.scale_x, fpSize.height * data.scale_y);
	var legend = canvas.image("images/"+env+"/"+data.lc+"/legend.PNG",
	 								0, parseInt(data.shift_y) + fpSize.height * data.scale_x,
									746, 56);
	var textBox = canvas.rect(15, 15, 120, 80);
		textBox.attr({fill: "90-#ffffff:0-#fffba4:57.36801444242398", "opacity": 0.2, "stroke-width":3, "stroke": "90-#ffffff:0-#fffba4:57.36801444242398"});
	var floor =	canvas.text(73, 57, "Floor " + data.location.substring(0,1));
	floor.attr({'font-size': 30, 'font-weight': 'bold', "opacity": 0.7});
	var path = findPath(grid, yTileStart, xTileStart, yTileEnd, xTileEnd);

	if (path == null) {
		var msg = canvas.text(300, 20,  "The exact location of this book is not specified.\nPlease report this error to us using the contact us link above!");
		msg.attr({'font-size': 15, 'font-weight': 'bold', 'text-anchor': 'start', 'fill': 'red'});
		return;
	}
	var pointer = canvas.circle(snapX(data.start_x), snapY(data.start_y), 1);
		pointer.attr({fill:  "90-#387C44-#52D017"}); //this circle is marking the start location
		pointer.animate({cx:snapX(data.start_x), r:6}, 2000, "bounce");
	var item = canvas.circle(snapX(data.end_x), snapY(data.end_y), 1);
		item.attr({fill: "90-#15317E-#82CAFF" }); // this circle is marking the location of the item
		item.animate({cx:snapX(data.end_x), r:6}, 2000, "bounce");

	var lines = drawPath(canvas, path);
	var dndFunctions = {
		start : function () { // storing original coordinates
		    this.ox = parseInt(this.attr("cx"));
		    this.oy = parseInt(this.attr("cy"));
		},
		move : function (dx, dy) { // move will be called with dx and dy
		    this.attr({cx: this.ox + dx, cy: this.oy + dy, opacity: 0.5});
		},
		up : function (event) { // restoring state
			var posx = 0;
			var posy = 0;
			if (!event) var event = window.event;
			if (event.pageX || event.pageY) 	{
				posx = event.pageX;
				posy = event.pageY;
			}
			else if (event.clientX || event.clientY) 	{
				posx = event.clientX + document.body.scrollLeft
					+ document.documentElement.scrollLeft;
				posy = event.clientY + document.body.scrollTop
					+ document.documentElement.scrollTop;
			}

			this.attr({cx: snapX(posx-22), cy: snapY(posy-60), opacity: 1});

			var	xTileStart = Math.round((posx-22-tileWidth/2)/tileWidth);
			var	yTileStart = Math.round((posy-60-tileHeight/2)/tileHeight);
			var path = findPath(grid, yTileStart, xTileStart, yTileEnd, xTileEnd);
			removeLines(lines);

			if (path != null) {
		 		lines = drawPath(canvas, path);
				pointer.attr({fill: "90-#387C44-#52D017"});
			} else {
				pointer.attr({fill: "90-#FAAFBE-#FF0000"});
			}
		}
	}
	pointer.drag(dndFunctions.move, dndFunctions.start, dndFunctions.up);
}

