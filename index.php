<?php

require __DIR__ . '/vendor/autoload.php';

$completeUrl = $_SERVER['REQUEST_URI'];
$indexFile   = @end(explode('/', $_SERVER['SCRIPT_FILENAME']));
$indexPath   = $_SERVER['PHP_SELF'];
$basePath    = str_replace($indexFile, '', $indexPath);

$params = explode('/', str_replace($basePath, '', $completeUrl));

$controllerBaseFQCN = 'App\Controller\\';
$controllerEndFQCN  = 'Controller';
$controllerPath = '';
foreach ($params as $param){
    $controllerName = ucfirst(array_shift($params));

    $classTest = $controllerBaseFQCN . $controllerName . $controllerEndFQCN;
    if (class_exists($classTest) === true) {
        $controllerFQCN = $classTest;
        break;
    }

    $classTest = $controllerBaseFQCN . $controllerPath . $controllerName . $controllerEndFQCN;
    if (class_exists($classTest) === true) {
        $controllerFQCN = $classTest;
        break;
    }

    $controllerPath .= "$controllerName\\";
}

$action = array_shift($params);

$controller = new $controllerFQCN;

call_user_func_array([$controller, $action], $params);

