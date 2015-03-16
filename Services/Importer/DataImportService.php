<?php
namespace ANSR\Services\Importer;

/**
 * Class DataImportService
 * @package ANSR\Services\Importer
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class DataImportService
{

    /**
     * @var \ANSR\Services\Importer\ImportStrategy\ImportStrategy
     */
    private $importStrategy;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var \ANSR\Services\DatabaseCreator\ConnectionPool
     */
    private $dbContext;

    /**
     * @param \ANSR\Services\DatabaseCreator\ConnectionPool $dbContext
     */
    public function __construct(\ANSR\Services\DatabaseCreator\ConnectionPool $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    /**
     * @param ImportStrategy\ImportStrategy $strategy
     * @return $this
     */
    public function setImportStrategy(ImportStrategy\ImportStrategy $strategy)
    {
        $this->importStrategy = $strategy;

        return $this;
    }

    /**
     * @return ImportStrategy\ImportStrategy
     */
    public function getImportStrategy()
    {
        return $this->importStrategy;
    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * @return \ANSR\Services\DatabaseCreator\ConnectionPool
     */
    public function getDbContext()
    {
        return $this->dbContext;
    }

    /**
     * @return void
     */
    public function kickstart()
    {
        $this->getDbContext()->createConnection();
        $this->getImportStrategy()->import($this->getData());
    }

    /**
     * @param string $dbType
     * @param string $dataType
     * @param mixed $data
     * @return self
     * @throws \Exception
     */
    public static function create($dbType, $dataType, $data)
    {
        $strategy = ImportStrategy\ImportStrategyFactory::create($dataType);
        $dbContext = new \ANSR\Services\DatabaseCreator\ConnectionPool($dbType);

        return (new self($dbContext))
            ->setData($data)
            ->setImportStrategy($strategy);
    }
}