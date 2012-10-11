ZSA And Db Driven Translation
=============================

I recently had need to do some translations with ZF2, the current state of ZF2 means that you can only load translations from files so I decided to take this oppertunity to experiment with creating my own module for doing it.

[DASPRiD](http://www.dasprids.de/blog/2012/08/23/feeding-zend-i18n-translator-from-a-database) had already had a bash at creating something for this but unfortunately it didn't work, I was able to take the code and work with it to produce this module.

There's a generic [Zend Skeleton Module](https://github.com/zendframework/ZendSkeletonModule) which I cloned locally and created my own [GitHub repo](https://github.com/gabriel403/G403Translator) for storing the final product. It's also published in [Packagist](http://packagist.org/packages/gabriel403/g403-translator) so it's dead easy to install.

So first we fork or clone the ZendSkeleton Application and then checkout a new branch to work on  
![](http://autonomicpilot.co.uk/caps/ad4c7e.png)  
we edited the composer.json to get the latest version of ZF2 and also to fetch our G403Translation module  
![composer.json file](http://autonomicpilot.co.uk/caps/cb8da4.png)

Then we get composer to install our modules for us 
![composer install command](http://autonomicpilot.co.uk/caps/973717.png)

After that we set up our db and user and imported our SQL that's in the README.md for the module ![sql](http://autonomicpilot.co.uk/caps/31434f.png) Here we're using custom table names, the default assumed within the module are zend_locale and zend_translate_message.

Then we set up the db connection within the code itself 
![db connection config file](http://autonomicpilot.co.uk/caps/811988.png)  
this file is within config/autoload/ and also another file for setting up the translator, as with all configs this can be done in a module config or in the config/autoload/ directory in this example inside the autload config 
![translator config file](http://autonomicpilot.co.uk/caps/d4a006.png)

We then insert some data into the tables 

![locale table](http://autonomicpilot.co.uk/caps/d24bcf.png)
![messages table](http://autonomicpilot.co.uk/caps/0804cf.png)

And we can see the change in our Zend Skeleton Application from
![Original ZSA](http://autonomicpilot.co.uk/caps/c12fb6.png) 
to
![New ZSA](http://autonomicpilot.co.uk/caps/fb2cdb.png)

Tah dah!

To learn a bit about plurals read [here.](http://translate.sourceforge.net/wiki/l10n/pluralforms)