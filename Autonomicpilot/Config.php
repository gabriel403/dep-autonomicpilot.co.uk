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
class Config extends \ArrayObject
{
    private static $instance;

    public function __construct($data)
    {
        foreach($data as $key => $value) {
            if(is_array($value)){
                $value = new self($value);
            }
            $this->offsetSet($key, $value);
        }

        parent::setFlags(parent::ARRAY_AS_PROPS);
    }

    public static function getInstance()
    {
        if ( null == self::$instance)
        {
            $data = parse_ini_file("configuration.ini", true);
            self::$instance = new Config($data);
        }
        return self::$instance;
    }

}