/*
PATHFINDING FUNCTION
note: adapted from astar.as
*/

function findPath(map, startY, startX, endY, endX) {
  // Finds the way given a certain path

  // Constants/configuration - change here as needed! --------------------------------
  var HV_COST = 10; // "Movement cost" for horizontal/vertical moves
  var D_COST = 14; // "Movement cost" for diagonal moves
  var ALLOW_DIAGONAL = false; // If diagonal movements are allowed at all
  var ALLOW_DIAGONAL_CORNERING = false; // If diagonal movements over corners are allowed

  // Complimentary functions =========================================================
    
  var isOpen = function (y, x) {
    // Return TRUE if the point is on the open list, false if otherwise
    if (mapStatus[y][x] == null)
        return false;
    return mapStatus[y][x].open;
  };
  var isClosed = function (y, x) {
    if (mapStatus[y][x] == null)
        return false;
    // Return TRUE if the point is on the closed list, false if otherwise
    return mapStatus[y][x].closed;
  };
  var nearerSquare = function() {
    // Returns the square with a lower movementCost + heuristic distance
    // from the open list
    var minimum = 999999;
    var indexFound = 0;
    var thisF = undefined;
    var thisSquare = undefined;
    var i = openList.length;
    // Finds lowest
    while (i-->0) {
      thisSquare = mapStatus[openList[i][0]][openList[i][1]];
      thisF = thisSquare.heuristic + thisSquare.movementCost;
      if (thisF <= minimum) {
        minimum = thisF;
        indexFound = i;
      }
    }
    // Returns lowest
    return indexFound;
  };
  
  var closeSquare = function(y, x) {
    // Drop from the open list
    var len = openList.length;
    for (var i=0; i < len; i++) {
      if (openList[i][0] == y) {
        if (openList[i][1] == x) {
          openList.splice(i, 1);
          break;
        }
      }
    }
    // Closes an open square
    mapStatus[y][x].open = false;
    mapStatus[y][x].closed = true;
  };
  
  var openSquare = function(y, x, parent, movementCost, heuristic, replacing) {
    // Opens a square
    if (!replacing) {
      openList.push([y,x]);
      mapStatus[y][x] = {heuristic:heuristic, open:true, closed:false};
    }
    mapStatus[y][x].parent = parent;
    mapStatus[y][x].movementCost = movementCost;
  };

  // Ok, now go back to our regular schedule. Find the path! -------------------------

  // Caches dimensions
  var mapH = map.length;
  var mapW = map[0].length;

  // New status arrays
  var mapStatus = new Array();
  for (var i=0; i<mapH; i++) mapStatus[i] = new Array();

  if (startY == undefined || startX == undefined) return null; // Error: no starting point
  if (endY == undefined || endX == undefined) return null; // Error: no ending point

  // sanity check, if start/end point is already a closed tile, then just return null
  if (map[startY][startX] == 0 || map[endY][endX] == 0) return null;
  
  // Now really starts
  var openList = new Array();
  openSquare (startY, startX, undefined, 0);
  
  // Loops until there's no other way to go OR found the exit
  while (openList.length > 0 && !isClosed(endY, endX)) {
    // Browse through open squares
    var i = nearerSquare();

	var nowY = openList[i][0];
	var nowX = openList[i][1]; 
    
    // Closes current square as it has done its purpose...
    closeSquare (nowY, nowX);
    // Opens all nearby squares, ONLY if:
    for (var j=nowY-1; j<nowY+2; j++) {
      for (var k=nowX-1; k<nowX+2; k++) {
        if (j >= 0 && j < mapH 
            && k >= 0 && k < mapW 
            && !(j==nowY && k==nowX) 
            && (ALLOW_DIAGONAL || j==nowY || k==nowX) 
            && (ALLOW_DIAGONAL_CORNERING || j==nowY || k==nowX 
                || (map[j][nowX] != 0 && map[nowY][k]))
            ) {
          // If not outside the boundaries or at the same point or a diagonal (if disabled) or a diagonal (with a wall next to it)...
          if (map[j][k] != 0) {
            // And if not a wall...
            if (!isClosed(j,k)) {
              // And if not closed... THEN open.
              var movementCost = mapStatus[nowY][nowX].movementCost + ((j==nowY || k==nowX ? HV_COST : D_COST) * map[j][k]);
              if (isOpen(j,k)) {
                // Already opened: check if it's ok to re-open (cheaper)
                if (movementCost < mapStatus[j][k].movementCost) {
                  // Cheaper: simply replaces with new cost and parent.
                  openSquare (j, k, [nowY, nowX], movementCost, undefined, true); // heuristic not passed: faster, not needed 'cause it's already set
                }
              } else {
                // Empty: open.
                var heuristic = (Math.abs (j - endY) + Math.abs (k - endX)) * 10;
                openSquare (j, k, [nowY, nowX], movementCost, heuristic, false);
              }
            } else {
              // Already closed, ignore.
            }
          } else {
            // Wall, ignore.
          }
        }
      }
    }
  }
  // Ended
  var pFound = isClosed(endY, endX); // Was the path found?
  // Clean up temporary functions
  delete isOpen;
  delete isClosed;
  delete nearerSquare;
  delete closeSquare;
  delete openSquare;
  if (pFound) {
    // Ended with path found; generates return path
    var returnPath = new Array();
    var nowY = endY;
    var nowX = endX;
    while ((nowY != startY || nowX != startX)) {
      returnPath.push([nowY,nowX]);
      var newY = mapStatus[nowY][nowX].parent[0];
      var newX = mapStatus[nowY][nowX].parent[1];
      nowY = newY;
      nowX = newX;
    }
    returnPath.push([startY,startX]);
    return (returnPath);
  } else {
    // Ended with 0 open squares; ran out of squares, path NOT found
    return null;
  }
};