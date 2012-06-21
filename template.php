<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="reset.css" />
        <style type="text/css">
            .float_left
            {
                float: left;
            }
            .clear_both {
                clear: both;
            }

            #left,#right {
                width: 20%;
            }
            #main {
                width: 60%;
            }
            #header {
                border: 1px solid black;
                margin: 50px auto auto auto;
                width: 90%;
            }
            #content_outer {
                border: 1px solid black;
                margin: 50px auto auto auto;
                width: 90%;
            }
        </style>

    </head>
    <body>
        <div id="header">&nbsp;</div>
        <div id="content_outer">
            <div id="left" class="float_left">&nbsp;</div>
            <div id="main" class="float_left">
                <?php echo $content; ?>
            </div>
            <div id="right" class="float_left">&nbsp;</div>
            <br class="clear_both" />
        </div>
    </body>
</html>
