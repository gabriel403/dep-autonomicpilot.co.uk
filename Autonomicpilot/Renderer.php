<?php
/**
 * Renderer file
 */
namespace Autonomicpilot;
/**
 * Renderer class
 * 
 * @package Autonomicpilot
 */
class Renderer
{
    /** @var array */
    private $posts = [];
    /** @var string */
    private $content = [];
    /** @var string */
    private $links = [];
    /** @var string */
    private $classname = "";
    /** */
    public $config = [];


    /** @var Autonomicpilot\Post */
    public $post;


    /**
     * 
     * @return int
     */
    public function time()
    {
        return time();
    }


    /**
     * 
     * @return string
     */
    public function getClassname()
    {
        return $this->classname;
    }


    /**
     * 
     * @return string
     */
    public function getContentString()
    {
        return implode($this->content);
    }


    /**
     * 
     * @return string
     */
    public function getLinkString()
    {
        return implode($this->links);
    }


    /**
     * 
     * @return void
     */
    public function preRenderConsumption()
    {
        if ($handle = opendir('Post')) {

            while (false !== ($entry = readdir($handle))) {
                $pathInfo = pathinfo("Post/$entry");
                if ( "md" != $pathInfo["extension"] ) {
                    continue;
                }
                $this->posts[$pathInfo["filename"]] = 1;

            }
            closedir($handle);

        } else {
            die("Failed to open Post directory.");
        }
    }


    /**
     * 
     * @return void
     */
    public function renderMainPage()
    {
        $config = Config::getInstance();
        $pp = $config->Post->post_path;
        $cp = $config->Post->content_path;

        foreach ($this->posts as $filename => $markdown) {
            $this->classname = $filename;

            if ( !class_exists("$pp\\$filename") ) {
                file_put_contents("$pp/$filename.php", TemplateStrings::getPostClassDefinition($this));
            }

            $class          = "$pp\\$filename";

            $this->post     = new $class();

            $this->content[$this->post->getPublishedDatetime()] = TemplateStrings::getSmallArticleText($this);
            $this->links[$this->post->getPublishedDatetime()]   = TemplateStrings::getSideLinkText($this);
        }

        krsort($this->content);
        krsort($this->links);

        $output = TemplateStrings::getMainTemplateText($this);
        if ( file_exists("$cp/index.html") ) {
            unlink("$cp/index.html");
        }
        file_put_contents("$cp/index.html", $output);
    }


    /**
     * 
     * @return void
     */
    public function renderArticlePages()
    {
        $config = Config::getInstance();

        $cp = $config->Post->content_path;

        foreach ($this->posts as $filename => $markdown) {
            $class          = "Post\\$filename";

            $this->post     = new $class();

            $this->content  = [TemplateStrings::getSmallArticleText($this)];

            $output         = TemplateStrings::getMainTemplateText($this);
            if ( file_exists("$cp/$filename.html") ) {
                unlink("$cp/$filename.html");
            }
            file_put_contents("$cp/$filename.html", $output);
        }
    }
}