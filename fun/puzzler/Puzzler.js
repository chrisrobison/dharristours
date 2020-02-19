//Puzzler draws a grid with 7 columns and rows
var numberOfColumns = 8;
var numberOfRows = 8;

//The grid array contains numbers ranging from 1 to 5, which represent 5 different ball images.
var grid = [], score = 0;

//The selected array contains either true or false. True indicates that the current cell is selected (a user clicked on the ball)
var selected = [];

//The dirty array contains either true or false values. True indicates that the current cell contains a grey ball
var dirty = [];
var allowClicks = true;

//Remove all the DOM elements of the grid
function removeAllChildren(parent) {
   while (parent.hasChildNodes()) {
      parent.removeChild(parent.firstChild);
   }
}

//Initialize or Reinitialize the grid. Remove all balls on the grid.
function resetGrid() {
   grid = new Array(numberOfColumns);
   selected = new Array(numberOfColumns);
   dirty = new Array(numberOfColumns);

   for (var column = 0; column < numberOfColumns; column++) {
      grid[column] = new Array(numberOfRows);
      selected[column] = new Array(numberOfRows);
      dirty[column] = new Array(numberOfRows);

      for (var row = 0; row < numberOfRows; row++) {
         //Generate numbers ranging from 1 to 5 randomly. Use the yellow ball if number is 1,light blue ball if number is 2,
         //green ball if number is 3, dark blue ball if number is 4, red ball if number is 5
         var ballNumber = 1 + Math.floor(Math.random() * 5);
         grid[column][row] = ballNumber;

         //No ball is selected initially
         selected[column][row] = false;

         //The grid does contain any grey ball initially
         dirty[column][row] = false;
      }
   }
}

//Set up the game on the page using DOM elements
function setup() {
   //Remove any current ball on the grid 
   resetGrid();
   score = 0;
   updateScore(0);

   var gridTable = $("#grid"); // document.getElementById('grid');
   gridTable.html("");
   // removeAllChildren(gridTable);

   //Loop thru the grid, Create 7 rows, add them to the grid.
   //For each row, generate 7 columns that contain each an image
   for (var row = 0; row < numberOfRows; row++) {
      //Create a row 
      var gridRow = $("<tr/>"); // document.createElement('tr');

      //Create 7 columns for the row generated above
      for (var column = 0; column < numberOfColumns; column++) {
         //Create a new column 
         var gridColumn = $("<td/>"); // document.createElement('td');

         //Create a new image 
         // var img = document.createElement('img');
         var img = $("<img/>").attr( { 
            "src": "ball-" + grid[column][row] + ".png", 
            "id": column + "_" + row,
            "title": "Column: " + column + "\nRow: " + row + "\nBall: " + grid[column][row],
            "numberOfColumns": 32,
            "numberOfRows": 32,
            "width": 40,
            "height": 40,
            "class": "ball"
         });
                        
         //Set the image attributes
         /* img.setAttribute("onclick", "click(" + column + "," + row + ")");
         img.setAttribute("src", "ball-" + grid[column][row] + ".png");
         img.setAttribute("id", column + "_" + row);
         img.setAttribute("numberOfColumns", 32);
         img.setAttribute("numberOfRows", 32);
         img.setAttribute("width", 40);
         img.setAttribute("height", 40);
         */

         //Append the new image to this column 
         gridColumn.append(img);

         //Add this column to the curent row 
         gridRow.append(gridColumn);
      }
      //Add this row to the grid 
      gridTable.append(gridRow);
   }
}

//Update image at position represented by (column,row)
function updateCell(column, row) {
   var newSrc;

   //Append a grey ball at the position given by (column, row) if the current ball is selected
   if (selected[column][row]) {
      newSrc = "ball-sel.png";
   } else {
      //Append a ball at the position given by (column, row) if the current ball is not selected
      //The color of the ball is determined by grid[column][row], which returns a number ranging from 1 to 5
      newSrc = "ball-" + grid[column][row] + ".png"
   }
   document.images[column + "_" + row].src = newSrc;
}

//Update all images on the grid 
function updateAllCells() {
   //Loop thru all rows and columns, then update each image at position specified by column and row
   for (var row = 0; row < numberOfRows; row++) {
      for (var column = 0; column < numberOfColumns; column++) {
         updateCell(column, row);
      }
   }
}

//Check the dirty array for any true value, if true is found at a position(column,row), update the associated cell
function updateAllDirtyCells() {
   for (var row = 0; row < numberOfRows; row++) {
      for (var column = 0; column < numberOfColumns; column++) {
         if (dirty[column][row]) {
            //Place a grey ball at this position
            updateCell(column, row);
            dirty[column][row] = false;
         }
      }
   }
}

//Remove all selected balls on the grid 
function removeSelectedCells() {
   var amt = 1;
   for (var row = 0; row < numberOfRows; row++) {
      for (var column = 0; column < numberOfColumns; column++) {
         if (selected[column][row]) {
            updateScore(amt);
            amt++;
            //Remove the ball at this position
            grid[column][row] = 0;
            selected[column][row] = false;
            dirty[column][row] = true;
         }
      }
   }
}
function showGrid(who) {
   var what, out, all = "";
   for (var row=0; row < numberOfRows; row++) {
      out = "";
      for (var col=0; col < numberOfColumns; col++) {
         if ((who[col][row] === true) || (who[col][row] === false)) {
            what = (who[col][row] === false) ? 0 : 1;
         } else {
            what = who[col][row];
         }
         out += what;
      }
      console.log(out);
      all += out + "\n";
   }
   return all;
}

//Look for empty cells along the vertical axis on the grid 
function fallDown() {
   var fallTo, foundGap;
   for (var column = numberOfColumns - 1; column >= 0; column--) {
      //Indicate whether a ball at a given position is grey 
      foundGap = false;
      for (var row = numberOfRows - 1; row >= 0; row--) {
         //Check if cell at position(column,row) is empty
         if (grid[column][row] == 0) {
            if (!foundGap) {
               //Get position (along the vertical axis) of the cell that contains a grey ball 
               fallTo = row;
               foundGap = true;
            }
         } else {
            //If cell contains a ball, check if the ball is grey 
            if (foundGap) {
               //Insert a new ball at this position  
               grid[column][fallTo] = grid[column][row];
               grid[column][row] = 0;
               dirty[column][fallTo] = true;
               dirty[column][row] = true;
               fallTo -= 1;
            }
         }
      }
   }
}

//Look for empty cells along the horizontal axis on the grid 
function fallRight() {
   var fallTo, foundGap;
   for (var row = numberOfRows - 1; row >= 0; row--) {
      //Indicate whether a ball at a given position is grey 
      foundGap = false;
      for (var column = numberOfColumns - 1; column >= 0; column--) {
         //Check if cell at position(column,row) is empty
         if (grid[column][row] == 0) {
            if (!foundGap) {
               //Get position (along the horizontal axis) of the cell that contains a grey ball
               fallTo = column;
               foundGap = true;
            }
         } else {
            //Check if cell at position(column,row) contains a grey ball
            if (foundGap) {
               //Insert a new ball at this position  
               grid[fallTo][row] = grid[column][row];
               grid[column][row] = 0;
               dirty[fallTo][row] = true;
               dirty[column][row] = true;
               fallTo -= 1;
            }
         }
      }
   }
}

//Unselect all balls on the grid 
function deselectAllCells() {
   for (var row = 0; row < numberOfRows; row++) {
      for (var column = 0; column < numberOfColumns; column++) {
         //Remove position from the selected array 
         if (selected[column][row]) {
            selected[column][row] = false;

            //Set value to true, so grey ball can be added at that position
            dirty[column][row] = true;
         }
      }
   }
}

//Determines whether each of the 4 neighbors(top,bottom,left, and right) of a
//cell is equal to that current cell
function cellHasIdenticalNeighbour(column, row) {
   var cell = grid[column][row];
   if ( (parseInt(column) + 1 < numberOfColumns && cell == grid[parseInt(column) + 1][row]) || (parseInt(column) - 1 >= 0 && cell == grid[parseInt(column) - 1][row]) || (parseInt(row) + 1 < numberOfRows && cell == grid[column][parseInt(row) + 1]) || (parseInt(row) - 1 >= 0 && cell == grid[column][parseInt(row) - 1])) {
      return true;
   } else {
      return false;
   }
}

//Select all contiguous cells of the same color
function selectCellAndContiguousCells(cell, column, row) {
   if (column >= 0 && column < numberOfColumns && row >= 0 && row < numberOfRows) {
      if (cell == grid[column][row] && !selected[column][row]) {
         selected[column][row] = true;
         dirty[column][row] = true;
         selectCellAndContiguousCells(cell, parseInt(column) + 1, row);
         selectCellAndContiguousCells(cell, parseInt(column) - 1, row);
         selectCellAndContiguousCells(cell, column, parseInt(row) + 1);
         selectCellAndContiguousCells(cell, column, parseInt(row) - 1);
      }
   }
}

function updateScore(amt) {
   score += amt;
   $("#score").text(score);
}

//Update cells along the horizontal axis
function fallRightAndAllowClicks() {
   fallRight();
   updateAllDirtyCells();
   allowClicks = true;
}

//Update all cells on the grid
function fallDownThenFallRightAndAllowClicks() {
   fallDown();
   updateAllDirtyCells();
   fallRightAndAllowClicks();
}

//Handle clicks on the grid 
function click(column, row) {
   if (!allowClicks) {
      return;
   }

   // if a given cell is selected
   if (selected[column][row]) {
      // remove all selected cells
      removeSelectedCells();

      //Check the grid for selected values, then add grey balls at their positions
      updateAllDirtyCells();

      allowClicks = false;
      setTimeout("fallDownThenFallRightAndAllowClicks();", 100);
   } else if (grid[column][row] != 0) {
      //If a given cell is not selected, but contains a ball, deselect all cells
      deselectAllCells();

      //Check whether there is an adjacent cell of the same color
      if (cellHasIdenticalNeighbour(column, row)) {
         //select all contiguous cells of the same color
         selectCellAndContiguousCells(grid[column][row], column, row);
      }
      updateAllDirtyCells();
   }
}
