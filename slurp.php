#!/usr/bin/php
<?php
/**
 * Slurp up some web pages and search their source code for an element
 *
 * Author: Dylan Hildenbrand
 * 
 */
require(__DIR__ . '/vendor/autoload.php');

use slurp\Slurp;

// fcgi doesn't have STDIN and STDOUT defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));

// get config options
$config = json_decode(file_get_contents(__DIR__ . '/config/config.json'));
// start app
$app = new Slurp($config, $argv);
$exitCode = $app->run();

exit($exitCode);