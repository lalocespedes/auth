<?php

$app->get('/', function() use ($app) {

	echo "Inicio route";

	var_dump($_SESSION);

});