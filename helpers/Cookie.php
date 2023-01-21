<?php

class Cookie
{
    private static string $basePath = '/';
    private static int $baseTime = 600;

    public static function add(string $name, string $value, int $time = null, string $path = null)
    {
        if ($time === null) {
            $time = time() + self::$baseTime;
        }

        if ($path === null) {
            $path = self::$basePath;
        }

        setcookie($name, $value, $time, $path);
        $_COOKIE[$name] = $value;
    }

    public static function addCheck(string $name, string $value, int $time = null, string $path = null)
    {
        if (!isset($_COOKIE[$name])) {
            if ($time === null) {
                $time = time() + self::$baseTime;
            }

            if ($path === null) {
                $path = self::$basePath;
            }

            setcookie($name, $value, $time, $path);
            $_COOKIE[$name] = $value;
        }
    }

    public static function get(string $name)
    {
        return $_COOKIE[$name];
    }

    public static function remove(string $name, string $path = null) {
        if ($path === null) {
            $path = self::$basePath;
        }

        setcookie($name, '', time()-1, $path);
        unset($_COOKIE[$name]);
    }
}