<?php

/**
 * Routes to make MVC applications
 */
$app->get('/', function ($app) {
    return new \App\Controllers\HomeController($app);
}, [ $app ]);

$app->get('/error/:code', function ($app, $code) {
    return new \App\Controllers\ErrorController($app);
}, [ $app ]);

$controller_create = function ($app, $controller) {
    return \App\Controller::create($controller, [ $app ]);
};

$app->map(
    ['GET', 'POST'],
    '/:controller',
    $controller_create,
    [ $app ]
);

$app->map(
    ['GET', 'POST'],
    '/:controller/:method',
    $controller_create,
    [ $app ]
);

$mvc_base_url = '/:controller/:method';
$max_args = MAX_ARGS;

for ($i = 0; $i < $max_args; $i++) {
    $mvc_base_url .= "/:arg$i";

    $app->map(
        ['GET', 'POST'],
        $mvc_base_url,
        $controller_create,
        [$app]
    );
}
