<?php
/**
 *
 */
namespace Autonomicpilot;
class TemplateStrings
{

    /**
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
     * @return string
     */
    public static function getPostClassDefinition(Renderer $renderer) {
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

