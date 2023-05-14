<?php
    
    include_once 'init.php';

    $pageCanonical = HOST . BASE_URL;
    $uri = $_SERVER['REQUEST_URI'];
    $badUrl = BASE_URL . 'index.php';

    $validateErrors = [];

    if(strpos($uri, $badUrl) === 0) {
        $cname = 'errors/e404';
    } else {
        $routes = include('routes.php');
        $url = $_GET['querysystemurl'] ?? '';
        $routerRes = parseUrl($url, $routes);
        define('URL_PARAMS', $routerRes['params']);

        $cname = $routerRes['controller'];
        $path = "controllers/$cname.php";

        if (file_exists($path)) {
            include $path;
        }

        $urlLen = strlen($url);
        if ($urlLen > 0 && $url[$urlLen - 1] == '/') {
            $url = substr($url, 0, $urlLen - 1);
        }
        
        $pageCanonical .= $url;
    }
    
    $html = template("base/v_main", [
        'title' => $pageTitle,
        'content' => $pageContent,
        'canonical' => $pageCanonical,
        'validateErrors' => $validateErrors
    ]);

    echo $html;

    file_put_contents('1', $html);