<?php

$app->get('/logout', $authenticated(), function() use($app) {

	unset($_SESSION[$app->config->get('auth.session')]);

	echo "Log out";

})->name('logout');