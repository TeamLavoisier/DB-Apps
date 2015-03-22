<?php
namespace ANSR\Services\Importer\ImportStrategy;
use Propel\Runtime\Propel;

/**
 * Class JSONImportStrategy
 * @package ANSR\Services\Importer\ImportStrategy
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class JSONImportStrategy implements ImportStrategy
{
    /**
     * @param string $data (json)
     * @return void
     */
    public function import($data)
    {
        $structure = json_decode($data, true);

        $con = Propel::getConnection();
        $sql = "SET FOREIGN_KEY_CHECKS=0";
        $con->exec($sql);
        foreach ($structure as $tableName => $tableProps) {
            $query = "\\ANSR\\Propel\\Entity\\"
                . ucfirst($tableName);
            $keys = array_keys($tableProps[0]);

            foreach ($tableProps as $prop) {
                $entity = new $query();

                foreach ($keys as $key) {
                    $method = 'set' . str_replace("_", "", $key);
                    $entity->$method($prop[$key]);
                }

                $entity->save();
            }
        }

        $sql = "SET FOREIGN_KEY_CHECKS=1";
        $con->exec($sql);
    }
}