<?php
$content = "";
$links = "";
if ($handle = opendir('Post')) {

    if ( ob_start() )
    {
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

            ob_start();
            include "TemplateArticleSmall.php";
            $content .= ob_get_contents();
            ob_end_clean();


            ob_start();
            include "TemplateLink.php";
            $links .= ob_get_contents();
            ob_end_clean();

        }

        include "Template.php";
        $output = ob_get_contents();
        unlink('content/index.html');
        file_put_contents('content/index.html', $output);
        ob_end_clean();

    }
    closedir($handle);
}


