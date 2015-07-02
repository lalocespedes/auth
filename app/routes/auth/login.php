<?php

$app->post('/login', function() use($app) {

	$request = $app->request;

	$identifier = $request->post('identifier');
	$password = $request->post('password');

	$v = $app->validation;

	$v->validate([
		'identifier' => [$identifier, 'required'],
		'password' => [$password, 'required']
	]);	

	if ($v->passes()) {
		
		$user = $app->user
			->where('username', $identifier)
			->orWhere('email', $identifier)
			->first();

		if ($user && $app->hash->passwordCheck($password, $user->password)) {
			
			$_SESSION[$app->config->get('auth.session')] = $user->id;

			echo 'Logged';
			exit();

		} else {

			echo 'Error login';
			exit();
		}
	}

	dd($v->errors());

});