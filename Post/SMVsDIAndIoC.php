<?php
namespace Post;
use \Autonomicpilot\Renderer\Post as Post;
class SMVsDIAndIoC extends Post
{
    /**
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        parent::__construct();
        $this->isPublished = true;
        $this->publishedTime = 1350219346;
        $this->category = "IoC";
        $this->filename = "SMVsDIAndIoC";
        $this->title = "Inversion of Control: Service Locator Vs Dependency Injection";
        $this->tags = ["Service Locator", "Service Manager", "Dependency Injection", "invokables", "factories", "php", "zf2", "zendframework2"];
        return $this;
    }
}