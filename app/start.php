<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;
use RandomLib\Factory as Randomlib;

use lalocespedes\User\User;
use lalocespedes\Helpers\Hash;
use lalocespedes\Validation\Validator;

// set timezone for timestamps etc
date_default_timezone_set('Mexico/General');

session_cache_limiter(false);
session_start();

ini_set('display_errors', On);

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([
	'mode'	=> file_get_contents(INC_ROOT . '/mode.php'),
	'view'	=> new Twig(),
	'templates.path' => INC_ROOT . '/app/views'
]);

$app->configureMode($app->config('mode'), function() use ($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

require 'routes.php';
require 'database.php';


$app->container->singleton('randomlib', function() use($app) {
	$factory = new RandomLib;
	return $factory->getMediumStrengthGenerator();
});

$app->container->singleton('hash', function() use($app) {
	return new Hash($app->config);
});

$app->container->singleton('validation', function() use($app) {
	return new Validator($app->user);
});

$app->container->set('user', function() {
	return new User;
});
