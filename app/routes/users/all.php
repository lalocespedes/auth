<?php

$app->get('/users', $authenticated(), $admin(), function() use ($app) {

	$users = $app->user->where('active', true)->get();

	dd($users);

})->name('user.all');