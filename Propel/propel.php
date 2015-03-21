<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'supermarkets_chainmysql' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=supermarkets_chainmysql',
                    'user'       => 'root',
                    'password'   => '',
                    'attributes' => []
                ],
                'supermarkets_chainmssql' => [
                    'adapter'    => 'sqlsrv',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'sqlsrv:Server=localhost,1433;Database=supermarkets_chainmssql',
                    'user'       => '',
                    'password'   => '',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'supermarkets_chainmysql',
            'connections' => ['supermarkets_chainmysql', 'supermarkets_chainmssql']
        ],
        'generator' => [
            'defaultConnection' => 'supermarkets_chainmysql',
            'connections' => ['supermarkets_chainmysql', 'supermarkets_chainmssql']
        ]
    ]
];

