<?php
/**
 * Autoloader psr-0
 *
 * @param string $className Name of the class trying to be instantiated
 *
 * @return bool
 */
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
        include $fileName;
        return true;
    }
    return false;
}