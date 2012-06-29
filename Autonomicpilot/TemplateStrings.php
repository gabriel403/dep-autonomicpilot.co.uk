<?php
/**
 *
 */
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
        return <<<"EOT"
<div class="article_link">
    <div>
        <a href="{$renderer->bbu}#{$renderer->post->getFilename()}">{$renderer->post->getTitle()}</a><br />
        {$renderer->post->getPublishedDatetime()}
    </div>
    <a class="article_link_main" href='{$renderer->bbu}{$renderer->post->getFilename()}.html'>&nbsp;</a>
</div>
EOT;
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
        return <<<"SA"
<div class="article_content" id="{$renderer->post->getFilename()}">
    <h1 class="article_title"><a href="{$renderer->bbu}{$renderer->post->getFilename()}.html">{$renderer->post->getTitle()}</a></h1>
    {$renderer->post->getMarkdownText()}
</div>
SA;
    }


    /**
     * Main html template
     * 
     * @param Renderer $renderer Renderer object
     * 
     * @return string
     */
    public static function getMainTemplateText(Renderer $renderer)
    {
        return <<<"MT"
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="reset.css" />
        <link rel="stylesheet" type="text/css" href="site.css" />
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Press+Start+2P' />
        <script type="text/javascript">
            var dsloaded = false;
            function showthatshizzle() {
                if ( dsloaded )
                    return false;
                disqus_shortname = 'autonomicpilot';
                dsloaded = true;

                document.getElementById('disqus_thread').style.display = 'block';

                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            }
        </script>

    </head>
    <body>
        <div id="main_box">
            <div id="header">
                <a href='/'>&nbsp;</a>
                <div>The 8-bit ramblings of a rabid mind</div>
            </div>
            <div id="content_outer">
                <div id="left" class="float_left">
                    {$renderer->getLinkString()}
                </div>
                <div id="main" class="float_left">
                    {$renderer->getContentString()}
                    <a href="#" onclick="showthatshizzle();return false;">Comments</a>
                    <div id="disqus_thread" style="display: none;"></div>
                    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
                <div id="right" class="float_left">&nbsp;</div>
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

}

