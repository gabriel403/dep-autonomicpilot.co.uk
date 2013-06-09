<?php

namespace Autonomicpilot\Renderer;

/**
 * Config parser
 *
 * @package Autonomicpilot
 */
class Config extends \ArrayObject
{
    public static $statestr = false;
    public static $state = false;
    public static $instance = false;

    public static function getInstance()
    {
        if (!self::$instance){
            self::setup();
        }
        return self::$instance;
    }

    public static function setup() {
        $instance = static::parse_ini_file_extended("configuration.ini");
        return $instance::setState('standard');
    }

    public static function setState($status) {
        $instance = static::getInstance();
        if ( is_null($instance->$status) ) {
            throw new \Exception("Invalid state requested ".$state);
        }
        $instance::$statestr = $status;
        $instance::$state = $instance->$status;
        return $instance::$state;
    }

    public static function getState() {
        return self::$statestr;
    }

    public static function getStateO() {
        return self::$state;
    }

    protected static function parse_ini_file_extended($filename) {
        static::$instance = new static;
        $instance = static::$instance;
        $instance->setFlags( parent::ARRAY_AS_PROPS );

        $p_ini = parse_ini_file($filename, true);

        foreach($p_ini as $namespace => $properties){
            $explode = explode(':', $namespace);
            if ( 1 == count($explode) ) {
                $name       = $explode[0];
                $extends    = null;
            } else if ( 2 == count($explode) ) {
                $name       = $explode[0];
                $extends    = $explode[1];
            }
            $name = trim($name);
            $extends = trim($extends);

            // create namespace if necessary
            if(!isset($instance->$name)) {
                $instance->offsetSet($name, new \ArrayObject([], parent::ARRAY_AS_PROPS));
            }

            // inherit base namespace
            if(isset($p_ini[$extends])){
                foreach($p_ini[$extends] as $prop => $val) {
                    $instance->$name->offsetSet($prop, $val);
                }
            }

            // overwrite / set current namespace values
            foreach($properties as $prop => $val) {
                $instance->$name->offsetSet($prop, $val);
            }
        }
        return $instance;
    }
}