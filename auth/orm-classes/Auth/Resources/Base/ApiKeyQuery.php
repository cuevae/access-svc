<?php

namespace Auth\Resources\Base;

use \Exception;
use \PDO;
use Auth\Resources\ApiKey as ChildApiKey;
use Auth\Resources\ApiKeyQuery as ChildApiKeyQuery;
use Auth\Resources\Map\ApiKeyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'apikey' table.
 *
 *
 *
 * @method     ChildApiKeyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildApiKeyQuery orderByConsumerId($order = Criteria::ASC) Order by the consumer_id column
 * @method     ChildApiKeyQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildApiKeyQuery orderBySecret($order = Criteria::ASC) Order by the secret column
 * @method     ChildApiKeyQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildApiKeyQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildApiKeyQuery groupById() Group by the id column
 * @method     ChildApiKeyQuery groupByConsumerId() Group by the consumer_id column
 * @method     ChildApiKeyQuery groupByValue() Group by the value column
 * @method     ChildApiKeyQuery groupBySecret() Group by the secret column
 * @method     ChildApiKeyQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildApiKeyQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildApiKeyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildApiKeyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildApiKeyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildApiKeyQuery leftJoinConsumer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Consumer relation
 * @method     ChildApiKeyQuery rightJoinConsumer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Consumer relation
 * @method     ChildApiKeyQuery innerJoinConsumer($relationAlias = null) Adds a INNER JOIN clause to the query using the Consumer relation
 *
 * @method     \Auth\Resources\ConsumerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildApiKey findOne(ConnectionInterface $con = null) Return the first ChildApiKey matching the query
 * @method     ChildApiKey findOneOrCreate(ConnectionInterface $con = null) Return the first ChildApiKey matching the query, or a new ChildApiKey object populated from the query conditions when no match is found
 *
 * @method     ChildApiKey findOneById(int $id) Return the first ChildApiKey filtered by the id column
 * @method     ChildApiKey findOneByConsumerId(int $consumer_id) Return the first ChildApiKey filtered by the consumer_id column
 * @method     ChildApiKey findOneByValue(string $value) Return the first ChildApiKey filtered by the value column
 * @method     ChildApiKey findOneBySecret(string $secret) Return the first ChildApiKey filtered by the secret column
 * @method     ChildApiKey findOneByCreatedAt(string $created_at) Return the first ChildApiKey filtered by the created_at column
 * @method     ChildApiKey findOneByUpdatedAt(string $updated_at) Return the first ChildApiKey filtered by the updated_at column *

 * @method     ChildApiKey requirePk($key, ConnectionInterface $con = null) Return the ChildApiKey by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildApiKey requireOne(ConnectionInterface $con = null) Return the first ChildApiKey matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildApiKey requireOneById(int $id) Return the first ChildApiKey filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildApiKey requireOneByConsumerId(int $consumer_id) Return the first ChildApiKey filtered by the consumer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildApiKey requireOneByValue(string $value) Return the first ChildApiKey filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildApiKey requireOneBySecret(string $secret) Return the first ChildApiKey filtered by the secret column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildApiKey requireOneByCreatedAt(string $created_at) Return the first ChildApiKey filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildApiKey requireOneByUpdatedAt(string $updated_at) Return the first ChildApiKey filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildApiKey[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildApiKey objects based on current ModelCriteria
 * @method     ChildApiKey[]|ObjectCollection findById(int $id) Return ChildApiKey objects filtered by the id column
 * @method     ChildApiKey[]|ObjectCollection findByConsumerId(int $consumer_id) Return ChildApiKey objects filtered by the consumer_id column
 * @method     ChildApiKey[]|ObjectCollection findByValue(string $value) Return ChildApiKey objects filtered by the value column
 * @method     ChildApiKey[]|ObjectCollection findBySecret(string $secret) Return ChildApiKey objects filtered by the secret column
 * @method     ChildApiKey[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildApiKey objects filtered by the created_at column
 * @method     ChildApiKey[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildApiKey objects filtered by the updated_at column
 * @method     ChildApiKey[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ApiKeyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Auth\Resources\Base\ApiKeyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'abcbank_api', $modelName = '\\Auth\\Resources\\ApiKey', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildApiKeyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildApiKeyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildApiKeyQuery) {
            return $criteria;
        }
        $query = new ChildApiKeyQuery();
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
     * $obj = $c->findPk(array(12, 34, 56, 78), $con);
     * </code>
     *
     * @param array[$id, $consumer_id, $value, $secret] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildApiKey|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ApiKeyTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2], (string) $key[3]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ApiKeyTableMap::DATABASE_NAME);
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
     * @return ChildApiKey A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, consumer_id, value, secret, created_at, updated_at FROM apikey WHERE id = :p0 AND consumer_id = :p1 AND value = :p2 AND secret = :p3';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_STR);
            $stmt->bindValue(':p3', $key[3], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildApiKey $obj */
            $obj = new ChildApiKey();
            $obj->hydrate($row);
            ApiKeyTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2], (string) $key[3])));
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
     * @return ChildApiKey|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ApiKeyTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ApiKeyTableMap::COL_CONSUMER_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(ApiKeyTableMap::COL_VALUE, $key[2], Criteria::EQUAL);
        $this->addUsingAlias(ApiKeyTableMap::COL_SECRET, $key[3], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ApiKeyTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ApiKeyTableMap::COL_CONSUMER_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(ApiKeyTableMap::COL_VALUE, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $cton3 = $this->getNewCriterion(ApiKeyTableMap::COL_SECRET, $key[3], Criteria::EQUAL);
            $cton0->addAnd($cton3);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ApiKeyTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the consumer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByConsumerId(1234); // WHERE consumer_id = 1234
     * $query->filterByConsumerId(array(12, 34)); // WHERE consumer_id IN (12, 34)
     * $query->filterByConsumerId(array('min' => 12)); // WHERE consumer_id > 12
     * </code>
     *
     * @see       filterByConsumer()
     *
     * @param     mixed $consumerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterByConsumerId($consumerId = null, $comparison = null)
    {
        if (is_array($consumerId)) {
            $useMinMax = false;
            if (isset($consumerId['min'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_CONSUMER_ID, $consumerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($consumerId['max'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_CONSUMER_ID, $consumerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ApiKeyTableMap::COL_CONSUMER_ID, $consumerId, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $value)) {
                $value = str_replace('*', '%', $value);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApiKeyTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the secret column
     *
     * Example usage:
     * <code>
     * $query->filterBySecret('fooValue');   // WHERE secret = 'fooValue'
     * $query->filterBySecret('%fooValue%'); // WHERE secret LIKE '%fooValue%'
     * </code>
     *
     * @param     string $secret The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterBySecret($secret = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secret)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $secret)) {
                $secret = str_replace('*', '%', $secret);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ApiKeyTableMap::COL_SECRET, $secret, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ApiKeyTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ApiKeyTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ApiKeyTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Auth\Resources\Consumer object
     *
     * @param \Auth\Resources\Consumer|ObjectCollection $consumer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildApiKeyQuery The current query, for fluid interface
     */
    public function filterByConsumer($consumer, $comparison = null)
    {
        if ($consumer instanceof \Auth\Resources\Consumer) {
            return $this
                ->addUsingAlias(ApiKeyTableMap::COL_CONSUMER_ID, $consumer->getId(), $comparison);
        } elseif ($consumer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ApiKeyTableMap::COL_CONSUMER_ID, $consumer->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByConsumer() only accepts arguments of type \Auth\Resources\Consumer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Consumer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function joinConsumer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Consumer');

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
            $this->addJoinObject($join, 'Consumer');
        }

        return $this;
    }

    /**
     * Use the Consumer relation Consumer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Auth\Resources\ConsumerQuery A secondary query class using the current class as primary query
     */
    public function useConsumerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinConsumer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Consumer', '\Auth\Resources\ConsumerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildApiKey $apiKey Object to remove from the list of results
     *
     * @return $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function prune($apiKey = null)
    {
        if ($apiKey) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ApiKeyTableMap::COL_ID), $apiKey->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ApiKeyTableMap::COL_CONSUMER_ID), $apiKey->getConsumerId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(ApiKeyTableMap::COL_VALUE), $apiKey->getValue(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond3', $this->getAliasedColName(ApiKeyTableMap::COL_SECRET), $apiKey->getSecret(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2', 'pruneCond3'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the apikey table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ApiKeyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ApiKeyTableMap::clearInstancePool();
            ApiKeyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ApiKeyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ApiKeyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ApiKeyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ApiKeyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ApiKeyTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ApiKeyTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ApiKeyTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ApiKeyTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ApiKeyTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildApiKeyQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ApiKeyTableMap::COL_CREATED_AT);
    }

} // ApiKeyQuery
