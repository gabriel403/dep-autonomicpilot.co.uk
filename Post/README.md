autonomicpilot.co.uk
====================
A simple PHP driven blog using mark down parsed into html and rendered statically.
----------------------------------------------------------------------------------

Content is written in markdown files in the Post folder, if extended properties are needed these can be placed in a php file of the same name which extends the Post abstract, if this is not provided it will be generated and initially set post created time as time() and the blog entry title as the filename.
Running the GenerateAll.php file will parse the markdown files and render them into static html files inside the content directory.
It will also create the central index.html with all blog entries listed shown in brief as well as a list of links on lhs to individual blog entries.

Requirements:
PHP5.4 on the rendering system.
Simple HTML server for hosting the site.

CHANGELOG:

0.5

* Added disqus commenting system
* Moved disqus' js loading to an onclick
* Added some codesniffer stuff

0.4

* Reworked backend to be more object oriented
* Reworked backend classnames to use namespaces
* Removed template files and converted to static strings & heredocs using properties
* Added some basic phpdoc
* Added some basic configuration
* Renamed the content dir to Content
* Centralised generation into a single script and moved generation files into a single Renderer file
* Posts now sort by date of creation in descending order
* Post titles are now read to create links, and also header inside the post
* #refs inside individual entries now return to main page to go to anchors
* Replaced hardcoded directory refs to config refs

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
