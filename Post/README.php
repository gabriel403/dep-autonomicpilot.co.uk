<?php
/**
 * README properties file
 * 
 * @package Autonomicpilot
 */

namespace Post;
use \Autonomicpilot\Post as Post;
/**
 * README properties class
 * 
 * @package Autonomicpilot
 */
class README extends Post
{
    /**
     * Constructor
     * 
     * @return Autonomicpilot\Post
     */
    public function __construct()
    {
        $this->publishedTime = 1340484002;
        $this->filename = "README";
        $this->title = "Readme/Changes File";
        return $this;
    }
}