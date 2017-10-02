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

$app->get('/:controller', function($controller) {
    return "app working";
});

$app->map(['GET', 'POST'], '/:controller/:method',
            function($controller, $method) {
                return "app working";
            });

$app->map(['GET', 'POST'], '/:controller/:method/:data',
            function($controller, $method, $data) {
                return "app working";
            });
