<?php

/**
 * Routes to make MVC applications
 */
$app->get('/', function() use($app) {
    new \App\Controllers\HomeController($app);
});

$app->get('/phpinfo', function() {
    return phpinfo();
});

$controllerCreate = function($controller, $args)
{
    $className = "\\App\\Controllers\\" . ucwords($controller) . "Controller";
    return \App\Controller::create($className, $args);
};

$app->get('/:controller', function($controller) use($app, $controllerCreate) {
    $controllerCreate($controller, [$app]);
});

$app->map(['GET', 'POST'], '/:controller/:method',
            function($controller, $method) use($app, $controllerCreate) {
                $controllerCreate($controller, [$app, $method]);
            });

$app->map(['GET', 'POST'], '/:controller/:method/:data',
            function($controller, $method, $data) use($app, $controllerCreate) {
                $controllerCreate($controller, [$app, $method, $data]);
            });
