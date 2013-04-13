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

$routes[] = new Route('/domains/:id', 
    array(
        'controller' => 'domains',
        'action'     => 'show'
    )
);

$routes[] = new Route('/domains/:id/:action', 
    array(
        'controller' => 'domains'
    ),
    array(
        'action'     => '(show|update|destroy)',
        'page'       => '\d+'
    )
);

$routes[] = new Route('/domains/create',
	array(
	'controller' => 'domains',
	'action' => 'create'
	)
);

$routes[] = new Route('/questions',
	array(
	'controller' => 'questions',
	'action' => 'index'
	)
);

$routes[] = new Route('/questions/:id', 
    array(
        'controller' => 'questions',
        'action'     => 'show'
    )
);

$routes[] = new Route('/questions/:id/:action', 
    array(
        'controller' => 'questions'
    ),
    array(
        'action'     => '(show|update|destroy)',
        'page'       => '\d+'
    )
);

$routes[] = new Route('/questions/create',
	array(
	'controller' => 'questions',
	'action' => 'create'
	)
);


return $routes;
