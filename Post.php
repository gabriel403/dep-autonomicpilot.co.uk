<?php
abstract class Post
{
    protected $filename;
    protected $title;
    protected $tags;
    protected $publishedDatetime;

    public function getPublishedDatetime()
    {
        return $this->publishedDatetime;
    }

    public function setPublishedDatetime($publishedDatetime)
    {
        $this->publishedDatetime = $publishedDatetime;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getMarkdown()
    {
        return file_get_contents("Post/{$this->filename}.md");
    }

}