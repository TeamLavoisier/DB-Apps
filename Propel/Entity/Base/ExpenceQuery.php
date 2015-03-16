<?php

namespace ANSR\Propel\Entity\Base;

use \Exception;
use \PDO;
use ANSR\Propel\Entity\Expence as ChildExpence;
use ANSR\Propel\Entity\ExpenceQuery as ChildExpenceQuery;
use ANSR\Propel\Entity\Map\ExpenceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'expences' table.
 *
 *
 *
 * @method     ChildExpenceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildExpenceQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildExpenceQuery orderByCreatedOn($order = Criteria::ASC) Order by the created_on column
 * @method     ChildExpenceQuery orderByVendorId($order = Criteria::ASC) Order by the vendor_id column
 *
 * @method     ChildExpenceQuery groupById() Group by the id column
 * @method     ChildExpenceQuery groupByName() Group by the name column
 * @method     ChildExpenceQuery groupByCreatedOn() Group by the created_on column
 * @method     ChildExpenceQuery groupByVendorId() Group by the vendor_id column
 *
 * @method     ChildExpenceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenceQuery leftJoinVendor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vendor relation
 * @method     ChildExpenceQuery rightJoinVendor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vendor relation
 * @method     ChildExpenceQuery innerJoinVendor($relationAlias = null) Adds a INNER JOIN clause to the query using the Vendor relation
 *
 * @method     \ANSR\Propel\Entity\VendorQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpence findOne(ConnectionInterface $con = null) Return the first ChildExpence matching the query
 * @method     ChildExpence findOneOrCreate(ConnectionInterface $con = null) Return the first ChildExpence matching the query, or a new ChildExpence object populated from the query conditions when no match is found
 *
 * @method     ChildExpence findOneById(int $id) Return the first ChildExpence filtered by the id column
 * @method     ChildExpence findOneByName(string $name) Return the first ChildExpence filtered by the name column
 * @method     ChildExpence findOneByCreatedOn(string $created_on) Return the first ChildExpence filtered by the created_on column
 * @method     ChildExpence findOneByVendorId(int $vendor_id) Return the first ChildExpence filtered by the vendor_id column *

 * @method     ChildExpence requirePk($key, ConnectionInterface $con = null) Return the ChildExpence by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpence requireOne(ConnectionInterface $con = null) Return the first ChildExpence matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpence requireOneById(int $id) Return the first ChildExpence filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpence requireOneByName(string $name) Return the first ChildExpence filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpence requireOneByCreatedOn(string $created_on) Return the first ChildExpence filtered by the created_on column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpence requireOneByVendorId(int $vendor_id) Return the first ChildExpence filtered by the vendor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpence[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildExpence objects based on current ModelCriteria
 * @method     ChildExpence[]|ObjectCollection findById(int $id) Return ChildExpence objects filtered by the id column
 * @method     ChildExpence[]|ObjectCollection findByName(string $name) Return ChildExpence objects filtered by the name column
 * @method     ChildExpence[]|ObjectCollection findByCreatedOn(string $created_on) Return ChildExpence objects filtered by the created_on column
 * @method     ChildExpence[]|ObjectCollection findByVendorId(int $vendor_id) Return ChildExpence objects filtered by the vendor_id column
 * @method     ChildExpence[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ExpenceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \ANSR\Propel\Entity\Base\ExpenceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'supermarkets_chain', $modelName = '\\ANSR\\Propel\\Entity\\Expence', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildExpenceQuery) {
            return $criteria;
        }
        $query = new ChildExpenceQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildExpence|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ExpenceTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenceTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpence A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, created_on, vendor_id FROM expences WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildExpence $obj */
            $obj = new ChildExpence();
            $obj->hydrate($row);
            ExpenceTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildExpence|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ExpenceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ExpenceTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ExpenceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ExpenceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenceTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ExpenceTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the created_on column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedOn('2011-03-14'); // WHERE created_on = '2011-03-14'
     * $query->filterByCreatedOn('now'); // WHERE created_on = '2011-03-14'
     * $query->filterByCreatedOn(array('max' => 'yesterday')); // WHERE created_on > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdOn The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function filterByCreatedOn($createdOn = null, $comparison = null)
    {
        if (is_array($createdOn)) {
            $useMinMax = false;
            if (isset($createdOn['min'])) {
                $this->addUsingAlias(ExpenceTableMap::COL_CREATED_ON, $createdOn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdOn['max'])) {
                $this->addUsingAlias(ExpenceTableMap::COL_CREATED_ON, $createdOn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenceTableMap::COL_CREATED_ON, $createdOn, $comparison);
    }

    /**
     * Filter the query on the vendor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVendorId(1234); // WHERE vendor_id = 1234
     * $query->filterByVendorId(array(12, 34)); // WHERE vendor_id IN (12, 34)
     * $query->filterByVendorId(array('min' => 12)); // WHERE vendor_id > 12
     * </code>
     *
     * @see       filterByVendor()
     *
     * @param     mixed $vendorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function filterByVendorId($vendorId = null, $comparison = null)
    {
        if (is_array($vendorId)) {
            $useMinMax = false;
            if (isset($vendorId['min'])) {
                $this->addUsingAlias(ExpenceTableMap::COL_VENDOR_ID, $vendorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vendorId['max'])) {
                $this->addUsingAlias(ExpenceTableMap::COL_VENDOR_ID, $vendorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenceTableMap::COL_VENDOR_ID, $vendorId, $comparison);
    }

    /**
     * Filter the query by a related \ANSR\Propel\Entity\Vendor object
     *
     * @param \ANSR\Propel\Entity\Vendor|ObjectCollection $vendor The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpenceQuery The current query, for fluid interface
     */
    public function filterByVendor($vendor, $comparison = null)
    {
        if ($vendor instanceof \ANSR\Propel\Entity\Vendor) {
            return $this
                ->addUsingAlias(ExpenceTableMap::COL_VENDOR_ID, $vendor->getId(), $comparison);
        } elseif ($vendor instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpenceTableMap::COL_VENDOR_ID, $vendor->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVendor() only accepts arguments of type \ANSR\Propel\Entity\Vendor or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Vendor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function joinVendor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Vendor');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Vendor');
        }

        return $this;
    }

    /**
     * Use the Vendor relation Vendor object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ANSR\Propel\Entity\VendorQuery A secondary query class using the current class as primary query
     */
    public function useVendorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVendor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Vendor', '\ANSR\Propel\Entity\VendorQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildExpence $expence Object to remove from the list of results
     *
     * @return $this|ChildExpenceQuery The current query, for fluid interface
     */
    public function prune($expence = null)
    {
        if ($expence) {
            $this->addUsingAlias(ExpenceTableMap::COL_ID, $expence->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expences table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenceTableMap::clearInstancePool();
            ExpenceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ExpenceQuery
