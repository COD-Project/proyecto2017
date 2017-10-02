<?php

/**
 * Routes to make MVC applications
 */
$app->get('/', function() {
    return "app working";
});

$app->get('/phpinfo', function() {

    phpinfo();
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
