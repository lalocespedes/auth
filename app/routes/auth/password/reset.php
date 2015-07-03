<?php

$app->get('/password-reset', $guest(), function() use($app) {

	$request = $app->request();

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	$hashIdentifier = $app->hash->hash($identifier);

	$user =  $app->user->where('email', $email)->first();

	if (!$user) {
		
		$app->stop();
	}

	if (!$user->recover_hash) {
		
		$app->stop();
	}

	if (!$app->hash->hashCheck($user->recover_hash, $hashIdentifier)) {
		
		$app->stop();
	}

	$app->render('auth/password/reset.php', [
		'email' => $user->email,
		'identifier' => $identifier
	]);

})->name('password.reset');

$app->post('/password-reset', $guest(), function() use($app) {

	$request = $app->request();

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');

	$hashIdentifier = $app->hash->hash($identifier);

	$user =  $app->user->where('email', $email)->first();

	if (!$user) {
		
		$app->stop();
	}

	if (!$user->recover_hash) {
		
		$app->stop();
	}

	if (!$app->hash->hashCheck($user->recover_hash, $hashIdentifier)) {
		
		$app->stop();
	}

	$v = $app->validation;

	$v->validate([
		'password' => [$password, 'required|min(6)'],
		'password_confirm' => [$passwordConfirm, 'required|matches(password)'],
	]);

	if ($v->passes()) {
		
		$user->update([
			'password' => $app->hash->password($password),
			'recover_hash' => null
		]);

		echo "Password cambiado";

		$app->stop();

	}

	$app->render('auth/password/reset.php', [
		'errors' => $v->errors(),
		'email'	=> $user->email,
		'identifier' => $identifier
	]);

})->name('password.reset.post');