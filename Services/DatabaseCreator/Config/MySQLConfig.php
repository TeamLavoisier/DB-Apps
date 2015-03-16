<?php

namespace ANSR\Services\DatabaseCreator\Config;

class MySQLConfig implements IConfig
{
    private $host;
    private $db;
    private $user;
    private $pass;

    public function __construct(
        $host = \ANSR\Config\MySQLConfig::HOST,
        $db = \ANSR\Config\MySQLConfig::DATABASE,
        $user = \ANSR\Config\MySQLConfig::USER,
        $pass = \ANSR\Config\MySQLConfig::PASS
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
        return 'mysql:host=' . $this->getHost() . ';dbname=' . $this->getDb();
    }
}