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

        $mapDir = getcwd() . "/Propel/Entity/Map";

        foreach (scandir($mapDir) as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $content = file_get_contents($mapDir . '/' . $file);

            preg_match_all("/const DATABASE_NAME = '(.*)'/", $content, $matches);
            $db = \Propel\Runtime\Propel::getServiceContainer()->getDefaultDatasource();
            $row = str_replace($matches[1], $db, $matches[0]);
            $content = str_replace($matches[0], $row, $content);

            $handle = fopen($mapDir . '/' . $file, 'w');
            fwrite($handle, $content);
        }

        $baseDir = getcwd() . "/Propel/Entity/Base";

        foreach (scandir($baseDir) as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            if (strpos(strrev($file), strrev('Query.php')) !== 0) {
                continue;
            }

            $content = file_get_contents($baseDir . '/' . $file);

            preg_match_all("/dbName = '(.*)'/", $content, $matches);
            $db = \Propel\Runtime\Propel::getServiceContainer()->getDefaultDatasource();
            $against = explode(',', $matches[1][0])[0];
            $content = str_replace($against, $db . "'", $content);
            $handle = fopen($baseDir . '/' . $file, 'w');
            fwrite($handle, $content);
        }


        return $this;
    }
}