<?php

namespace Autonomicpilot\Renderer;

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

    public $tags = [];
    public $categories = [];
    public $sitemapURLs = "";

    /** @var Autonomicpilot\Post */
    public $post = null;

    // public function getSitemapURLs() {
    //     foreach ( $this->posts as $post )
    //     {
    //         $this->post = $post;
    //         TemplateStrings::getSitemapEntry($this, "");
    //     }
    //     foreach ( $this->tags as $tag => $posts )
    //     {
    //         $this->post = $posts[0];
    //         TemplateStrings::getSitemapEntry($this, "Tags/");
    //     }
    //     foreach ( $this->categories as $category => $posts )
    //     {
    //         $this->post = $posts[0];
    //         TemplateStrings::getSitemapEntry($this, "Categories/");
    //     }
    // }

    public function init() {
        //$this->posts        = [];
        $this->content      = [];
        $this->links        = [];
        $this->classname    = "";
        $this->tags         = [];
        $this->categories   = [];
        $this->sitemapURLs  = "";
        $this->post         = null;
        return $this;
    }

    public function getTagCloud()
    {
        $return = "";
        foreach ( $this->tags as $tag => $tagPosts )
        {
            $return .= TemplateStrings::tagLinkText($tag).":".count($tagPosts);
        }
        return $return;
    }

    public function getCategorySet()
    {
        $return = "";
        foreach ( $this->categories as $category => $categoryPosts )
        {
            $return .= TemplateStrings::categoryLinkText($category);
        }
        return $return;
    }


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
        return $this;
    }


    /**
     *
     * @return void
     */
    public function renderMainPage()
    {
        $this->links = [];
// var_dump(Config::setup());
// Config::setState('beta');
// var_dump(Config::$state);
// exit;
        $pp = Config::$state->post_path;

        foreach ($this->posts as $filename => $markdown) {
            $this->classname = $filename;

            if ( !class_exists("Post\\$filename") ) {
                file_put_contents(getcwd()."$pp/$filename.php", TemplateStrings::getPostClassDefinition($this));
            }

            $class          = "Post\\$filename";

            $this->post     = new $class();

            switch(Config::getState()) {
                case "beta":
                    if ( $this->post->getIsPublished() ) {
                        continue 2;
                    }
                    break;
                default:
                    if ( !$this->post->getIsPublished() ) {
                        continue 2;
                    }
                    break;
            }

            $cp = Config::$state->content_path;

            if ( "" !== $this->post->getCategory())
            {
                $this->categories[$this->post->getCategory()][] = $this->post;
            }

            foreach ( $this->post->getTags() as $tag )
            {
                $this->tags[$tag][$this->post->getPublishedTimestamp()] = $this->post;
            }

            $this->content[$this->post->getPublishedTimestamp()] = TemplateStrings::getSmallArticleText($this);
            $this->links[$this->post->getPublishedTimestamp()]   = TemplateStrings::getSideLinkText($this);
        }
        krsort($this->content);
        krsort($this->links);

        if ( is_null($this->post) ) {
            return $this;
        }

        $this->post->setTitle("Blog");
        $this->post->setTags([]);

        $output = TemplateStrings::getMainTemplateText($this);
        if ( file_exists(getcwd()."$cp/index.html") ) {
            unlink(getcwd()."$cp/index.html");
        }
        file_put_contents(getcwd()."$cp/index.html", $output);

        return $this;
    }

    public function renderTagPages()
    {
        $pp = Config::$state->post_path;
        $cp = Config::$state->content_path;

        $output = "";
        foreach ( $this->tags as $tag => $tagPosts )
        {
            $output = "";
            $this->content = [];
            $this->links = [];
            krsort($tagPosts);
            $genericTags = [];
            foreach ( $tagPosts as $tagPost )
            {
                $this->post = $tagPost;
                $this->content[$this->post->getPublishedDatetime()] = TemplateStrings::getSmallArticleText($this);
                $this->links[$this->post->getPublishedDatetime()]   = TemplateStrings::getSideLinkText($this);
                $genericTags = array_merge($genericTags, $this->post->getTags());
            }
            $this->post->setTitle($tag." Tag Page");
            $this->post->setTags($genericTags);

            $output = TemplateStrings::getMainTemplateText($this);
            file_put_contents(getcwd()."$cp/Tags/$tag.html", $output);
        }
        return $this;
    }

    public function renderCategoryPages()
    {
        $pp = Config::$state->post_path;
        $cp = Config::$state->content_path;

        $output = "";
        foreach ( $this->categories as $category => $categoryPosts )
        {
            $output = "";
            $this->content = [];
            $this->links = [];
            foreach ( $categoryPosts as $categoryPost )
            {
                $this->post = $categoryPost;
                $this->content[$this->post->getPublishedDatetime()] = TemplateStrings::getSmallArticleText($this);
                $this->links[$this->post->getPublishedDatetime()]   = TemplateStrings::getSideLinkText($this);
            }
            $this->post->setTitle($this->post->getCategory()." Category Page");
            $this->post->setTags([$this->post->getCategory()]);
            $output = TemplateStrings::getMainTemplateText($this);
            file_put_contents(getcwd()."$cp/Categories/$category.html", $output);
        }
        return $this;
    }

    /**
     *
     * @return void
     */
    public function renderArticlePages()
    {
        foreach ($this->posts as $filename => $markdown) {

            $cp = Config::$state->content_path;

            $class          = "Post\\$filename";

            $this->post     = new $class();
            switch(Config::getState()) {
                case "beta":
                    if ( $this->post->getIsPublished() ) {
                        continue 2;
                    }
                    break;
                default:
                    if ( !$this->post->getIsPublished() ) {
                        continue 2;
                    }
                    break;
            }
            if ( file_exists(getcwd()."$cp/Posts/$filename.html") )
            {
                unlink(getcwd()."$cp/Posts/$filename.html");
            }

            $this->content  = [TemplateStrings::getMainArticleText($this)];

            $output         = TemplateStrings::getMainTemplateText($this);
            if ( file_exists(getcwd()."$cp/Posts/$filename.html") ) {
                unlink(getcwd()."$cp/Posts/$filename.html");
            }
            file_put_contents(getcwd()."$cp/Posts/$filename.html", $output);
        }
        return $this;
    }
}