<?php
/**
 * Main launch file
 * 
 * @author Gabriel Baker <gabriel@autonomicpilot.co.uk>
 */

chdir(dirname(__DIR__));
include "autoload.php";

$ar = new Autonomicpilot\Renderer\Renderer();
$ar->preRenderConsumption()
->renderMainPage()
->renderArticlePages()
->renderTagPages()
->renderCategoryPages();

