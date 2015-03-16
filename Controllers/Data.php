<?php

namespace ANSR\Controllers;

/**
 * Class Importer
 * @package ANSR\Controllers
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Data extends Controller
{
    public function get()
    {
        $database = $this->getRequest()->getParam('database');
        $table = $this->getRequest()->getParam('table');
        $dbContext = new \ANSR\Services\DatabaseCreator\ConnectionPool($database);
        $dbContext->createConnection();

        $query = '\\ANSR\Propel\Entity\\' . ucfirst($table) . 'Query';

        $entity = $query::create();

        return $entity->find()->toArray();
    }
}

