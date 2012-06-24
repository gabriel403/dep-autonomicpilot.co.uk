<?php
/**
 * Config parser
 */
namespace Autonomicpilot;

/**
 * Config parser
 * 
 * @package Autonomicpilot
 */
class Config
{
    private static $configini = [];

    /**
     * Reads the configuration file
     * 
     * @return array
     */
    public static function getConfig()
    {
        self::$configini = parse_ini_file("configuration.ini", true);
        return self::$configini;
    }
}