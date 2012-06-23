<?php
namespace Autonomicpilot;
class Config
{
    private static $configini = [];

    public static function GetConfig(){
        self::$configini = parse_ini_file("configuration.ini", true);
        return self::$configini;
    }
}