autonomicpilot.co.uk
====================
A simple PHP driven blog using mark down parsed into html and rendered statically.
----------------------------------------------------------------------------------

Content is written in markdown files in the Post folder, if extended properties are needed these can be placed in a php file of the same name which extends the Post abstract, if this is not provided it will be generated and initially set post created time as time() and the blog entry title as the filename.
Running the GenerateAll.php file will parse the markdown files and render them into static html files inside the content directory.
It will also create the central index.html with all blog entries listed shown in brief as well as a list of links on lhs to individual blog entries.

CHANGELOG:

0.3

* Reluctantly added abstract properties file associated with the markdown files.
* Added properties file generator
* Implemented psr-0 autoloader
* Renamed markdown directory to Post directory
* Added more UI work, logo, css, reworked links
* Reworked generator

0.2

* Reworked include system for main page.
* Added links to blog post on side bar.
* Improved some ui.

0.1

* Initial work done on markdown parsing into html.
