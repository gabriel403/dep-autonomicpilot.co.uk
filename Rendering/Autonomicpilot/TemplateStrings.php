<?php
namespace Autonomicpilot;
/**
 * Static class and functions for templates
 * 
 * @package Autonomicpilot
 */
class TemplateStrings
{

    /**
     * Side link text
     * 
     * @param Renderer $renderer Renderer object
     * 
     * @return string
     */
    public static function getSideLinkText(Renderer $renderer)
    {
        $config = Config::getInstance();
        return <<<"SLT"
                    <div class="article_link box0n">
                        <a class="article_link_main" href='{$config->Post->blog_base_url}{$renderer->post->getFilename()}.html'>&nbsp;</a>
                        <div class="article_link_text">
                            <a href="{$config->Post->blog_base_url}#{$renderer->post->getFilename()}">{$renderer->post->getTitle()}</a><br />
                            {$renderer->post->getPublishedDatetime()}{$renderer->post->getCategoryLink()}
                        </div>
                        <br class="clear_both" />
                        <div class="article_tags">
                        {$renderer->post->getTagLinks()}
                        </div>
                    </div>
SLT;
    }

    public static function tagLinkText($tag)
    {
        $config = Config::getInstance();
        return <<< "CLT"
        <a href="{$config->Post->blog_base_url}Tags/$tag.html">$tag</a>
CLT;
    }

    public static function categoryLinkText($category)
    {
        $config = Config::getInstance();
        return <<< "CLT"
        <a href="{$config->Post->blog_base_url}Categories/$category.html">$category</a><br />
CLT;
    }

    /**
     * Small article text
     * 
     * @param Renderer $renderer Renderer object
     * 
     * @return string
     */
    public static function getSmallArticleText(Renderer $renderer)
    {
        $config = Config::getInstance();
        return <<<"SA"
                    <div class="article_content box0n" id="{$renderer->post->getFilename()}">
                        <h1 class="article_title"><a href="{$config->Post->blog_base_url}{$renderer->post->getFilename()}.html">{$renderer->post->getTitle()}</a></h1>
                        {$renderer->post->getMarkdownText()}
                    </div>
SA;
    }


    public static function getMainArticleText(Renderer $renderer)
    {
        $config = Config::getInstance();
        return <<<"MA"
                    <div class="article_content box0n" id="{$renderer->post->getFilename()}">
                        <h1 class="article_title"><a href="{$config->Post->blog_base_url}{$renderer->post->getFilename()}.html">{$renderer->post->getTitle()}</a></h1>
                        {$renderer->post->getMarkdownText()}
                        <a href="#" onclick="showthatshizzle();return false;">Comments</a>
                        <div id="disqus_thread"></div>
                        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    </div>
MA;
    }


    /**
     * Main html template
     * 
     * @param Renderer $renderer Renderer object
     * @return string
     */
    public static function getMainTemplateText(Renderer $renderer)
    {
        $config = Config::getInstance();
        return <<<"MT"
<!DOCTYPE html>
<html>
    <head>
        <title>{$config->Post->prepended_title}</title>
        <link rel="stylesheet" type="text/css" href="{$config->site->css_path}reset.css" />
        <link rel="stylesheet" type="text/css" href="{$config->site->css_path}site.css" />
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Press+Start+2P' />
        <script type="text/javascript">
            var dsloaded = false;
            var disqus_div = 'disqus_thread';
            function showthatshizzle() {
                var disqus_shortname = 'autonomicpilot';

                if ( dsloaded )
                {
                    return;
                }

                dsloaded = true;

                document.getElementById(disqus_div).style.display = 'block';

                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            }
        </script>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-16183577-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>
    <body>
        <div id="main_box">
            <div id="header">
                <a href='/'>&nbsp;</a>
                <div>The 8-bit ramblings of a rabid mind</div>
                <br class="clear_both" />
            </div>
            <div id="top_nav">
                <div class="box0n float_left third_width"><a href="/">Home</a></div>
                <div class="box0n float_left third_width"><a href="{$config->Post->blog_base_url}">Blog</a></div>
                <div class="box0n float_left third_width"><a href="/cv">CV</a></div>
                <br class="clear_both" />
            </div>
            <div id="content_outer">
                <div id="left" class="float_left">
{$renderer->getLinkString()}
                </div>
                <div id="main" class="float_left">
                    <div>
{$renderer->getContentString()}
                    </div>
                </div>
                <div id="right" class="float_left">
                    <div class="box0n">
                        <h2>Tags</h2>
                        <br />
{$renderer->getTagCloud()}
                    </div>
                    <div class="box0n">
                        <h2>Categories</h2>
                        <br />
{$renderer->getCategorySet()}
                    </div>
                </div>
                <br class="clear_both" />
            </div>
        </div>
    </body>
</html>
MT;
    }


    /**
     * Class definition for post properties
     * 
     * @param Renderer $renderer Renderer object
     * 
     * @return string
     */
    public static function getPostClassDefinition(Renderer $renderer) 
    {
        return <<<"PC"
<?php
namespace Post;
use \Autonomicpilot\Post as Post;
class {$renderer->getClassname()} extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        \$this->publishedTime = {$renderer->time()};
        \$this->filename = "{$renderer->getClassname()}";
        \$this->title = "{$renderer->getClassname()}";
        return \$this;
    }
}
PC;
    }

    public static function getSitemap()
    {
        return <<<"SM"
        <?xml version="1.0" encoding="UTF-8"?\>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        {$renderer->getSitemapURLs()}
        </urlset>
SM;

    }

    public static function getSitemapEntry(Renderer $renderer, $spacer)
    {
        $config = Config::getInstance();
        return <<<"SME"
           <url>
              <loc>{$config->site->address}{$config->Post->blog_base_url}{$spacer}{$renderer->post->getFilename()}.html</loc>
              <lastmod>{$renderer->post->getPublishedDatetime()}</lastmod>
              <changefreq>daily</changefreq>
              <priority>0.8</priority>
           </url>
SME;
    }

}

