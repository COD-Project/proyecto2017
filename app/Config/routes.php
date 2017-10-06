<?php

/**
 * Routes to make MVC applications
 */
$app->get('/', function () {
    return new \App\Controllers\HomeController($app);
});

$app->get('/phpinfo', function () {
    return phpinfo();
});

$app->get('/:controller', function ($app, $controller) {
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
