<?php

$app->post('/register', function() use($app) {
	
	$request = $app->request;

	$email = $request->post('email');
	$username = $request->post('username');
	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');

	
	
	$app->user->create([
		'email' => $email,
		'username' => $username,
		'password' => $app->hash->password($password)
	]);
});