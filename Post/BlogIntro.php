<?php
namespace Post;
use \Autonomicpilot\Post as Post;
class BlogIntro extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        $this->publishedTime = 1341704910;
        $this->filename = "BlogIntro";
        $this->title = "Blog Introduction";
        return $this;
    }
}