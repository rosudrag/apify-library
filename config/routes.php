<?php
$routes[] = new Route('/', 
    array(
        'controller' => 'index', 
        'action'     => 'index'
    )
);

$routes[] = new Route('/example/:action', 
    array(
        'controller' => 'index'
    )
);

$routes[] = new Route('/users/:id', 
    array(
        'controller' => 'users',
        'action'     => 'show'
    )
);

$routes[] = new Route('/users/:id/:action', 
    array(
        'controller' => 'users'
    ),
    array(
        'action'     => '(show|update|destroy)',
        'page'       => '\d+'
    )
);

$routes[] = new Route('/users/create', 
    array(
        'controller' => 'users',
        'action'     => 'create'
    )
);

$routes[] = new Route('/users', 
    array(
        'controller' => 'users',
        'action'     => 'index'
    )
);

$routes[] = new Route('/fbusers',
	array(
	'controller' => 'fbusers',
	'action' => 'index'
	)
);

$routes[] = new Route('/domains',
	array(
	'controller' => 'domains',
	'action' => 'index'
	)
);

$routes[] = new Route('/domains/create',
	array(
	'controller' => 'domains',
	'action' => 'create'
	)
);

$routes[] = new Route('/domains/:domainid', 
    array(
        'controller' => 'domains',
        'action'     => 'show'
    )
);

$routes[] = new Route('/domains/:domainid/:action', 
    array(
        'controller' => 'domains'
    ),
    array(
        'action'     => '(show|update|destroy)',
        'page'       => '\d+'
    )
);

$routes[] = new Route('/questions',
	array(
	'controller' => 'questions',
	'action' => 'index'
	)
);

return $routes;
