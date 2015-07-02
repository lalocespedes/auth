<?php

$authenticationCheck = function($required) use ($app) {

	return function() use ($required, $app) {

		if ((!$app->auth && $required) || ($app->auth && !$required)) {
			
			echo "No autenticado".'<br>';
		}
	};
};

$authenticated = function() use($authenticationCheck) {

	return $authenticationCheck(true);

};

$guest = function() use($authenticationCheck) {

	return $authenticationCheck(false);

};