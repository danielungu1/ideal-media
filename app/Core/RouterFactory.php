<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('/', 'Home:default');
		$router->addRoute('/prihlaseni', 'Home:signIn');
		$router->addRoute('/konferencni-mistnosti', 'Room:default');
		$router->addRoute('/konferencni-mistnosti/rezervovat/<id>', 'Room:makeReservation');
		$router->addRoute('/konferencni-mistnosti/me-rezervace', 'Room:myReservations');
        $router->addRoute('/odhlasit-se', 'Room:out');

		return $router;
	}
}
