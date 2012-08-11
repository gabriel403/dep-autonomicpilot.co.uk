<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class ZSAAndZFCUser extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1342367894;
        $this->filename = "ZSAAndZFCUser";
        $this->title = "ZSA And ZFCUser";
        $this->category = "ZF2";
        $this->tags = ["zf2","zfc","composer"];
        return $this;
    }
}