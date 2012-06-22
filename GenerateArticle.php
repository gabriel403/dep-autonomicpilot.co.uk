<?php
include_once "markdown.php";

if ($handle = opendir('Post')) {
    while (false !== ($entry = readdir($handle))) {
        $pathInfo = pathinfo("post/$entry");
        if ( "md" != $pathInfo["extension"] )
        {
            continue;
        }
        $filename = substr($entry, 0, -3);
        $class = "Post_$filename";

        if ( !class_exists($class) ) {
            $newpost = str_replace(['$class','$filename', '$time'], [$class, $filename, time()], TemplateStrings::$postClass);
            file_put_contents("Post/$filename.php", $newpost);
        }

        $post = new $class();

        $entry_text = Markdown($post->getMarkdown());

        ob_start();
        include "TemplateArticleSmall.php";
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        include "Template.php";
        $output = ob_get_contents();
        ob_end_clean();

        if(file_exists("content/$filename.html"))
        {
            unlink("content/$filename.html");
        }
        file_put_contents("content/$filename.html", $output);

    }
   closedir($handle);
}


