<?php
/**
 *
 */
namespace Autonomicpilot\Renderer;
abstract class Post
{
    /** */
    protected $filename;
    /** */
    protected $title;
    /** */
    protected $tags = [];
    /** */
    protected $category = "Uncategorised";
    /** */
    protected $publishedTime;

    protected $isPublished = false;

    private $markdown;

    public function __construct()
    {
        $this->markdown = new MarkdownExtraParser();
        return $this;
    }

    public function getIsPublished() 
    {
        return $this->isPublished;
    }

    /**
     *
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     *
     */
    public function getPublishedDatetime()
    {
        return date("d/m/y H:i:s", $this->publishedTime);
    }

    public function getPublishedTimestamp()
    {
        return $this->publishedTime;
    }

    /**
     *
     */
    public function setPublishedTime($publishedTime)
    {
        $this->publishedTime = $publishedTime;
        return $this;
    }

    /**
     *
     */
    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    public function getTagLinks()
    {
        $return = "";
        foreach ( $this->tags as $tag )
        {
            $return .= TemplateStrings::tagLinkText($tag);
        }
        return $return;
    }

    public function getCategoryLink()
    {
        $return = "";
        $return = TemplateStrings::categoryLinkText($this->category);
        return $return;
    }

    /**
     *
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     *
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     *
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     *
     */
    public function getMarkdown()
    {
        return file_get_contents(getcwd()."/Post/{$this->filename}.md");
    }

    /**
     *
     */
    public function getMarkdownText()
    {
        return $this->markdown->transform(file_get_contents(getcwd()."/Post/{$this->filename}.md"));
    }

}