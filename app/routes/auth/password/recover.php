<?php

$app->post('/recover-password', function() use($app) {

	$request = $app->request;

	$email = $request->post('email');

	$v = $app->validation;

	$v->validate([
		'email' => [$email, 'required|email']
	]);

	if ($v->passes()) {
		
		$user = $app->user->where('email', $email)->first();

		if (!$user) {
				
			echo "Usuario/correo no existe";

			exit();

		} else {

			$identifier = $app->randomlib->generateString(128);

			$user->update([
				'recover_hash' => $app->hash->hash($identifier)
			]);

			$app->mail->send('email/auth/password/recover.php', ['user' => $user, 'identifier' => $identifier], function($message) use($user) {
				$message->to($user->email);
				$message->subject('Recuperar password');
			});

			echo "Correo enviado, con instrucciones para recuperar password";

			exit();
		}

	}

	dd($v->errors());

})->name('password.recover');