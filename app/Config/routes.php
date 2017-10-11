<?php

/**
 * Routes to make MVC applications
 */
$app->get('/', function ($app) {
    return new \App\Controllers\HomeController($app);
}, [ $app ]);

$app->get('/phpinfo', function () {
    return phpinfo();
});

$app->map(['GET', 'POST'], '/:controller', function ($app, $controller) {
    return \App\Controller::create($controller, [$app]);
}, [ $app ]);

$app->map(
    ['GET', 'POST'],
    '/:controller/:method',
    function ($app, $controller, $method) {
        return \App\Controller::create($controller, [$app, $method]);
    },
    [ $app ]
);

$app->map(
    ['GET', 'POST'],
    '/:controller/:method/:data',
    function ($app, $controller, $method, $data) {
        return \App\Controller::create($controller, [$app, $method, $data]);
    },
    [ $app ]
);

$app->map(
    ['GET', 'POST'],
    '/:controller/:method/:data/:state',
    function ($app, $controller, $method, $data, $state) {
        return \App\Controller::create($controller, [$app, $method, $data, $state]);
    },
    [ $app ]
);
