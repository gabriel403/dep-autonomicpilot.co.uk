Zend Framework 2 And Dojo/Store/JsonRest
========================================

We work mainly with dojo at Go MAD Tech and a few of the prototypes I've been working on use json stores, so it seemed an obvious choice to go for using the Dojo/Store/JsonRest implementation for moving the prototypes into the real world. It means I don't have to worry too much about setting up the xhr myself and leave it all to dojo to deal with.

So this entry will cover setting up dojo 1.8 in the Zend Framework 2 skeleton application, setting up a simple RESTful controller and some javascript to test out the dojo store and the zf2 rest controller.

So we setup the zsa as normal using composer
![](http://blackdwarf.autonomicpilot.co.uk/caps/f9e06d.png)

As we're just doing this as an example we'll use the dojo CDN
![](http://blackdwarf.autonomicpilot.co.uk/caps/cff75d.png)
and configure dojo
![](http://blackdwarf.autonomicpilot.co.uk/caps/8ee8a4.png)

We then need to add a new controller that implements the abstract restful controller
![](http://blackdwarf.autonomicpilot.co.uk/caps/d93cf8.png)

We'll keep this simple and knock out some fake responses in a bit.

We need to allow access to the controller so we add a new child route to the application config for the rest controller
![](http://blackdwarf.autonomicpilot.co.uk/caps/a76aa4.png)

We then need to add the rest controller to our controller's invokables array
![](http://blackdwarf.autonomicpilot.co.uk/caps/884cfa.png)

and then add the JsonViewStrategy to the view_manager configuration, this enables the JsonModel to work without phtml files for automatic json encoding and not displaying the layout
![](http://blackdwarf.autonomicpilot.co.uk/caps/c1d87d.png)

We then add json handling in our controller
![](http://blackdwarf.autonomicpilot.co.uk/caps/ec91f7.png)

And we can test this action with curl from the command line
![](http://blackdwarf.autonomicpilot.co.uk/caps/8c3e4a.png)

Add some fake data   
![](http://blackdwarf.autonomicpilot.co.uk/caps/502486.png)   
and test from the command line again   
![](http://blackdwarf.autonomicpilot.co.uk/caps/fab64d.png)

And then put some more dummy responses into our controller

Add a custom not found action to the controller that returns a json error
![](http://blackdwarf.autonomicpilot.co.uk/caps/cf060c.png)

First a get with an id param   
![](http://blackdwarf.autonomicpilot.co.uk/caps/df3f86.png)   
and test   
![](http://blackdwarf.autonomicpilot.co.uk/caps/9ab748.png)   
and test failure   
![](http://blackdwarf.autonomicpilot.co.uk/caps/ccca93.png)

This will be enough for for testing with the Dojo/Store/JsonRest
as our config puts our zsa dojo modules in /js/zsa we create our file there, 
this file could be spread over an mvc setup, but just the one file for now.

We declare our module with a constructor and mix any properties passed into it into itself.
![](http://blackdwarf.autonomicpilot.co.uk/caps/4201a8.png)

We then call our functions for setting up the dom, then creating the store and finally for setting up the select dijit.

And then we write those functions ;)

We setup an action inside the index controller to work with our test view and then in the view file we setup a container node inside and then assign that in our js to a member variable.  
![](http://blackdwarf.autonomicpilot.co.uk/caps/ec4d3d.png)    
![](http://blackdwarf.autonomicpilot.co.uk/caps/858067.png)   
![](http://blackdwarf.autonomicpilot.co.uk/caps/7bcd04.png)

Create a Dojo/Store/JsonRest instance and set the url to point to our rest controller.   
![](http://blackdwarf.autonomicpilot.co.uk/caps/b54355.png)

Then create an instance of our select and pass it our JsonRest store and place it inside our node.   
![](http://blackdwarf.autonomicpilot.co.uk/caps/bb4235.png)

We create a launcher file that we use to instantiate our modules further.   
![](http://blackdwarf.autonomicpilot.co.uk/caps/d106b9.png)   
and append it to our head scripts   
![](http://blackdwarf.autonomicpilot.co.uk/caps/2c61f6.png)

Then we have the final source for the rest js module   
![](http://blackdwarf.autonomicpilot.co.uk/caps/1f42bd.png)   

And finally look at the view we created
![](http://blackdwarf.autonomicpilot.co.uk/caps/5e398b.png)

This is on github for viewing   
https://github.com/gabriel403/ZendSkeletonApplication/tree/dojoreststore   
with the diff of changes here   
https://github.com/gabriel403/ZendSkeletonApplication/commit/8196a0f2fdc013a081e3732c965ec63cc1bda848

