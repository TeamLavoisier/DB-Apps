<?php
namespace ANSR\Services\Importer\ImportStrategy;

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

        foreach ($structure as $tableName => $tableProps) {
            $query = "\\ANSR\\Propel\\Entity\\"
                . ucfirst($tableName);
            $keys = array_keys($tableProps[0]);

            foreach ($tableProps as $prop) {
                $entity = new $query();

                foreach ($keys as $key) {
                    $method = 'set' . $key;
                    $entity->$method($prop[$key]);
                }

                $entity->save();
            }
        }
    }
}