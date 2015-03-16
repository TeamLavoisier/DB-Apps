<?php

namespace ANSR\Services\DatabaseCreator\Config;

class MSSQLConfig implements IConfig
{
    private $host;
    private $db;
    private $user;
    private $pass;

    public function __construct(
        $host = \ANSR\Config\MSSQLConfig::HOST,
        $db = \ANSR\Config\MSSQLConfig::DATABASE,
        $user = \ANSR\Config\MSSQLConfig::USER,
        $pass = \ANSR\Config\MSSQLConfig::PASS
    )
    {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
    }


    public function getHost()
    {
        return $this->host;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->pass;
    }

    public function getDsn()
    {
        return 'sqlsrv:server=' . $this->getHost() . ',1433;Database=' . $this->getDb();
    }
}