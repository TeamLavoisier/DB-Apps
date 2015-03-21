<?php

namespace ANSR\Propel\Entity\Map;

use ANSR\Propel\Entity\Sale;
use ANSR\Propel\Entity\SaleQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'sales' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SaleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'ANSR.Propel.Entity.Map.SaleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'supermarkets_chainmssql';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sales';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ANSR\\Propel\\Entity\\Sale';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ANSR.Propel.Entity.Sale';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'sales.id';

    /**
     * the column name for the sold_on field
     */
    const COL_SOLD_ON = 'sales.sold_on';

    /**
     * the column name for the quantity field
     */
    const COL_QUANTITY = 'sales.quantity';

    /**
     * the column name for the price_per_unit field
     */
    const COL_PRICE_PER_UNIT = 'sales.price_per_unit';

    /**
     * the column name for the cost field
     */
    const COL_COST = 'sales.cost';

    /**
     * the column name for the supermarket_id field
     */
    const COL_SUPERMARKET_ID = 'sales.supermarket_id';

    /**
     * the column name for the product_id field
     */
    const COL_PRODUCT_ID = 'sales.product_id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'SoldOn', 'Quantity', 'PricePerUnit', 'Cost', 'SupermarketId', 'ProductId', ),
        self::TYPE_CAMELNAME     => array('id', 'soldOn', 'quantity', 'pricePerUnit', 'cost', 'supermarketId', 'productId', ),
        self::TYPE_COLNAME       => array(SaleTableMap::COL_ID, SaleTableMap::COL_SOLD_ON, SaleTableMap::COL_QUANTITY, SaleTableMap::COL_PRICE_PER_UNIT, SaleTableMap::COL_COST, SaleTableMap::COL_SUPERMARKET_ID, SaleTableMap::COL_PRODUCT_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'sold_on', 'quantity', 'price_per_unit', 'cost', 'supermarket_id', 'product_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'SoldOn' => 1, 'Quantity' => 2, 'PricePerUnit' => 3, 'Cost' => 4, 'SupermarketId' => 5, 'ProductId' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'soldOn' => 1, 'quantity' => 2, 'pricePerUnit' => 3, 'cost' => 4, 'supermarketId' => 5, 'productId' => 6, ),
        self::TYPE_COLNAME       => array(SaleTableMap::COL_ID => 0, SaleTableMap::COL_SOLD_ON => 1, SaleTableMap::COL_QUANTITY => 2, SaleTableMap::COL_PRICE_PER_UNIT => 3, SaleTableMap::COL_COST => 4, SaleTableMap::COL_SUPERMARKET_ID => 5, SaleTableMap::COL_PRODUCT_ID => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'sold_on' => 1, 'quantity' => 2, 'price_per_unit' => 3, 'cost' => 4, 'supermarket_id' => 5, 'product_id' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('sales');
        $this->setPhpName('Sale');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ANSR\\Propel\\Entity\\Sale');
        $this->setPackage('ANSR.Propel.Entity');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('sold_on', 'SoldOn', 'TIMESTAMP', true, null, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, null, null);
        $this->addColumn('price_per_unit', 'PricePerUnit', 'INTEGER', true, null, null);
        $this->addColumn('cost', 'Cost', 'INTEGER', true, null, null);
        $this->addForeignKey('supermarket_id', 'SupermarketId', 'INTEGER', 'supermarkets', 'id', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Product', '\\ANSR\\Propel\\Entity\\Product', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Supermarket', '\\ANSR\\Propel\\Entity\\Supermarket', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':supermarket_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SaleTableMap::CLASS_DEFAULT : SaleTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Sale object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SaleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SaleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SaleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SaleTableMap::OM_CLASS;
            /** @var Sale $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SaleTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SaleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SaleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Sale $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SaleTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SaleTableMap::COL_ID);
            $criteria->addSelectColumn(SaleTableMap::COL_SOLD_ON);
            $criteria->addSelectColumn(SaleTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(SaleTableMap::COL_PRICE_PER_UNIT);
            $criteria->addSelectColumn(SaleTableMap::COL_COST);
            $criteria->addSelectColumn(SaleTableMap::COL_SUPERMARKET_ID);
            $criteria->addSelectColumn(SaleTableMap::COL_PRODUCT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.sold_on');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.price_per_unit');
            $criteria->addSelectColumn($alias . '.cost');
            $criteria->addSelectColumn($alias . '.supermarket_id');
            $criteria->addSelectColumn($alias . '.product_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SaleTableMap::DATABASE_NAME)->getTable(SaleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SaleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SaleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SaleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Sale or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Sale object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SaleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ANSR\Propel\Entity\Sale) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SaleTableMap::DATABASE_NAME);
            $criteria->add(SaleTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SaleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SaleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SaleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sales table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SaleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Sale or Criteria object.
     *
     * @param mixed               $criteria Criteria or Sale object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SaleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Sale object
        }

        if ($criteria->containsKey(SaleTableMap::COL_ID) && $criteria->keyContainsValue(SaleTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SaleTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SaleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SaleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SaleTableMap::buildTableMap();
