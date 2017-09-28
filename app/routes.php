<?php

/**
 * Routes to make MVC applications
 */
$app->get('/', function() {
    return "MBHFramework is working!";
});

$app->get('/:controller', function($controller) {
    return "MBHFramework is working!";
});

$app->map(['GET', 'POST'], '/:controller/:method',
            function($controller, $method) {
                return "MBHFramework is working!";
            });

$app->map(['GET', 'POST'], '/:controller/:method/:data',
            function($controller, $method, $data) {
                return "MBHFramework is working!";
            });
