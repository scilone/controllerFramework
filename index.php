<?php

use App\Config\Loader;

require __DIR__ . '/vendor/autoload.php';

$completeUrl = $_SERVER['REQUEST_URI'];
$indexFile   = @end(explode('/', $_SERVER['SCRIPT_FILENAME']));
$indexPath   = $_SERVER['PHP_SELF'];
$basePath    = str_replace($indexFile, '', $indexPath);
$envPath     = str_replace($basePath, '', $completeUrl);


$params = explode('/', parse_url($envPath, PHP_URL_PATH));

$controllerBaseFQCN = 'App\Controller\\';
$controllerEndFQCN  = 'Controller';
$controllerPath     = '';
$controllerFQCN     = '';
foreach ($params as $param) {
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

$controller = Loader::getService($controllerFQCN);

if (method_exists($controller, $action) === false || $controller === null) {
    responsePage(404);
}

call_user_func_array([$controller, $action], $params);

function responsePage(int $code): void
{
    http_response_code($code);
    exit;
}
