Zend Framework 2 And Dojo/Store/JsonRest
========================================

We work mainly with dojo at Go MAD Tech and a few of the prototypes I've been working on use json stores, so it seemed an obvious choice to go for using the Dojo/Store/JsonRest implementation for moving the prototypes into the real world. It means I don't have to worry too much about setting up the xhr myself and leave it all to dojo to deal with.

So this entry will cover setting up dojo 1.8 in the Zend Framework 2 skeleton application, setting up a simple RESTful controller and some javascript to test out the dojo store and the zf2 rest controller.

So we setup the zsa as normal using composer
http://autonomicpilot.co.uk/caps/f9e06d.png

As we're just doing this as an example we'll use the dojo CDN
http://autonomicpilot.co.uk/caps/cff75d.png
and configure dojo
http://autonomicpilot.co.uk/caps/8ee8a4.png

We then need to add a new controller that implements the abstract restful controller
http://autonomicpilot.co.uk/caps/d93cf8.png

We'll keep this simple and knock out some fake responses in a bit.

We need to allow access to the controller so we add a new child route to the application config for the rest controller
http://autonomicpilot.co.uk/caps/a76aa4.png

We then need to add the rest controller to our controller's invokables array
http://autonomicpilot.co.uk/caps/884cfa.png

and then add the JsonViewStrategy to the view_manager configuration, this enables the JsonModel to work without phtml files for automatic json encoding and not displaying the layout
http://autonomicpilot.co.uk/caps/c1d87d.png

We then add json handling in our controller
http://autonomicpilot.co.uk/caps/ec91f7.png

And we can test this action with curl from the command line
http://autonomicpilot.co.uk/caps/8c3e4a.png

Add some fake data
http://autonomicpilot.co.uk/caps/94aff6.png
and test from the command line again
http://autonomicpilot.co.uk/caps/0503a6.png

And then put some more dummy responses into our controller

Add a custom not found action to the controller that returns a json error
http://autonomicpilot.co.uk/caps/38facd.png

First a get with an id param
http://autonomicpilot.co.uk/caps/df3f86.png
and test
http://autonomicpilot.co.uk/caps/1b7747.png
and test failure
http://autonomicpilot.co.uk/caps/1b79f2.png

This will be enough for for testing with the Dojo/Store/JsonRest
as our config puts our zsa dojo modules in /js/zsa we create our file there, 
this file could be spread over an mvc setup, but just the one file for now.

We declare our module with a constructor and mix any properties passed into it into itself.
http://autonomicpilot.co.uk/caps/4201a8.png

We then call our functions for setting up the dom, then creating the store and finally for setting up the select dijit.
And then we write those functions ;)

We setup a container node inside the phtml file and then assign that in our js to a member variable.
http://autonomicpilot.co.uk/caps/858067.png
http://autonomicpilot.co.uk/caps/7bcd04.png

Create a Dojo/Store/JsonRest instance and set the url to point to our rest controller.
http://autonomicpilot.co.uk/caps/ce1cb2.png

Then create an nstance of our select and pass it our JsonRest store and place it inside our node.
http://autonomicpilot.co.uk/caps/6bb132.png

We create a launcher file that we use to instantiate our modules further.
http://autonomicpilot.co.uk/caps/d106b9.png
and append it to our head scripts
http://autonomicpilot.co.uk/caps/2c61f6.png

