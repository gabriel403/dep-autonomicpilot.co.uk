<?php

namespace Autonomicpilot\Renderer;

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
        $Config = Config::getStateO();
        return <<<"SLT"
                    <div class="article_link box0n">
                        <br />
                        <a href="{$Config->blog_base_url}#{$renderer->post->getFilename()}">{$renderer->post->getTitle()}</a>
                        <table><tbody>
                        <tr><td class='enbolden'>Static:</td><td><a class="article_link_main" href='{$Config->blog_posts_url}{$renderer->post->getFilename()}.html'>link</a></td></tr>
                        <tr><td class='enbolden'>Published:</td><td>{$renderer->post->getPublishedDatetime()}</td></tr>
                        <tr><td class='enbolden'>Category:</td><td>{$renderer->post->getCategoryLink()}</td></tr>
                        <tr><td class='enbolden'>Tags:</td><td><div class="article_tags">
                        {$renderer->post->getTagLinks()}
                        </div></td></tr>
                        </tbody></table>
                    </div>
SLT;
    }

    public static function tagLinkText($tag)
    {
        $Config = Config::getStateO();
        return <<< "CLT"
        <a href="{$Config->blog_base_url}Tags/$tag.html">$tag</a>
CLT;
    }

    public static function categoryLinkText($category)
    {
        $Config = Config::getStateO();
        return <<< "CLT"
        <a href="{$Config->blog_base_url}Categories/$category.html">$category</a><br />
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
        $Config = Config::getStateO();
        // var_dump($Config);
        // exit;
        return <<<"SA"
                    <div class="article_content box0n" id="{$renderer->post->getFilename()}">
                        <h1 class="article_title"><a href="{$Config->blog_posts_url}{$renderer->post->getFilename()}.html">{$renderer->post->getTitle()}</a></h1>
                        {$renderer->post->getMarkdownText()}
                    </div>
SA;
    }


    public static function getMainArticleText(Renderer $renderer)
    {
        $Config = Config::getStateO();
        return <<<"MA"
                    <div class="article_content box0n" id="{$renderer->post->getFilename()}">
                        <h1 class="article_title"><a href="{$Config->blog_posts_url}{$renderer->post->getFilename()}.html">{$renderer->post->getTitle()}</a></h1>
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
        $Config = Config::getStateO();
        $site = Config::getInstance()->site;
        $tags = implode(', ', $renderer->post->getTags());
        return <<<"MT"
<!DOCTYPE html>
<html>
    <head>
        <title>{$Config->prepended_title} - {$renderer->post->getTitle()} - {$tags}</title>
        <meta name="description" content="Autonomicpilot is a development blog mainly concerntrating on PHP, MySQL, HTML, dojo js and Zend Framework. {$tags}"></meta>
        <meta name="keywords" content="Autonomicpilot is a development blog mainly concerntrating on PHP, MySQL, HTML, dojo js and Zend Framework. {$tags}"></meta>
        <link rel="stylesheet" type="text/css" href="{$site->css_path}reset.css" />
        <link rel="stylesheet" type="text/css" href="{$site->css_path}site.css" />
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
                <div class="box0n float_left third_width"><a href="{$Config->blog_base_url}">Blog</a></div>
                <div class="box0n float_left third_width"><a href="/cv.html">CV</a></div>
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
                    <div class="box0n">
                        <h2>Twitter</h2>
                        <a class="twitter-timeline" href="https://twitter.com/gabriel403" data-widget-id="333345937793617921" data-chrome="noheader nofooter noborders transparent">Tweets by @gabriel403</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </div>
                <br class="clear_both" />
            </div>
        </div>
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?autoload=true&skin=sons-of-obsidian" defer="defer"></script>
        <script type="text/javascript" src="/js/ga.js"></script>
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
        $Config = Config::getStateO();
        return <<<"PC"
<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class {$renderer->getClassname()} extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
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
        $Config = Config::getStateO();
        return <<<"SM"
        <?xml version="1.0" encoding="UTF-8"?\>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        {$renderer->getSitemapURLs()}
        </urlset>
SM;

    }

    public static function getSitemapEntry(Renderer $renderer, $spacer)
    {
        $Config = Config::getStateO();
        return <<<"SME"
           <url>
              <loc>{Config->site->address}{Config->Post->blog_base_url}{$spacer}{$renderer->post->getFilename()}.html</loc>
              <lastmod>{$renderer->post->getPublishedDatetime()}</lastmod>
              <changefreq>daily</changefreq>
              <priority>0.8</priority>
           </url>
SME;
    }

}

