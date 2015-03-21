<?php
namespace ANSR\Services\Importer\ImportStrategy;

/**
 * Class ZipImportStrategy
 * @package ANSR\Services\Importer\ImportStrategy
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class ZipImportStrategy implements ImportStrategy
{
    /**
     * @param string $data (zip binary)
     * @return void
     */
    public function import($data)
    {
        $zip = fopen('archive.zip', 'w');
        fwrite($zip, $data);

        $zipContext = new \ZipArchive();
        $zipContext->open('archive.zip');

        var_dump($zipContext->statIndex(0));
    }
}