<?php

namespace ANSR\Controllers;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Class Importer
 * @package ANSR\Controllers
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Data extends Controller
{
    protected function init()
    {
        $database = $this->getRequest()->getParam('database');
        $dbContext = new \ANSR\Services\DatabaseCreator\ConnectionPool($database);
        $dbContext->createConnection();
    }

    public function get()
    {
        $table = $this->getRequest()->getParam('table');
        $query = '\\ANSR\Propel\Entity\\' . ucfirst($table) . 'Query';

        $entity = $query::create();

        return $entity->find()->toArray();
    }

    public function getAll()
    {
        $classDir = getcwd() . '/Propel/Entity';
        $against = 'Query.php';
        $classNames = [];

        foreach (scandir($classDir) as $file) {
            if (strpos(strrev($file), strrev($against)) === 0) {
                $classNames[] = str_replace('.php', '', $file);
            }
        }

        $output = [];

        $namespace = '\\ANSR\Propel\Entity\\';

        foreach ($classNames as $className) {
            $query = $namespace . $className;
            $entity = $query::create();
            $output[str_replace('Query', '', $className)] = $entity->find()->toArray();
        }

        return $output;
    }

}

