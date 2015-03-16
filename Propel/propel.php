<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'supermarkets_chain' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=supermarkets_chain',
                    'user'       => 'root',
                    'password'   => '',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'supermarkets_chain',
            'connections' => ['supermarkets_chain']
        ],
        'generator' => [
            'defaultConnection' => 'supermarkets_chain',
            'connections' => ['supermarkets_chain']
        ]
    ]
];

