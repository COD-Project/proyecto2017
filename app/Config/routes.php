<?php

/**
 * Routes to make MVC applications
 */
$app->get('/', function() use($app) {
    return new \App\Controllers\HomeController($app);
});

$app->get('/phpinfo', function() {
    return phpinfo();
});

$app->get('/:controller', function($controller) use($app) {
    return \App\Controller::create($controller, [$app]);
});

$app->map(['GET', 'POST'], '/:controller/:method',
            function($controller, $method) use($app) {
                return \App\Controller::create($controller, [$app, $method]);
            });

$app->map(['GET', 'POST'], '/:controller/:method/:data',
            function($controller, $method, $data) use($app) {
                return \App\Controller::create($controller, [$app, $method, $data]);
            });
