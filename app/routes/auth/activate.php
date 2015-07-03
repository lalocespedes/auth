<?php

$app->get('/activate', $guest(), function() use($app) {
	
	$request = $app->request;

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	$hashedIdentifier = $app->hash->hash($identifier);

	$user = $app->user->where('email', $email)
		->where('active', false)
		->first();

	if (!$user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier)) {
		
		echo "Error activacion";
		
	} else {

		$user->activateAccount();

		echo "Cuenta activada";
	}


})->name('activate');