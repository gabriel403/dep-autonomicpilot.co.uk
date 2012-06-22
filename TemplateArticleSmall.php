<?php
include_once "markdown.php";

$entry_text = Markdown($post->getMarkdown());
?>
<div class="article_content" id="<?php echo $post->getFilename(); ?>">
    <?php echo $entry_text; ?>
</div>