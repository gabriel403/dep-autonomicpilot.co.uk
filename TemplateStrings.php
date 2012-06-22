<?php
class TemplateStrings
{
    public static $postClass = <<<'PC'
<?php
class $class extends Post
{
    public function __construct()
    {
        $this->publishedDatetime = $time;
        $this->filename = "$filename";
        $this->title = "$filename";
    }
}
PC;
}

