<?php

namespace ANSR\Services\DatabaseCreator\Config;

class OracleConfig implements IConfig
{
    private $host;
    private $db;
    private $user;
    private $pass;

    public function __construct(
        $host = \ANSR\Config\OracleConfig::HOST,
        $db = \ANSR\Config\OracleConfig::DATABASE,
        $user = \ANSR\Config\OracleConfig::USER,
        $pass = \ANSR\Config\OracleConfig::PASS
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
        return 'oci:dbname=//'. $this->getHost() .':1521/' . $this->getDb();
    }
}