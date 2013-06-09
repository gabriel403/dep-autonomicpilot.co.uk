<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class Zf2CustomFormElement extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1364545143;
        $this->filename = "Zf2CustomFormElement";
        $this->title = "ZF2 Custom Form Element";
        $this->tags = ["zf2", "zendframework2", "Zend\Form"];
        $this->category = "ZF2";
        return $this;
    }
}