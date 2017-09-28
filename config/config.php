<?php

# Timezone DOC http://php.net/manual/es/timezones.php
date_default_timezone_set('America/Argentina/Buenos_Aires');

$data = json_decode(
  file_get_contents("config/db.json"),
  true
);

/**
 * Settings for DB connection.
 * @param host 'Server for connection to the database -> local/remote hosting'
 * @param user 'Database user'
 * @param pass 'Password of the database user'
 * @param name 'Database name'
 * @param port 'Database port (not required on most engines)'
 * @param protocol 'Connection protocol (not required on most engines)'
 * @param motor 'Default connection engine'
 * MOTORS VALUES:
 *        mysql
 *        sqlite
 *        oracle
 *        postgresql
 *        cubrid
 *        firebird
 *        odbc
 */
define('DATABASE["host"]', $data['database']['host']);
define('DATABASE["user"]', $data['database']['name']);
define('DATABASE["password"]', $data['database']['pass']);
define('DATABASE["name"]', $data['database']['name']);
define('DATABASE["port"]', $data['database']['port']);
define('DATABASE["protocol"]', $data['database']['protocol']);
define('DATABASE["motor"]', $data['database']['motor']);

/**
 * Defines the directory in which the framework is installed
 * @example "/" If to access the framework we place http://url.com in the URL, or http://localhost
 * @example "/mbh-framework/" if to access the framework we place http://url.com/mbh-framework, or http://localhost/mbh-framework/
 */
define('__ROOT__', '/');
define('URL', 'http://localhost:3000/');
