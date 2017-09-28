<?php

require __DIR__ . '/config/config.php';
require __DIR__ . '/vendor/autoload.php';

$app = new \Mbh\App;

require __DIR__ . '/app/routes.php';

$app->run();
