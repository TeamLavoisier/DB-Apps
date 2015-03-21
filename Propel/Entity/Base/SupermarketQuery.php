<?php

namespace ANSR\Propel\Entity\Base;

use \Exception;
use \PDO;
use ANSR\Propel\Entity\Supermarket as ChildSupermarket;
use ANSR\Propel\Entity\SupermarketQuery as ChildSupermarketQuery;
use ANSR\Propel\Entity\Map\SupermarketTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'supermarkets' table.
 *
 *
 *
 * @method     ChildSupermarketQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSupermarketQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSupermarketQuery orderByTownId($order = Criteria::ASC) Order by the town_id column
 *
 * @method     ChildSupermarketQuery groupById() Group by the id column
 * @method     ChildSupermarketQuery groupByName() Group by the name column
 * @method     ChildSupermarketQuery groupByTownId() Group by the town_id column
 *
 * @method     ChildSupermarketQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSupermarketQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSupermarketQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSupermarketQuery leftJoinTown($relationAlias = null) Adds a LEFT JOIN clause to the query using the Town relation
 * @method     ChildSupermarketQuery rightJoinTown($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Town relation
 * @method     ChildSupermarketQuery innerJoinTown($relationAlias = null) Adds a INNER JOIN clause to the query using the Town relation
 *
 * @method     ChildSupermarketQuery leftJoinSale($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sale relation
 * @method     ChildSupermarketQuery rightJoinSale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sale relation
 * @method     ChildSupermarketQuery innerJoinSale($relationAlias = null) Adds a INNER JOIN clause to the query using the Sale relation
 *
 * @method     \ANSR\Propel\Entity\TownQuery|\ANSR\Propel\Entity\SaleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSupermarket findOne(ConnectionInterface $con = null) Return the first ChildSupermarket matching the query
 * @method     ChildSupermarket findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSupermarket matching the query, or a new ChildSupermarket object populated from the query conditions when no match is found
 *
 * @method     ChildSupermarket findOneById(int $id) Return the first ChildSupermarket filtered by the id column
 * @method     ChildSupermarket findOneByName(string $name) Return the first ChildSupermarket filtered by the name column
 * @method     ChildSupermarket findOneByTownId(int $town_id) Return the first ChildSupermarket filtered by the town_id column *

 * @method     ChildSupermarket requirePk($key, ConnectionInterface $con = null) Return the ChildSupermarket by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupermarket requireOne(ConnectionInterface $con = null) Return the first ChildSupermarket matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupermarket requireOneById(int $id) Return the first ChildSupermarket filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupermarket requireOneByName(string $name) Return the first ChildSupermarket filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupermarket requireOneByTownId(int $town_id) Return the first ChildSupermarket filtered by the town_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupermarket[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSupermarket objects based on current ModelCriteria
 * @method     ChildSupermarket[]|ObjectCollection findById(int $id) Return ChildSupermarket objects filtered by the id column
 * @method     ChildSupermarket[]|ObjectCollection findByName(string $name) Return ChildSupermarket objects filtered by the name column
 * @method     ChildSupermarket[]|ObjectCollection findByTownId(int $town_id) Return ChildSupermarket objects filtered by the town_id column
 * @method     ChildSupermarket[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SupermarketQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \ANSR\Propel\Entity\Base\SupermarketQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'supermarkets_chainmssql', $modelName = '\\ANSR\\Propel\\Entity\\Supermarket', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSupermarketQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSupermarketQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSupermarketQuery) {
            return $criteria;
        }
        $query = new ChildSupermarketQuery();
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
     * @return ChildSupermarket|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SupermarketTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SupermarketTableMap::DATABASE_NAME);
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
     * @return ChildSupermarket A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, town_id FROM supermarkets WHERE id = :p0';
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
            /** @var ChildSupermarket $obj */
            $obj = new ChildSupermarket();
            $obj->hydrate($row);
            SupermarketTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildSupermarket|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SupermarketTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SupermarketTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SupermarketTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SupermarketTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupermarketTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SupermarketTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the town_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTownId(1234); // WHERE town_id = 1234
     * $query->filterByTownId(array(12, 34)); // WHERE town_id IN (12, 34)
     * $query->filterByTownId(array('min' => 12)); // WHERE town_id > 12
     * </code>
     *
     * @see       filterByTown()
     *
     * @param     mixed $townId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
     */
    public function filterByTownId($townId = null, $comparison = null)
    {
        if (is_array($townId)) {
            $useMinMax = false;
            if (isset($townId['min'])) {
                $this->addUsingAlias(SupermarketTableMap::COL_TOWN_ID, $townId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($townId['max'])) {
                $this->addUsingAlias(SupermarketTableMap::COL_TOWN_ID, $townId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupermarketTableMap::COL_TOWN_ID, $townId, $comparison);
    }

    /**
     * Filter the query by a related \ANSR\Propel\Entity\Town object
     *
     * @param \ANSR\Propel\Entity\Town|ObjectCollection $town The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSupermarketQuery The current query, for fluid interface
     */
    public function filterByTown($town, $comparison = null)
    {
        if ($town instanceof \ANSR\Propel\Entity\Town) {
            return $this
                ->addUsingAlias(SupermarketTableMap::COL_TOWN_ID, $town->getId(), $comparison);
        } elseif ($town instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupermarketTableMap::COL_TOWN_ID, $town->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTown() only accepts arguments of type \ANSR\Propel\Entity\Town or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Town relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
     */
    public function joinTown($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Town');

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
            $this->addJoinObject($join, 'Town');
        }

        return $this;
    }

    /**
     * Use the Town relation Town object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ANSR\Propel\Entity\TownQuery A secondary query class using the current class as primary query
     */
    public function useTownQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTown($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Town', '\ANSR\Propel\Entity\TownQuery');
    }

    /**
     * Filter the query by a related \ANSR\Propel\Entity\Sale object
     *
     * @param \ANSR\Propel\Entity\Sale|ObjectCollection $sale the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSupermarketQuery The current query, for fluid interface
     */
    public function filterBySale($sale, $comparison = null)
    {
        if ($sale instanceof \ANSR\Propel\Entity\Sale) {
            return $this
                ->addUsingAlias(SupermarketTableMap::COL_ID, $sale->getSupermarketId(), $comparison);
        } elseif ($sale instanceof ObjectCollection) {
            return $this
                ->useSaleQuery()
                ->filterByPrimaryKeys($sale->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySale() only accepts arguments of type \ANSR\Propel\Entity\Sale or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sale relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
     */
    public function joinSale($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sale');

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
            $this->addJoinObject($join, 'Sale');
        }

        return $this;
    }

    /**
     * Use the Sale relation Sale object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ANSR\Propel\Entity\SaleQuery A secondary query class using the current class as primary query
     */
    public function useSaleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sale', '\ANSR\Propel\Entity\SaleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSupermarket $supermarket Object to remove from the list of results
     *
     * @return $this|ChildSupermarketQuery The current query, for fluid interface
     */
    public function prune($supermarket = null)
    {
        if ($supermarket) {
            $this->addUsingAlias(SupermarketTableMap::COL_ID, $supermarket->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the supermarkets table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupermarketTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SupermarketTableMap::clearInstancePool();
            SupermarketTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SupermarketTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SupermarketTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SupermarketTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SupermarketTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SupermarketQuery
