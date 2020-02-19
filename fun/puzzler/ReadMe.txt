"Puzzler" is a fun and interactive game that illustrates the use of web standards and JavaScript for the iPhone. 
To play the game, tap on any ball horizontally or vertically adjacent to a ball of the same color; the matching balls will turn grey; tap any of the grey ball to remove the selection; tap elsewhere to unselect the balls.

This sample contains the "index.html", "Puzzler.js" and "Puzzler.css" files. The "index.html" file defines the game layout;  the "Puzzler.js" contains all functionalities required to implement the game; the "Puzzler.css", which is not important for the functionality of this sample, adjusts content on the "Puzzler" page.

"Puzzler" uses the setup function, which is included in the "Puzzler.js" file, to create a grid whose content is dynamically added or removed. The setup function invokes the resetGrid method that clears or removes all balls on the grid, then adds seven rows and columns to the grid. Each cell of the grid contains a ball whose color could be yellow, light blue, green, dark blue or red. 

"Puzzler" uses 2-dimension arrays to keep track of all balls in the game. The grid array contains all balls on the grid. The selected array takes true or false values; true indicates that users click on a ball at a given position. The dirty structure contains true or false values; true means that a ball at a given position is grey. The click function handles any tap or click on the grid. The updateAllDirtyCells function checks the dirty array for any true values, then  inserts grey balls at the appropriate positions. 


Using the Sample
Open index.html in Safari 3 on either Mac or PC. If you have your own webserver (eg. Mac OS X Personal Web Server) and an iPhone or iPod touch, you can also place these files on your server and browse them using your iPhone or iPod touch.


Changes from Previous Versions
Reduced the size of the board for better layout on the iPhone screen. Added a "ReadMe" file and more comments in the "Puzzler.js" file.
Updated the doctype declaration and viewport meta in the "index.html" file. The viewport meta width  was set to the device-width constant. Using the device-width constant removes the "viewport width or height set to physical device width" warning message on iPhone or iPod touch. 


Feedback and Bug Reports
Please send all feedback about this sample by connecting to the Contact ADC <http://developer.apple.com/contact/feedback.html> page.
Please submit any bug reports about this sample to the Bug Reporting <http://developer.apple.com/bugreporter> page.


Developer Technical Support
The Apple Developer Connection Developer Technical Support (DTS) team is made up of highly qualified engineers with development expertise in key Apple technologies. Whether you need direct one-on-one support troubleshooting issues, hands-on assistance to accelerate a project, or helpful guidance to the right documentation and sample code, Apple engineers are ready to help you.  Refer to the Apple Developer Technical Support <http://developer.apple.com/technicalsupport/> page.
Copyright © 2007 Apple Inc. All rights reserved.