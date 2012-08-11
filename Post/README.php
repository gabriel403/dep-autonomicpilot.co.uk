<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class README extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1340484002;
        $this->filename = "README";
        $this->title = "Readme/Changes File";
        $this->tags = ["html", "blog"];
        $this->category = "readme";
        return $this;
    }
}