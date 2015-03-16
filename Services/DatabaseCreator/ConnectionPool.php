<?php

namespace ANSR\Services\DatabaseCreator;

use ANSR\Services\DatabaseCreator\Config\ConfigFactory;

class ConnectionPool
{
    /**
     * @var Config\IConfig
     */
    private $dbInfo;

    private $driver;

    public function __construct($dbType, $host = null, $db = null, $user = null, $pass = null)
    {
        $this->dbInfo = ConfigFactory::create($dbType, $host, $db, $user, $pass);

        $this->driver = $dbType;
    }

    /**
     * @return Config\IConfig
     */
    public function getDbInfo()
    {
        return $this->dbInfo;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return $this
     */
    public function createConnection()
    {
        \ANSR\Propel\OrmConfig::connect(
            $this->getDriver(),
            $this->getDbInfo()->getDsn(),
            $this->getDbInfo()->getUser(),
            $this->getDbInfo()->getPassword(),
            $this->getDbInfo()->getDb()
        );

        return $this;
    }
}