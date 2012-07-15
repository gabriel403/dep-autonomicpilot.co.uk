So I've been playing a lot with [zf2](https://github.com/zendframework/zf2/) recently and inspired by [EvanDotPro's post](http://blog.evan.pro/getting-started-with-the-zf2-skeleton-and-zfcuser) on getting things working using pure git I thought I'd throw one up using composer+git.

So after forking the [Zend Skeleton Application](https://github.com/zendframework/ZendSkeletonApplication) I got one with working with it locally, I cloned the remote repo and checked out a new branch for playing with ![zsa cloning](http://autonomicpilot.co.uk/caps/e73ec8.png)

I then edited the composer.json file to fetch [ZfcUser](https://github.com/ZF-Commons/ZfcUser) which in turn fetches [ZfcBase](https://github.com/ZF-Commons/ZfcBase) like this ![zsa composer.json editing](http://autonomicpilot.co.uk/caps/3d49ea.png)

I then proceeded to get composer to install Zend Framework as well as the other dependencies list (zfuser etc) ![composer install](http://autonomicpilot.co.uk/caps/7c7105.png)

And it all worked lovely, using just php's inbuilt webserver. ![phps webserver](http://autonomicpilot.co.uk/caps/03d9e2.png) ![zsa initial load](http://autonomicpilot.co.uk/caps/256488.png)

I then added the new modules to application configuration ![application config for new mods](http://autonomicpilot.co.uk/caps/888d7e.png). You may be thinking there's some trickery going on the get zf-commons/zfc-user loading as ZfcUser, and you'd be right ![zfc trickery](http://autonomicpilot.co.uk/caps/2fa6e8.png)

And then I set up the sqlite db using the schema that comes with ZfcUer ![sqlite schema setup](http://autonomicpilot.co.uk/caps/351dc9.png) and added the file for local database configuration ![db config](http://autonomicpilot.co.uk/caps/49d299.png)

The next time I ran the webserver I was able to navigate to /user and get to a lovely login page.

![zfcuser login page](http://autonomicpilot.co.uk/caps/76a23d.png)

It was all just that easy to get going!

Have a look on [github](https://github.com/gabriel403/ZendSkeletonApplication/tree/ZFCUser)