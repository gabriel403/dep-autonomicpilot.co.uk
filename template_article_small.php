<?php
include_once "markdown.php";
$entry_text = Markdown(file_get_contents("markdown/$entry"));
?>
<div class="article_content">
    <?php echo $entry_text; ?>
</div>