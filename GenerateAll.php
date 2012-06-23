<?php
chdir(__DIR__);
include "markdown.php";

$ar = new Autonomicpilot\Renderer();
$ar->preRenderConsumption();
$ar->renderMainPage();
$ar->renderArticlePages();

function __autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    if ( file_exists($fileName) ) {
        require $fileName;
        return true;
    }
    return false;
}
