<?php

namespace ANSR\Services\DatabaseCreator\Config;


class ConfigFactory
{
    const TYPE_MYSQL = 'mysql';
    const TYPE_MSSQL = 'sqlsrv';
    const TYPE_ORACLE = 'oracle';

    /**
     * @param string $dbType
     * @param string|null $host
     * @param string|null $db
     * @param string|null $user
     * @param string|null $pass
     * @return IConfig
     * @throws \Exception
     */
    public static function create($dbType, $host = null, $db = null, $user = null, $pass = null)
    {
        $args = [];

        foreach (func_get_args() as $k => $arg) {
            if ($k == 0) {
                continue;
            }

            if ($arg) {
                $args[] = $arg;
            }
        }

        switch (strtolower($dbType))
        {
            case self::TYPE_MYSQL:
                $reflect = new \ReflectionClass('\\ANSR\Services\DatabaseCreator\Config\MySQLConfig');
                break;
            case self::TYPE_MSSQL:
                $reflect = new \ReflectionClass('\\ANSR\Services\DatabaseCreator\Config\MSSQLConfig');
                break;
            case self::TYPE_ORACLE:
                $reflect = new \ReflectionClass('\\ANSR\Services\DatabaseCreator\Config\OracleConfig');
                break;
            default:
                throw new \Exception('Invalid database type');
        }

        $instance = $reflect->newInstanceArgs($args);

        return $instance;
    }
}