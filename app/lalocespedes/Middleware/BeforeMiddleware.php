<?php

namespace lalocespedes\Middleware;

use Slim\Middleware;

/**
* 
*/
class BeforeMiddleware extends Middleware
{
	public function call()
	{
		
		$this->app->hook('slim.before', [$this, 'run']);

		$this->next->call();
	}


	/**
	* Check if user is authenticate
	*/
	public function run()
	{
		if (isset($_SESSION[$this->app->config->get('auth.session')])) {
			
			$this->app->auth = $this->app->user->where('id', $_SESSION[$this->app->config->get('auth.session')])->first();
		}

		$this->app->view()->appendData([
			'baseUrl'	=> $this->app->config->get('app.url')
		]);

	}
}