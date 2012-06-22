<div class="article_link">
    <div>
        <a href='#<?php echo $post->getFilename(); ?>'><?php echo $post->getFilename(); ?></a><br />
        <?php echo date("d/m/y H:i:s", $post->getPublishedDatetime()); ?>
    </div>
    <a class="article_link_main" href='<?php echo $post->getFilename(); ?>.html'>&nbsp;</a>
</div>
