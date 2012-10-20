<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class FactoriesVsInvokables extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1349967354;
        $this->filename = "FactoriesVsInvokables";
        $this->title = "Factories Vs Invokables";
        $this->tags = ["invokables", "factories", "php", "zf2", "zendframework2"];
        return $this;
    }
}