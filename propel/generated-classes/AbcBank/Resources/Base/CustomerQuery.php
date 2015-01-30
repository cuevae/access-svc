<?php

namespace AbcBank\Resources\Base;

use \Exception;
use \PDO;
use AbcBank\Resources\Customer as ChildCustomer;
use AbcBank\Resources\CustomerQuery as ChildCustomerQuery;
use AbcBank\Resources\Map\CustomerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'customer' table.
 *
 *
 *
 * @method     ChildCustomerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCustomerQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildCustomerQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildCustomerQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildCustomerQuery orderBySecondName($order = Criteria::ASC) Order by the second_name column
 * @method     ChildCustomerQuery orderByFirstSurname($order = Criteria::ASC) Order by the first_surname column
 * @method     ChildCustomerQuery orderBySecondSurname($order = Criteria::ASC) Order by the second_surname column
 * @method     ChildCustomerQuery orderByAddressLine1($order = Criteria::ASC) Order by the address_line1 column
 * @method     ChildCustomerQuery orderByAddressLine2($order = Criteria::ASC) Order by the address_line2 column
 * @method     ChildCustomerQuery orderByHouseNumber($order = Criteria::ASC) Order by the house_number column
 * @method     ChildCustomerQuery orderByPostcode($order = Criteria::ASC) Order by the postcode column
 * @method     ChildCustomerQuery orderByTown($order = Criteria::ASC) Order by the town column
 * @method     ChildCustomerQuery orderByCounty($order = Criteria::ASC) Order by the county column
 * @method     ChildCustomerQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     ChildCustomerQuery orderByTelephone1($order = Criteria::ASC) Order by the telephone1 column
 * @method     ChildCustomerQuery orderByTelephone2($order = Criteria::ASC) Order by the telephone2 column
 * @method     ChildCustomerQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCustomerQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCustomerQuery groupById() Group by the id column
 * @method     ChildCustomerQuery groupByUsername() Group by the username column
 * @method     ChildCustomerQuery groupByTitle() Group by the title column
 * @method     ChildCustomerQuery groupByFirstName() Group by the first_name column
 * @method     ChildCustomerQuery groupBySecondName() Group by the second_name column
 * @method     ChildCustomerQuery groupByFirstSurname() Group by the first_surname column
 * @method     ChildCustomerQuery groupBySecondSurname() Group by the second_surname column
 * @method     ChildCustomerQuery groupByAddressLine1() Group by the address_line1 column
 * @method     ChildCustomerQuery groupByAddressLine2() Group by the address_line2 column
 * @method     ChildCustomerQuery groupByHouseNumber() Group by the house_number column
 * @method     ChildCustomerQuery groupByPostcode() Group by the postcode column
 * @method     ChildCustomerQuery groupByTown() Group by the town column
 * @method     ChildCustomerQuery groupByCounty() Group by the county column
 * @method     ChildCustomerQuery groupByCountry() Group by the country column
 * @method     ChildCustomerQuery groupByTelephone1() Group by the telephone1 column
 * @method     ChildCustomerQuery groupByTelephone2() Group by the telephone2 column
 * @method     ChildCustomerQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCustomerQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCustomerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCustomerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCustomerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCustomerQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildCustomerQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildCustomerQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildCustomerQuery leftJoinTransaction($relationAlias = null) Adds a LEFT JOIN clause to the query using the Transaction relation
 * @method     ChildCustomerQuery rightJoinTransaction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Transaction relation
 * @method     ChildCustomerQuery innerJoinTransaction($relationAlias = null) Adds a INNER JOIN clause to the query using the Transaction relation
 *
 * @method     \AbcBank\Resources\AccountQuery|\AbcBank\Resources\TransactionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCustomer findOne(ConnectionInterface $con = null) Return the first ChildCustomer matching the query
 * @method     ChildCustomer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCustomer matching the query, or a new ChildCustomer object populated from the query conditions when no match is found
 *
 * @method     ChildCustomer findOneById(int $id) Return the first ChildCustomer filtered by the id column
 * @method     ChildCustomer findOneByUsername(string $username) Return the first ChildCustomer filtered by the username column
 * @method     ChildCustomer findOneByTitle(string $title) Return the first ChildCustomer filtered by the title column
 * @method     ChildCustomer findOneByFirstName(string $first_name) Return the first ChildCustomer filtered by the first_name column
 * @method     ChildCustomer findOneBySecondName(string $second_name) Return the first ChildCustomer filtered by the second_name column
 * @method     ChildCustomer findOneByFirstSurname(string $first_surname) Return the first ChildCustomer filtered by the first_surname column
 * @method     ChildCustomer findOneBySecondSurname(string $second_surname) Return the first ChildCustomer filtered by the second_surname column
 * @method     ChildCustomer findOneByAddressLine1(string $address_line1) Return the first ChildCustomer filtered by the address_line1 column
 * @method     ChildCustomer findOneByAddressLine2(string $address_line2) Return the first ChildCustomer filtered by the address_line2 column
 * @method     ChildCustomer findOneByHouseNumber(string $house_number) Return the first ChildCustomer filtered by the house_number column
 * @method     ChildCustomer findOneByPostcode(string $postcode) Return the first ChildCustomer filtered by the postcode column
 * @method     ChildCustomer findOneByTown(string $town) Return the first ChildCustomer filtered by the town column
 * @method     ChildCustomer findOneByCounty(string $county) Return the first ChildCustomer filtered by the county column
 * @method     ChildCustomer findOneByCountry(string $country) Return the first ChildCustomer filtered by the country column
 * @method     ChildCustomer findOneByTelephone1(string $telephone1) Return the first ChildCustomer filtered by the telephone1 column
 * @method     ChildCustomer findOneByTelephone2(string $telephone2) Return the first ChildCustomer filtered by the telephone2 column
 * @method     ChildCustomer findOneByCreatedAt(string $created_at) Return the first ChildCustomer filtered by the created_at column
 * @method     ChildCustomer findOneByUpdatedAt(string $updated_at) Return the first ChildCustomer filtered by the updated_at column *

 * @method     ChildCustomer requirePk($key, ConnectionInterface $con = null) Return the ChildCustomer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOne(ConnectionInterface $con = null) Return the first ChildCustomer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomer requireOneById(int $id) Return the first ChildCustomer filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByUsername(string $username) Return the first ChildCustomer filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByTitle(string $title) Return the first ChildCustomer filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByFirstName(string $first_name) Return the first ChildCustomer filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneBySecondName(string $second_name) Return the first ChildCustomer filtered by the second_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByFirstSurname(string $first_surname) Return the first ChildCustomer filtered by the first_surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneBySecondSurname(string $second_surname) Return the first ChildCustomer filtered by the second_surname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByAddressLine1(string $address_line1) Return the first ChildCustomer filtered by the address_line1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByAddressLine2(string $address_line2) Return the first ChildCustomer filtered by the address_line2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByHouseNumber(string $house_number) Return the first ChildCustomer filtered by the house_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByPostcode(string $postcode) Return the first ChildCustomer filtered by the postcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByTown(string $town) Return the first ChildCustomer filtered by the town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByCounty(string $county) Return the first ChildCustomer filtered by the county column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByCountry(string $country) Return the first ChildCustomer filtered by the country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByTelephone1(string $telephone1) Return the first ChildCustomer filtered by the telephone1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByTelephone2(string $telephone2) Return the first ChildCustomer filtered by the telephone2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByCreatedAt(string $created_at) Return the first ChildCustomer filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCustomer requireOneByUpdatedAt(string $updated_at) Return the first ChildCustomer filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCustomer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCustomer objects based on current ModelCriteria
 * @method     ChildCustomer[]|ObjectCollection findById(int $id) Return ChildCustomer objects filtered by the id column
 * @method     ChildCustomer[]|ObjectCollection findByUsername(string $username) Return ChildCustomer objects filtered by the username column
 * @method     ChildCustomer[]|ObjectCollection findByTitle(string $title) Return ChildCustomer objects filtered by the title column
 * @method     ChildCustomer[]|ObjectCollection findByFirstName(string $first_name) Return ChildCustomer objects filtered by the first_name column
 * @method     ChildCustomer[]|ObjectCollection findBySecondName(string $second_name) Return ChildCustomer objects filtered by the second_name column
 * @method     ChildCustomer[]|ObjectCollection findByFirstSurname(string $first_surname) Return ChildCustomer objects filtered by the first_surname column
 * @method     ChildCustomer[]|ObjectCollection findBySecondSurname(string $second_surname) Return ChildCustomer objects filtered by the second_surname column
 * @method     ChildCustomer[]|ObjectCollection findByAddressLine1(string $address_line1) Return ChildCustomer objects filtered by the address_line1 column
 * @method     ChildCustomer[]|ObjectCollection findByAddressLine2(string $address_line2) Return ChildCustomer objects filtered by the address_line2 column
 * @method     ChildCustomer[]|ObjectCollection findByHouseNumber(string $house_number) Return ChildCustomer objects filtered by the house_number column
 * @method     ChildCustomer[]|ObjectCollection findByPostcode(string $postcode) Return ChildCustomer objects filtered by the postcode column
 * @method     ChildCustomer[]|ObjectCollection findByTown(string $town) Return ChildCustomer objects filtered by the town column
 * @method     ChildCustomer[]|ObjectCollection findByCounty(string $county) Return ChildCustomer objects filtered by the county column
 * @method     ChildCustomer[]|ObjectCollection findByCountry(string $country) Return ChildCustomer objects filtered by the country column
 * @method     ChildCustomer[]|ObjectCollection findByTelephone1(string $telephone1) Return ChildCustomer objects filtered by the telephone1 column
 * @method     ChildCustomer[]|ObjectCollection findByTelephone2(string $telephone2) Return ChildCustomer objects filtered by the telephone2 column
 * @method     ChildCustomer[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildCustomer objects filtered by the created_at column
 * @method     ChildCustomer[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCustomer objects filtered by the updated_at column
 * @method     ChildCustomer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CustomerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \AbcBank\Resources\Base\CustomerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'abcbank', $modelName = '\\AbcBank\\Resources\\Customer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCustomerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCustomerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCustomerQuery) {
            return $criteria;
        }
        $query = new ChildCustomerQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $username] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCustomer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CustomerTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CustomerTableMap::DATABASE_NAME);
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
     * @return ChildCustomer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, username, title, first_name, second_name, first_surname, second_surname, address_line1, address_line2, house_number, postcode, town, county, country, telephone1, telephone2, created_at, updated_at FROM customer WHERE id = :p0 AND username = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCustomer $obj */
            $obj = new ChildCustomer();
            $obj->hydrate($row);
            CustomerTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildCustomer|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CustomerTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CustomerTableMap::COL_USERNAME, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CustomerTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CustomerTableMap::COL_USERNAME, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CustomerTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CustomerTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByFirstName($firstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstName)) {
                $firstName = str_replace('*', '%', $firstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_FIRST_NAME, $firstName, $comparison);
    }

    /**
     * Filter the query on the second_name column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondName('fooValue');   // WHERE second_name = 'fooValue'
     * $query->filterBySecondName('%fooValue%'); // WHERE second_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $secondName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterBySecondName($secondName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secondName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $secondName)) {
                $secondName = str_replace('*', '%', $secondName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_SECOND_NAME, $secondName, $comparison);
    }

    /**
     * Filter the query on the first_surname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstSurname('fooValue');   // WHERE first_surname = 'fooValue'
     * $query->filterByFirstSurname('%fooValue%'); // WHERE first_surname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstSurname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByFirstSurname($firstSurname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstSurname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstSurname)) {
                $firstSurname = str_replace('*', '%', $firstSurname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_FIRST_SURNAME, $firstSurname, $comparison);
    }

    /**
     * Filter the query on the second_surname column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondSurname('fooValue');   // WHERE second_surname = 'fooValue'
     * $query->filterBySecondSurname('%fooValue%'); // WHERE second_surname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $secondSurname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterBySecondSurname($secondSurname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($secondSurname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $secondSurname)) {
                $secondSurname = str_replace('*', '%', $secondSurname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_SECOND_SURNAME, $secondSurname, $comparison);
    }

    /**
     * Filter the query on the address_line1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressLine1('fooValue');   // WHERE address_line1 = 'fooValue'
     * $query->filterByAddressLine1('%fooValue%'); // WHERE address_line1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressLine1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByAddressLine1($addressLine1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressLine1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressLine1)) {
                $addressLine1 = str_replace('*', '%', $addressLine1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_ADDRESS_LINE1, $addressLine1, $comparison);
    }

    /**
     * Filter the query on the address_line2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressLine2('fooValue');   // WHERE address_line2 = 'fooValue'
     * $query->filterByAddressLine2('%fooValue%'); // WHERE address_line2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressLine2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByAddressLine2($addressLine2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressLine2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressLine2)) {
                $addressLine2 = str_replace('*', '%', $addressLine2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_ADDRESS_LINE2, $addressLine2, $comparison);
    }

    /**
     * Filter the query on the house_number column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseNumber('fooValue');   // WHERE house_number = 'fooValue'
     * $query->filterByHouseNumber('%fooValue%'); // WHERE house_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $houseNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByHouseNumber($houseNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($houseNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $houseNumber)) {
                $houseNumber = str_replace('*', '%', $houseNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_HOUSE_NUMBER, $houseNumber, $comparison);
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CustomerTableMap::COL_POSTCODE, $postcode, $comparison);
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CustomerTableMap::COL_TOWN, $town, $comparison);
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CustomerTableMap::COL_COUNTY, $county, $comparison);
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CustomerTableMap::COL_COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the telephone1 column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone1('fooValue');   // WHERE telephone1 = 'fooValue'
     * $query->filterByTelephone1('%fooValue%'); // WHERE telephone1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CustomerTableMap::COL_TELEPHONE1, $telephone1, $comparison);
    }

    /**
     * Filter the query on the telephone2 column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone2('fooValue');   // WHERE telephone2 = 'fooValue'
     * $query->filterByTelephone2('%fooValue%'); // WHERE telephone2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CustomerTableMap::COL_TELEPHONE2, $telephone2, $comparison);
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CustomerTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CustomerTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CustomerTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CustomerTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CustomerTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \AbcBank\Resources\Account object
     *
     * @param \AbcBank\Resources\Account|ObjectCollection $account the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \AbcBank\Resources\Account) {
            return $this
                ->addUsingAlias(CustomerTableMap::COL_ID, $account->getCustomerId(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            return $this
                ->useAccountQuery()
                ->filterByPrimaryKeys($account->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAccount() only accepts arguments of type \AbcBank\Resources\Account or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Account relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function joinAccount($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Account');

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
            $this->addJoinObject($join, 'Account');
        }

        return $this;
    }

    /**
     * Use the Account relation Account object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AbcBank\Resources\AccountQuery A secondary query class using the current class as primary query
     */
    public function useAccountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Account', '\AbcBank\Resources\AccountQuery');
    }

    /**
     * Filter the query by a related \AbcBank\Resources\Transaction object
     *
     * @param \AbcBank\Resources\Transaction|ObjectCollection $transaction the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCustomerQuery The current query, for fluid interface
     */
    public function filterByTransaction($transaction, $comparison = null)
    {
        if ($transaction instanceof \AbcBank\Resources\Transaction) {
            return $this
                ->addUsingAlias(CustomerTableMap::COL_ID, $transaction->getCustomerId(), $comparison);
        } elseif ($transaction instanceof ObjectCollection) {
            return $this
                ->useTransactionQuery()
                ->filterByPrimaryKeys($transaction->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTransaction() only accepts arguments of type \AbcBank\Resources\Transaction or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Transaction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function joinTransaction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Transaction');

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
            $this->addJoinObject($join, 'Transaction');
        }

        return $this;
    }

    /**
     * Use the Transaction relation Transaction object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AbcBank\Resources\TransactionQuery A secondary query class using the current class as primary query
     */
    public function useTransactionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTransaction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Transaction', '\AbcBank\Resources\TransactionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCustomer $customer Object to remove from the list of results
     *
     * @return $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function prune($customer = null)
    {
        if ($customer) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CustomerTableMap::COL_ID), $customer->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CustomerTableMap::COL_USERNAME), $customer->getUsername(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the customer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CustomerTableMap::clearInstancePool();
            CustomerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CustomerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CustomerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CustomerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CustomerTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CustomerTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CustomerTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CustomerTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CustomerTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildCustomerQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CustomerTableMap::COL_CREATED_AT);
    }

} // CustomerQuery
