<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class BlogIntro extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1341704910;
        $this->filename = "BlogIntro";
        $this->title = "Blog Introduction";
        $this->tags = ["html", "responsive", "php", "noframework", "blog"];
        $this->category = "blog";
        return $this;
    }
}