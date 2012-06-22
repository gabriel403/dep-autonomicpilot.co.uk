<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="reset.css" />
        <link rel="stylesheet" type="text/css" href="site.css" />
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Press+Start+2P' />

    </head>
    <body>
        <div id="header">
            <a href='/'>&nbsp;</a>
            <div>The 8-bit ramblings of a rabid mind</div>
        </div>
        <div id="content_outer">
            <div id="left" class="float_left">
                <?php echo $links; ?>
            </div>
            <div id="main" class="float_left">
                <?php echo $content; ?>
            </div>
            <div id="right" class="float_left">&nbsp;</div>
            <br class="clear_both" />
        </div>
    </body>
</html>
