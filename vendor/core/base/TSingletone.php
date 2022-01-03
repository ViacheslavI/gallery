<?php


namespace vendor\core\base;

trait TSingletone
{
    protected static $instance;

    /**
     * Реализация синглтон
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}