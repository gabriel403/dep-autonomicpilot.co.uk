<p class="article_link">
    <a href='<?php echo $filename; ?>.html'><?php echo $filename; ?></a><br />
    <?php echo date("d/m/y H:i:s", filectime("content/$filename.html")); ?>
</p>
