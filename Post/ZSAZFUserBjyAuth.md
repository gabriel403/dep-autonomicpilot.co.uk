After getting zfuser working well with zsa I wanted to try and get something ACL-like working.

The ZFCACL is a bit out of date BjyAuthentication was recommended as a decent alternative.

http://blackdwarf.autonomicpilot.co.uk/caps/1c9cbe.png


http://blackdwarf.autonomicpilot.co.uk/caps/c11bbc.png
don't strictly need zfc-user as bjyauth installs it, but as this is an extension of the previous I left it in



http://blackdwarf.autonomicpilot.co.uk/caps/8758cd.png

http://blackdwarf.autonomicpilot.co.uk/caps/5ecceb.png

http://blackdwarf.autonomicpilot.co.uk/caps/d8c82e.png

http://blackdwarf.autonomicpilot.co.uk/caps/a2fe19.png

install and enable intl php extension

enable modules
http://blackdwarf.autonomicpilot.co.uk/caps/aa5361.png

add db config
http://blackdwarf.autonomicpilot.co.uk/caps/3e5c0b.png

and we have a working users page
http://blackdwarf.autonomicpilot.co.uk/caps/76a23d.png

and working registration
http://blackdwarf.autonomicpilot.co.uk/caps/de9e0e.png

Next up we want to get the autorisation working, so we can restrict access to certain areas.
http://blackdwarf.autonomicpilot.co.uk/caps/5dcb94.png
The first sections specify providers for how to get current user access etc, we also set up our list of roles, so guest, user with admin extending user, it can also be setup to load roles from the db we set up earlier.
We add a default guard which blocks all access to all controller actions by default :
http://blackdwarf.autonomicpilot.co.uk/caps/ec61a4.png
http://blackdwarf.autonomicpilot.co.uk/caps/6e0eeb.png as you can see we also restrict access to the users controller, which is no good for registering people, so we modify the guard to allow access to actions in the zfcuser controller
http://blackdwarf.autonomicpilot.co.uk/caps/99cc3e.png
this allows all roles to access all actions in the zfcuser controller, if wanted we could restrict so only certain actions are allowed like this
http://blackdwarf.autonomicpilot.co.uk/caps/5d71c5.png
thus we gain access to the user controller for login and registering
http://blackdwarf.autonomicpilot.co.uk/caps/0bebb3.png

There is a controller plugin but it does pretty much the same as we already do, rather than restricting access inside the controller it's another way of checking if the user is allowed.
