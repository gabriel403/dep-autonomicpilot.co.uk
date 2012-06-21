<?php
$content = "";
$links = "";
if ($handle = opendir('markdown')) {

    if ( ob_start() )
    {
        while (false !== ($entry = readdir($handle))) {
            if ( '.' != $entry && '..' != $entry )
            {
                $filename = str_replace(".md", "", $entry);

                ob_start();
                include "template_article_small.php";
                $content .= ob_get_contents();
                ob_end_clean();


                ob_start();
                include "template_link.php";
                $links .= ob_get_contents();
                ob_end_clean();

            }
        }

        include "template.php";
        $output = ob_get_contents();
        unlink('content/index.html');
        file_put_contents('content/index.html', $output);
        ob_end_clean();

    }
    closedir($handle);
}


