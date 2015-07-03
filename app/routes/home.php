<?php

$app->get('/', function() use ($app) {

	echo "Home".'<br>';

	var_dump($_SESSION).'<br>';

	if($app->auth) {

		dd($app->auth->username);

	}

});