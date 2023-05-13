<?php

return (function()
{
    $intGT0 = '[1-9]+\d*';
	$normUrl = '[0-9aA-zZ_-]+';

    return [
        [
            'name' => '/^$/',
            'controller' => 'sale',
            'model' => 'sale'
        ],
        [
            'name' => '/^sale\/?$/',
            'controller' => 'sale',
            'model' => 'sale'
        ],
        [
            'name' => "/^sale\/($intGT0)\/?$/",
            'controller' => 'sale/edit',
            'model' => 'sale',
            'params' => ['id' => 1]
        ],
        [
            'name' => '/^cost\/?$/',
            'controller' => 'cost',
            'model' => 'cost'
        ],
        [
            'name' => "/^cost\/($intGT0)\/?$/",
            'controller' => 'cost/edit',
            'model' => 'cost',
            'params' => ['id' => 1]
        ]
    ];
}) ();