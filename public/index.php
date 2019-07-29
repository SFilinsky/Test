<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;


define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$loader = new Loader();
$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/views/',
        APP_PATH . '/forms/',
    ]
);
$loader->register();

$di = new FactoryDefault();
$di->set(
    'view',
    function() {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        $view->registerEngines(
            array(
                ".twig" => 'Phalcon\Mvc\View\Engine\Volt'
            )
        );
        return $view;
    }
);
$di->set(
    'voltService',
    function ($view, $di) {
        $volt = new Volt($view, $di);

        $volt->setOptions(
            [
                'compiledPath'      => '../app/compiled-templates/',
                'compiledExtension' => '.compiled',
            ]
        );

        return $volt;
    }
);
$di->set(
    'url',
    function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    }
);

$application = new Application($di);

try {
    $response = $application->handle();
    $response->send();
}
catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
