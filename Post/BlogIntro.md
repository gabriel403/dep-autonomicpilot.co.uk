Blog Intro
==========

I thought it was appropriate that the first blog post on my new blog (apart from the changelog) was about how I developed my blog!

I've been meaning to write my own blog for a while now, I've never been fully happy with Wordpress. I was going to try and produce one with [Zend Framework 2](https://github.com/zendframework/zf2/), [node.js](http://nodejs.org/), Python, CouchDB, whatever fancy is currently on my mind. Whilst moving my blog between various VPSes, looking for the cheapest and best, I managed to lose my database backups.

So I was without a blog for a few months whilst I was deciding what to do, then I came upon a blog post by [Matthew Weier O'Phinney](http://mwop.net/blog/2012-05-developing-a-zf2-blog.html) describing how he created a markdown to html converter using Zend Framework 2 and his own custom ZF2 blog module. I liked his approach of just rendering html and also leaving commenting up to a dedicated system.

However I didn't feel the need for using a full framework, so I started developing my own simple no framework blog.

I made the choice to use markdown to create the blog posts as they are somewhat easier to read than html,  I used the markdown extra library. The GenerateAll file instantiates the renderer which loops through the markdown files checking for a corresponding properties file to pull some more information for the blog post. If it doesn't exist a default properties file is generated and saved. The markdown and properties file are kept seperate as I find it easier to free type the post without interference. The markdown and properties files are parsed into html using heredocs stored in a template strings file.

The properties file has properties for categories and tags which will later be parsed for category links and a tag cloud.

By running the renderer on the local machine and using git for the deployment it reduces resources on the live server by only having static html being rendered. Using git remotes also makes deployment a breeze, I can commit/render/test locally, then deploy to the remote webserver(s) and finally to github for storage.