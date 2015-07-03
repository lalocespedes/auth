<?php

$app->get('/clients', $authenticated(), function() use ($app) {

	echo "Listar los clientes";

})->name('clients');