<?php
/**
 * Main launch file
 * 
 * @author Gabriel Baker <gabriel@autonomicpilot.co.uk>
 */

chdir(dirname(__DIR__));
include "autoload.php";
\Autonomicpilot\Renderer\Config::setup();
$ar = new \Autonomicpilot\Renderer\Renderer;
$ar->init()
->preRenderConsumption()
->renderMainPage()
->renderArticlePages()
->renderTagPages()
->renderCategoryPages();
\Autonomicpilot\Renderer\Config::setState("beta");
$ar->init()
->renderMainPage()
->renderArticlePages();