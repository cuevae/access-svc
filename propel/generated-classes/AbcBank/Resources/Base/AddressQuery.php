<?php

namespace AbcBank\Resources\Base;

use \Exception;
use \PDO;
use AbcBank\Resources\Address as ChildAddress;
use AbcBank\Resources\AddressQuery as ChildAddressQuery;
use AbcBank\Resources\Map\AddressTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'address' table.
 *
 *
 *
 * @method     ChildAddressQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAddressQuery orderByCustomerId($order = Criteria::ASC) Order by the customer_id column
 * @method     ChildAddressQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildAddressQuery orderByLine1($order = Criteria::ASC) Order by the line_1 column
 * @method     ChildAddressQuery orderByLine2($order = Criteria::ASC) Order by the line_2 column
 * @method     ChildAddressQuery orderByLine3($order = Criteria::ASC) Order by the line_3 column
 * @method     ChildAddressQuery orderByPostcode($order = Criteria::ASC) Order by the postcode column
 * @method     ChildAddressQuery orderByTown($order = Criteria::ASC) Order by the town column
 * @method     ChildAddressQuery orderByCounty($order = Criteria::ASC) Order by the county column
 * @method     ChildAddressQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildAddressQuery orderByTelephone1($order = Criteria::ASC) Order by the telephone_1 column
 * @method     ChildAddressQuery orderByTelephone2($order = Criteria::ASC) Order by the telephone_2 column
 * @method     ChildAddressQuery orderByTelephone3($order = Criteria::ASC) Order by the telephone_3 column
 * @method     ChildAddressQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAddressQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildAddressQuery groupById() Group by the id column
 * @method     ChildAddressQuery groupByCustomerId() Group by the customer_id column
 * @method     ChildAddressQuery groupByNumber() Group by the number column
 * @method     ChildAddressQuery groupByLine1() Group by the line_1 column
 * @method     ChildAddressQuery groupByLine2() Group by the line_2 column
 * @method     ChildAddressQuery groupByLine3() Group by the line_3 column
 * @method     ChildAddressQuery groupByPostcode() Group by the postcode column
 * @method     ChildAddressQuery groupByTown() Group by the town column
 * @method     ChildAddressQuery groupByCounty() Group by the county column
 * @method     ChildAddressQuery groupByCountry() Group by the country column
 * @method     ChildAddressQuery groupByTelephone1() Group by the telephone_1 column
 * @method     ChildAddressQuery groupByTelephone2() Group by the telephone_2 column
 * @method     ChildAddressQuery groupByTelephone3() Group by the telephone_3 column
 * @method     ChildAddressQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAddressQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAddressQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildAddressQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildAddressQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     \AbcBank\Resources\CustomerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAddress findOne(ConnectionInterface $con = null) Return the first ChildAddress matching the query
 * @method     ChildAddress findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAddress matching the query, or a new ChildAddress object populated from the query conditions when no match is found
 *
 * @method     ChildAddress findOneById(int $id) Return the first ChildAddress filtered by the id column
 * @method     ChildAddress findOneByCustomerId(int $customer_id) Return the first ChildAddress filtered by the customer_id column
 * @method     ChildAddress findOneByNumber(string $number) Return the first ChildAddress filtered by the number column
 * @method     ChildAddress findOneByLine1(string $line_1) Return the first ChildAddress filtered by the line_1 column
 * @method     ChildAddress findOneByLine2(string $line_2) Return the first ChildAddress filtered by the line_2 column
 * @method     ChildAddress findOneByLine3(string $line_3) Return the first ChildAddress filtered by the line_3 column
 * @method     ChildAddress findOneByPostcode(string $postcode) Return the first ChildAddress filtered by the postcode column
 * @method     ChildAddress findOneByTown(string $town) Return the first ChildAddress filtered by the town column
 * @method     ChildAddress findOneByCounty(string $county) Return the first ChildAddress filtered by the county column
 * @method     ChildAddress findOneByCountry(string $country) Return the first ChildAddress filtered by the country column
 * @method     ChildAddress findOneByTelephone1(string $telephone_1) Return the first ChildAddress filtered by the telephone_1 column
 * @method     ChildAddress findOneByTelephone2(string $telephone_2) Return the first ChildAddress filtered by the telephone_2 column
 * @method     ChildAddress findOneByTelephone3(string $telephone_3) Return the first ChildAddress filtered by the telephone_3 column
 * @method     ChildAddress findOneByCreatedAt(string $created_at) Return the first ChildAddress filtered by the created_at column
 * @method     ChildAddress findOneByUpdatedAt(string $updated_at) Return the first ChildAddress filtered by the updated_at column *

 * @method     ChildAddress requirePk($key, ConnectionInterface $con = null) Return the ChildAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOne(ConnectionInterface $con = null) Return the first ChildAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddress requireOneById(int $id) Return the first ChildAddress filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByCustomerId(int $customer_id) Return the first ChildAddress filtered by the customer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByNumber(string $number) Return the first ChildAddress filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByLine1(string $line_1) Return the first ChildAddress filtered by the line_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByLine2(string $line_2) Return the first ChildAddress filtered by the line_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByLine3(string $line_3) Return the first ChildAddress filtered by the line_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByPostcode(string $postcode) Return the first ChildAddress filtered by the postcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByTown(string $town) Return the first ChildAddress filtered by the town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByCounty(string $county) Return the first ChildAddress filtered by the county column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByCountry(string $country) Return the first ChildAddress filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByTelephone1(string $telephone_1) Return the first ChildAddress filtered by the telephone_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByTelephone2(string $telephone_2) Return the first ChildAddress filtered by the telephone_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByTelephone3(string $telephone_3) Return the first ChildAddress filtered by the telephone_3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByCreatedAt(string $created_at) Return the first ChildAddress filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAddress requireOneByUpdatedAt(string $updated_at) Return the first ChildAddress filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAddress[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAddress objects based on current ModelCriteria
 * @method     ChildAddress[]|ObjectCollection findById(int $id) Return ChildAddress objects filtered by the id column
 * @method     ChildAddress[]|ObjectCollection findByCustomerId(int $customer_id) Return ChildAddress objects filtered by the customer_id column
 * @method     ChildAddress[]|ObjectCollection findByNumber(string $number) Return ChildAddress objects filtered by the number column
 * @method     ChildAddress[]|ObjectCollection findByLine1(string $line_1) Return ChildAddress objects filtered by the line_1 column
 * @method     ChildAddress[]|ObjectCollection findByLine2(string $line_2) Return ChildAddress objects filtered by the line_2 column
 * @method     ChildAddress[]|ObjectCollection findByLine3(string $line_3) Return ChildAddress objects filtered by the line_3 column
 * @method     ChildAddress[]|ObjectCollection findByPostcode(string $postcode) Return ChildAddress objects filtered by the postcode column
 * @method     ChildAddress[]|ObjectCollection findByTown(string $town) Return ChildAddress objects filtered by the town column
 * @method     ChildAddress[]|ObjectCollection findByCounty(string $county) Return ChildAddress objects filtered by the county column
 * @method     ChildAddress[]|ObjectCollection findByCountry(string $country) Return ChildAddress objects filtered by the country column
 * @method     ChildAddress[]|ObjectCollection findByTelephone1(string $telephone_1) Return ChildAddress objects filtered by the telephone_1 column
 * @method     ChildAddress[]|ObjectCollection findByTelephone2(string $telephone_2) Return ChildAddress objects filtered by the telephone_2 column
 * @method     ChildAddress[]|ObjectCollection findByTelephone3(string $telephone_3) Return ChildAddress objects filtered by the telephone_3 column
 * @method     ChildAddress[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildAddress objects filtered by the created_at column
 * @method     ChildAddress[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildAddress objects filtered by the updated_at column
 * @method     ChildAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AddressQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AbcBank\Resources\Base\AddressQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'abcbank', $modelName = '\\AbcBank\\Resources\\Address', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAddressQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAddressQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAddressQuery) {
            return $criteria;
        }
        $query = new ChildAddressQuery();
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
     * @return ChildAddress|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AddressTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AddressTableMap::DATABASE_NAME);
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
     * @return ChildAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, customer_id, number, line_1, line_2, line_3, postcode, town, county, country, telephone_1, telephone_2, telephone_3, created_at, updated_at FROM address WHERE id = :p0';
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
            /** @var ChildAddress $obj */
            $obj = new ChildAddress();
            $obj->hydrate($row);
            AddressTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildAddress|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AddressTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AddressTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AddressTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AddressTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the customer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerId(1234); // WHERE customer_id = 1234
     * $query->filterByCustomerId(array(12, 34)); // WHERE customer_id IN (12, 34)
     * $query->filterByCustomerId(array('min' => 12)); // WHERE customer_id > 12
     * </code>
     *
     * @see       filterByCustomer()
     *
     * @param     mixed $customerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByCustomerId($customerId = null, $comparison = null)
    {
        if (is_array($customerId)) {
            $useMinMax = false;
            if (isset($customerId['min'])) {
                $this->addUsingAlias(AddressTableMap::COL_CUSTOMER_ID, $customerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customerId['max'])) {
                $this->addUsingAlias(AddressTableMap::COL_CUSTOMER_ID, $customerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_CUSTOMER_ID, $customerId, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber('fooValue');   // WHERE number = 'fooValue'
     * $query->filterByNumber('%fooValue%'); // WHERE number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $number The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($number)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $number)) {
                $number = str_replace('*', '%', $number);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the line_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByLine1('fooValue');   // WHERE line_1 = 'fooValue'
     * $query->filterByLine1('%fooValue%'); // WHERE line_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $line1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByLine1($line1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($line1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $line1)) {
                $line1 = str_replace('*', '%', $line1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_LINE_1, $line1, $comparison);
    }

    /**
     * Filter the query on the line_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByLine2('fooValue');   // WHERE line_2 = 'fooValue'
     * $query->filterByLine2('%fooValue%'); // WHERE line_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $line2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByLine2($line2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($line2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $line2)) {
                $line2 = str_replace('*', '%', $line2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_LINE_2, $line2, $comparison);
    }

    /**
     * Filter the query on the line_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByLine3('fooValue');   // WHERE line_3 = 'fooValue'
     * $query->filterByLine3('%fooValue%'); // WHERE line_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $line3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByLine3($line3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($line3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $line3)) {
                $line3 = str_replace('*', '%', $line3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_LINE_3, $line3, $comparison);
    }

    /**
     * Filter the query on the postcode column
     *
     * Example usage:
     * <code>
     * $query->filterByPostcode('fooValue');   // WHERE postcode = 'fooValue'
     * $query->filterByPostcode('%fooValue%'); // WHERE postcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByPostcode($postcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postcode)) {
                $postcode = str_replace('*', '%', $postcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_POSTCODE, $postcode, $comparison);
    }

    /**
     * Filter the query on the town column
     *
     * Example usage:
     * <code>
     * $query->filterByTown('fooValue');   // WHERE town = 'fooValue'
     * $query->filterByTown('%fooValue%'); // WHERE town LIKE '%fooValue%'
     * </code>
     *
     * @param     string $town The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByTown($town = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($town)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $town)) {
                $town = str_replace('*', '%', $town);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_TOWN, $town, $comparison);
    }

    /**
     * Filter the query on the county column
     *
     * Example usage:
     * <code>
     * $query->filterByCounty('fooValue');   // WHERE county = 'fooValue'
     * $query->filterByCounty('%fooValue%'); // WHERE county LIKE '%fooValue%'
     * </code>
     *
     * @param     string $county The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByCounty($county = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($county)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $county)) {
                $county = str_replace('*', '%', $county);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_COUNTY, $county, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $country)) {
                $country = str_replace('*', '%', $country);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the telephone_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone1('fooValue');   // WHERE telephone_1 = 'fooValue'
     * $query->filterByTelephone1('%fooValue%'); // WHERE telephone_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByTelephone1($telephone1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telephone1)) {
                $telephone1 = str_replace('*', '%', $telephone1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_TELEPHONE_1, $telephone1, $comparison);
    }

    /**
     * Filter the query on the telephone_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone2('fooValue');   // WHERE telephone_2 = 'fooValue'
     * $query->filterByTelephone2('%fooValue%'); // WHERE telephone_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByTelephone2($telephone2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telephone2)) {
                $telephone2 = str_replace('*', '%', $telephone2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_TELEPHONE_2, $telephone2, $comparison);
    }

    /**
     * Filter the query on the telephone_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone3('fooValue');   // WHERE telephone_3 = 'fooValue'
     * $query->filterByTelephone3('%fooValue%'); // WHERE telephone_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByTelephone3($telephone3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telephone3)) {
                $telephone3 = str_replace('*', '%', $telephone3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_TELEPHONE_3, $telephone3, $comparison);
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
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(AddressTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AddressTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(AddressTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AddressTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AddressTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \AbcBank\Resources\Customer object
     *
     * @param \AbcBank\Resources\Customer|ObjectCollection $customer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAddressQuery The current query, for fluid interface
     */
    public function filterByCustomer($customer, $comparison = null)
    {
        if ($customer instanceof \AbcBank\Resources\Customer) {
            return $this
                ->addUsingAlias(AddressTableMap::COL_CUSTOMER_ID, $customer->getId(), $comparison);
        } elseif ($customer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AddressTableMap::COL_CUSTOMER_ID, $customer->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCustomer() only accepts arguments of type \AbcBank\Resources\Customer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function joinCustomer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customer');

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
            $this->addJoinObject($join, 'Customer');
        }

        return $this;
    }

    /**
     * Use the Customer relation Customer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AbcBank\Resources\CustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customer', '\AbcBank\Resources\CustomerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAddress $address Object to remove from the list of results
     *
     * @return $this|ChildAddressQuery The current query, for fluid interface
     */
    public function prune($address = null)
    {
        if ($address) {
            $this->addUsingAlias(AddressTableMap::COL_ID, $address->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AddressTableMap::clearInstancePool();
            AddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AddressTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildAddressQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(AddressTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildAddressQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(AddressTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildAddressQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(AddressTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildAddressQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(AddressTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildAddressQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(AddressTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildAddressQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(AddressTableMap::COL_CREATED_AT);
    }

} // AddressQuery
