<?php

$app->get('/', $guest(), function() use ($app) {

	echo "Home".'<br>';

	var_dump($_SESSION).'<br>';

	dd($app->auth);

});