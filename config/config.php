<?php

# Strict types for PHP 7
declare(strict_types=1);

# Timezone DOC http://php.net/manual/es/timezones.php
date_default_timezone_set('America/Argentina/Buenos_Aires');

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
define('DATABASE', json_decode(file_get_contents('config/db.json')));

/**
 * Defines the directory in which the framework is installed
 * @example "/" If to access the framework we place http://url.com in the URL, or http://localhost
 * @example "/cod-framework/" if to access the framework we place http://url.com/mbh-framework, or http://localhost/cod-framework/
 */
define('__ROOT__', '/grupo5/');
define('URL', 'http://localhost/grupo5/');
