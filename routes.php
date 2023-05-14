<?php

return (function()
{
    $intGT0 = '[1-9]+\d*';
	$normUrl = '[0-9aA-zZ_-]+';

    return [
        [
            'name' => '/^$/',
            'controller' => 'sale/all',
        ],
        [
            'name' => '/^sale\/?$/',
            'controller' => 'sale/all',
        ],
        [
            'name' => "/^sale\/($intGT0)\/?$/",
            'controller' => 'sale/edit',
            'params' => ['id' => 1]
        ],
        [
            'name' => '/^cost\/?$/',
            'controller' => 'cost/all',
        ],
        [
            'name' => "/^cost\/($intGT0)\/?$/",
            'controller' => 'cost/edit',
            'params' => ['id' => 1]
        ]
    ];
}) ();