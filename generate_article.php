<?php
include_once "markdown.php";

if ($handle = opendir('markdown')) {
    while (false !== ($entry = readdir($handle))) {
        if ( '.' != $entry && '..' != $entry )
        {
            if ( ob_start() )
            {
                $content = Markdown(file_get_contents('markdown/'.$entry));
                include "template.php";
                
                $output = ob_get_contents();
                file_put_contents('content/'.str_replace('.md', '.html', $entry), $output);
                ob_end_clean();
            }

        }
    }
   closedir($handle);
}


