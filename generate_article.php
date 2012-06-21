<?php
include_once "markdown.php";

if ($handle = opendir('markdown')) {
    while (false !== ($entry = readdir($handle))) {
        if ( '.' != $entry && '..' != $entry )
        {
            if ( ob_start() )
            {
                $filename = str_replace(".md", "", $entry);

                $content = Markdown(file_get_contents("markdown/$entry"));
                include "template.php";

                $output = ob_get_contents();

                if(file_exists("content/$filename.html"))
                {
                    unlink("content/$filename.html");
                }
                file_put_contents("content/$filename.html", $output);

                ob_end_clean();
            }

        }
    }
   closedir($handle);
}


