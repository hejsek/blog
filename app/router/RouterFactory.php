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

		$router[] = new Route('rss.xml', array(
			'presenter' => 'Article',
			'action' => 'rss',
		));

		$router[] = new Route('archive', array(
			'presenter' => 'Article',
			'action' => 'archive',
		));

		$router[] = new Route('article/<slug>', array(
			'presenter' => 'Article',
			'action' => 'detail',
		));

		$router[] = new Route('<presenter>/<action>[/<id>]', array(
			'presenter' => 'Article',
			'action' => 'default',
		));

		return $router;
	}

}
