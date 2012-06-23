<?php
/**
 *
 */
namespace Autonomicpilot;
abstract class Post
{
    /** */
    protected $filename;
    /** */
    protected $title;
    /** */
    protected $tags;
    /** */
    protected $publishedTime;

    /**
     *
     */
    public function getPublishedDatetime()
    {
        return date("d/m/y H:i:s", $this->publishedTime);
    }

    /**
     *
     */
    public function setPublishedTime($publishedTime)
    {
        $this->publishedTime = $publishedTime;
    }

    /**
     *
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     *
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
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
    }

    /**
     *
     */
    public function getMarkdown()
    {
        return file_get_contents("Post/{$this->filename}.md");
    }

    /**
     *
     */
    public function getMarkdownText()
    {
        return Markdown(file_get_contents("Post/{$this->filename}.md"));
    }

}