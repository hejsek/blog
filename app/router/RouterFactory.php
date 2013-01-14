<?php

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();

		// backend
		$router[] = $backend = new RouteList('backend');

		$backend[] = new Route('backend/<presenter>/<action>[/<id>]', array(
			'presenter' => 'Welcome',
			'action' => 'default',
		));

		// frontend
		$router[] = $frontend = new RouteList('frontend');

		$frontend[] = new Route('rss.xml', array(
			'presenter' => 'Article',
			'action' => 'rss',
		));

		$frontend[] = new Route('archive', array(
			'presenter' => 'Article',
			'action' => 'archive',
		));

		$frontend[] = new Route('article/<slug>', array(
			'presenter' => 'Article',
			'action' => 'detail',
		));

		$frontend[] = new Route('<presenter>/<action>[/<id>]', array(
			'presenter' => 'Article',
			'action' => 'default',
		));

		return $router;
	}

}
