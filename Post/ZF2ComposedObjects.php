<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class ZF2ComposedObjects extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1365944418;
        $this->filename = "ZF2ComposedObjects";
        $this->title = "ZF2 Forms, Annotations and Composed Objects";
        $this->tags = ["zf2", "zendframework2", "Zend\Form", "Zend\Form\Annotation", "ComposedObject"];
        $this->category = "ZF2";
        return $this;
    }
}