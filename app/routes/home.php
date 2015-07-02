<?php

$app->get('/', $authenticated(), function() use ($app) {

	echo "Home".'<br>';

	var_dump($_SESSION).'<br>';

	if($app->auth){

		dd($app->auth->username);

	}

});