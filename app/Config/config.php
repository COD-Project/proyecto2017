<?php

# Timezone DOC http://php.net/manual/es/timezones.php
date_default_timezone_set('America/Argentina/Buenos_Aires');

$configjson = json_decode(
  file_get_contents("config/config.json"),
  true
);

$dbjson = json_decode(
  file_get_contents("config/db.json"),
  true
);

$data = array_merge($configjson, $dbjson);

$db = $data['database'];

/**
 * Settings for DB connection.
 * @param host 'Server for connection to the database -> local/remote hosting'
 * @param user 'Database user'
 * @param pass 'Password of the database user'
 * @param name 'Database name'
 * @param port 'Database port (not required on most engines)'
 * @param protocol 'Connection protocol (not required on most engines)'
 * @param driver 'Default connection engine'
 * MOTORS VALUES:
 *        mysql
 *        sqlite
 *        oracle
 *        postgresql
 *        cubrid
 *        firebird
 *        odbc
 */
define('DATABASE_HOST', $db['host']);
define('DATABASE_USER', $db['user']);
define('DATABASE_PASSWORD', $db['pass']);
define('DATABASE_NAME', $db['name']);
define('DATABASE_PORT', $db['port']);
define('DATABASE_PROTOCOL', $db['protocol']);
define('DATABASE_DRIVER', $db['driver']);

/**
 * Defines the directory in which the framework is installed
 * @example "/" If to access the framework we place http://url.com in the URL, or http://localhost
 * @example "/mbh-framework/" if to access the framework we place http://url.com/mbh-framework, or http://localhost/mbh-framework/
 */
define('__ROOT__', $data['root']);
define('URL', $data['url']);
define('DEBUG', $data['debug']);
