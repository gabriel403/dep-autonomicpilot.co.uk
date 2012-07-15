<?php
namespace Post;
use \Autonomicpilot\Post as Post;
class ZSAAndZFCUser extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        $this->publishedTime = 1342367894;
        $this->filename = "ZSAAndZFCUser";
        $this->title = "ZSA And ZFCUser";
        $this->category = "ZF2";
        $this->tags = ["zf2","zfc","composer"];
        return $this;
    }
}