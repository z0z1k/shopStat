<?php

class Redirect
{
    public static function Redirect($url = null, $permanent = false)
    {
        if ($url === null) {
            $url = '/index.php';
        }
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit;
    }
}
