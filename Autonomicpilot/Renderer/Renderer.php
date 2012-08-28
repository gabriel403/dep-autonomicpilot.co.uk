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
        $config = Config::getInstance();
        $pp = $config->Post->post_path;
        $cp = $config->Post->content_path;

        foreach ($this->posts as $filename => $markdown) {
            $this->classname = $filename;

            if ( !class_exists("Post\\$filename") ) {
                file_put_contents(getcwd()."$pp/$filename.php", TemplateStrings::getPostClassDefinition($this));
            }

            $class          = "Post\\$filename";

            $this->post     = new $class();

            if ( !$this->post->getIsPublished() ) {
                continue;
            }

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
        $config = Config::getInstance();
        $pp = $config->Post->post_path;
        $cp = $config->Post->content_path;

        $output = "";
        foreach ( $this->tags as $tag => $tagPosts )
        {
            $output = "";
            $this->content = [];
            $this->links = [];
            krsort($tagPosts);
            foreach ( $tagPosts as $tagPost )
            {
                $this->post = $tagPost;
                $this->content[$this->post->getPublishedDatetime()] = TemplateStrings::getSmallArticleText($this);
                $this->links[$this->post->getPublishedDatetime()]   = TemplateStrings::getSideLinkText($this);
            }
            $output = TemplateStrings::getMainTemplateText($this);
            file_put_contents(getcwd()."$cp/Tags/$tag.html", $output);
        }
        return $this;
    }

    public function renderCategoryPages()
    {
        $config = Config::getInstance();
        $pp = $config->Post->post_path;
        $cp = $config->Post->content_path;

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
        $config = Config::getInstance();

        $cp = $config->Post->content_path;

        foreach ($this->posts as $filename => $markdown) {

            $class          = "Post\\$filename";

            $this->post     = new $class();

            if ( !$this->post->getIsPublished() ) 
            {
                if ( file_exists(getcwd()."$cp/Posts/$filename.html") )
                {
                    unlink(getcwd()."$cp/Posts/$filename.html");
                }
                continue;
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