<?php
include_once "markdown.php";

$content = "";
if ($handle = opendir('markdown')) {

    if ( ob_start() )
    {
        while (false !== ($entry = readdir($handle))) {
            if ( '.' != $entry && '..' != $entry )
            {
                    $content .= Markdown(file_get_contents('markdown/'.$entry));

            }
        }
        include "template.php";
        
        $output = ob_get_contents();
        file_put_contents('content/index.html', $output);
        ob_end_clean();

    }
   closedir($handle);
}


