<?php

$authenticationCheck = function($required) use ($app) {

	return function() use ($required, $app) {

		if ((!$app->auth && $required) || ($app->auth && !$required)) {
			
			$app->stop();
		}
	};
};

$authenticated = function() use($authenticationCheck) {

	return $authenticationCheck(true);

};

$guest = function() use($authenticationCheck) {

	return $authenticationCheck(false);

};

$admin = function() use ($app) {

	return function() use ($app) {

		if (!$app->auth || !$app->auth->isAdmin()) {

			$response["message"] = "Access Denied. Admin Area";
            echoRespnse(401, $response);
			$app->stop();
		}
	};

};