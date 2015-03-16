<?php

namespace ANSR\Controllers;

/**
 * Class Importer
 * @package ANSR\Controllers
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class Importer extends Controller
{
    public function doImport()
    {
        $dbType = $this->getRequest()->getParam('database');
        $dataType = $this->getRequest()->getParam('dataType');
        $data = $this->getRequest()->getPost()->getParam('data');

        $importer = \ANSR\Services\Importer\DataImportService::create($dbType, $dataType, $data);

        $importer->kickstart();

        return $this->success();
    }
}

