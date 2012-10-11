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
        $this->publishedTime = 1349967354;
        $this->filename = "FactoriesVsInvokables";
        $this->title = "FactoriesVsInvokables";
        return $this;
    }
}