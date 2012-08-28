<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class ZSAAndG403Translator extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1346081830;
        $this->filename = "ZSAAndG403Translator";
        $this->title = "Zend Skeleton App And G403Translator";
        $this->category = "ZF2";
        $this->tags = ["zf2","composer","translation"];
        return $this;
    }
}