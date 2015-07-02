<?php

$app->get('/logout', function() use($app) {

	unset($_SESSION[$app->config->get('auth.session')]);

	echo "Log out";

})->name('logout');