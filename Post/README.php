<?php
namespace Post;
use \Autonomicpilot\Post as Post;
class README extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        $this->publishedTime = 1340484002;
        $this->filename = "README";
        $this->title = "Readme/Changes File";
        $this->tags = ["html", "blog"];
        $this->category = "readme";
        return $this;
    }
}