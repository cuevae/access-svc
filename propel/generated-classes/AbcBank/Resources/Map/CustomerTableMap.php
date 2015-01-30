<?php

namespace AbcBank\Resources\Map;

use AbcBank\Resources\Customer;
use AbcBank\Resources\CustomerQuery;
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
 * This class defines the structure of the 'customer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CustomerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AbcBank.Resources.Map.CustomerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'abcbank';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'customer';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\AbcBank\\Resources\\Customer';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'AbcBank.Resources.Customer';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the id field
     */
    const COL_ID = 'customer.id';

    /**
     * the column name for the username field
     */
    const COL_USERNAME = 'customer.username';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'customer.title';

    /**
     * the column name for the first_name field
     */
    const COL_FIRST_NAME = 'customer.first_name';

    /**
     * the column name for the second_name field
     */
    const COL_SECOND_NAME = 'customer.second_name';

    /**
     * the column name for the first_surname field
     */
    const COL_FIRST_SURNAME = 'customer.first_surname';

    /**
     * the column name for the second_surname field
     */
    const COL_SECOND_SURNAME = 'customer.second_surname';

    /**
     * the column name for the address_line1 field
     */
    const COL_ADDRESS_LINE1 = 'customer.address_line1';

    /**
     * the column name for the address_line2 field
     */
    const COL_ADDRESS_LINE2 = 'customer.address_line2';

    /**
     * the column name for the house_number field
     */
    const COL_HOUSE_NUMBER = 'customer.house_number';

    /**
     * the column name for the postcode field
     */
    const COL_POSTCODE = 'customer.postcode';

    /**
     * the column name for the town field
     */
    const COL_TOWN = 'customer.town';

    /**
     * the column name for the county field
     */
    const COL_COUNTY = 'customer.county';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'customer.country';

    /**
     * the column name for the telephone1 field
     */
    const COL_TELEPHONE1 = 'customer.telephone1';

    /**
     * the column name for the telephone2 field
     */
    const COL_TELEPHONE2 = 'customer.telephone2';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'customer.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'customer.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Username', 'Title', 'FirstName', 'SecondName', 'FirstSurname', 'SecondSurname', 'AddressLine1', 'AddressLine2', 'HouseNumber', 'Postcode', 'Town', 'County', 'Country', 'Telephone1', 'Telephone2', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'username', 'title', 'firstName', 'secondName', 'firstSurname', 'secondSurname', 'addressLine1', 'addressLine2', 'houseNumber', 'postcode', 'town', 'county', 'country', 'telephone1', 'telephone2', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(CustomerTableMap::COL_ID, CustomerTableMap::COL_USERNAME, CustomerTableMap::COL_TITLE, CustomerTableMap::COL_FIRST_NAME, CustomerTableMap::COL_SECOND_NAME, CustomerTableMap::COL_FIRST_SURNAME, CustomerTableMap::COL_SECOND_SURNAME, CustomerTableMap::COL_ADDRESS_LINE1, CustomerTableMap::COL_ADDRESS_LINE2, CustomerTableMap::COL_HOUSE_NUMBER, CustomerTableMap::COL_POSTCODE, CustomerTableMap::COL_TOWN, CustomerTableMap::COL_COUNTY, CustomerTableMap::COL_COUNTRY, CustomerTableMap::COL_TELEPHONE1, CustomerTableMap::COL_TELEPHONE2, CustomerTableMap::COL_CREATED_AT, CustomerTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'username', 'title', 'first_name', 'second_name', 'first_surname', 'second_surname', 'address_line1', 'address_line2', 'house_number', 'postcode', 'town', 'county', 'country', 'telephone1', 'telephone2', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Username' => 1, 'Title' => 2, 'FirstName' => 3, 'SecondName' => 4, 'FirstSurname' => 5, 'SecondSurname' => 6, 'AddressLine1' => 7, 'AddressLine2' => 8, 'HouseNumber' => 9, 'Postcode' => 10, 'Town' => 11, 'County' => 12, 'Country' => 13, 'Telephone1' => 14, 'Telephone2' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'username' => 1, 'title' => 2, 'firstName' => 3, 'secondName' => 4, 'firstSurname' => 5, 'secondSurname' => 6, 'addressLine1' => 7, 'addressLine2' => 8, 'houseNumber' => 9, 'postcode' => 10, 'town' => 11, 'county' => 12, 'country' => 13, 'telephone1' => 14, 'telephone2' => 15, 'createdAt' => 16, 'updatedAt' => 17, ),
        self::TYPE_COLNAME       => array(CustomerTableMap::COL_ID => 0, CustomerTableMap::COL_USERNAME => 1, CustomerTableMap::COL_TITLE => 2, CustomerTableMap::COL_FIRST_NAME => 3, CustomerTableMap::COL_SECOND_NAME => 4, CustomerTableMap::COL_FIRST_SURNAME => 5, CustomerTableMap::COL_SECOND_SURNAME => 6, CustomerTableMap::COL_ADDRESS_LINE1 => 7, CustomerTableMap::COL_ADDRESS_LINE2 => 8, CustomerTableMap::COL_HOUSE_NUMBER => 9, CustomerTableMap::COL_POSTCODE => 10, CustomerTableMap::COL_TOWN => 11, CustomerTableMap::COL_COUNTY => 12, CustomerTableMap::COL_COUNTRY => 13, CustomerTableMap::COL_TELEPHONE1 => 14, CustomerTableMap::COL_TELEPHONE2 => 15, CustomerTableMap::COL_CREATED_AT => 16, CustomerTableMap::COL_UPDATED_AT => 17, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'username' => 1, 'title' => 2, 'first_name' => 3, 'second_name' => 4, 'first_surname' => 5, 'second_surname' => 6, 'address_line1' => 7, 'address_line2' => 8, 'house_number' => 9, 'postcode' => 10, 'town' => 11, 'county' => 12, 'country' => 13, 'telephone1' => 14, 'telephone2' => 15, 'created_at' => 16, 'updated_at' => 17, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
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
        $this->setName('customer');
        $this->setPhpName('Customer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AbcBank\\Resources\\Customer');
        $this->setPackage('AbcBank.Resources');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addPrimaryKey('username', 'Username', 'VARCHAR', true, 255, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 255, null);
        $this->addColumn('second_name', 'SecondName', 'VARCHAR', false, 255, null);
        $this->addColumn('first_surname', 'FirstSurname', 'VARCHAR', true, 255, null);
        $this->addColumn('second_surname', 'SecondSurname', 'VARCHAR', true, 255, null);
        $this->addColumn('address_line1', 'AddressLine1', 'VARCHAR', true, 255, null);
        $this->addColumn('address_line2', 'AddressLine2', 'VARCHAR', false, 255, null);
        $this->addColumn('house_number', 'HouseNumber', 'VARCHAR', false, 255, null);
        $this->addColumn('postcode', 'Postcode', 'VARCHAR', true, 255, null);
        $this->addColumn('town', 'Town', 'VARCHAR', true, 255, null);
        $this->addColumn('county', 'County', 'VARCHAR', false, 255, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 255, null);
        $this->addColumn('telephone1', 'Telephone1', 'VARCHAR', true, 255, null);
        $this->addColumn('telephone2', 'Telephone2', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Account', '\\AbcBank\\Resources\\Account', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customer_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Accounts', false);
        $this->addRelation('Transaction', '\\AbcBank\\Resources\\Transaction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':customer_id',
    1 => ':id',
  ),
), 'CASCADE', null, 'Transactions', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
            'validate' => array('rule1' => array ('column' => 'first_name','validator' => 'NotNull',), 'rule2' => array ('column' => 'first_surname','validator' => 'NotNull',), 'rule3' => array ('column' => 'username','validator' => 'NotNull',), 'rule4' => array ('column' => 'username','validator' => 'Length','options' => array ('min' => 3,),), 'rule5' => array ('column' => 'address_line1','validator' => 'NotNull',), 'rule6' => array ('column' => 'username','validator' => 'NotNull',), 'rule7' => array ('column' => 'username','validator' => 'NotNull',), 'rule8' => array ('column' => 'postcode','validator' => 'NotNull',), 'rule9' => array ('column' => 'country','validator' => 'NotNull',), 'rule10' => array ('column' => 'telephone1','validator' => 'NotNull',), ),
        );
    } // getBehaviors()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \AbcBank\Resources\Customer $obj A \AbcBank\Resources\Customer object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getUsername()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \AbcBank\Resources\Customer object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \AbcBank\Resources\Customer) {
                $key = serialize(array((string) $value->getId(), (string) $value->getUsername()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \AbcBank\Resources\Customer object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }
    /**
     * Method to invalidate the instance pool of all tables related to customer     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AccountTableMap::clearInstancePool();
        TransactionTableMap::clearInstancePool();
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)]));
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? CustomerTableMap::CLASS_DEFAULT : CustomerTableMap::OM_CLASS;
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
     * @return array           (Customer object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CustomerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CustomerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CustomerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CustomerTableMap::OM_CLASS;
            /** @var Customer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CustomerTableMap::addInstanceToPool($obj, $key);
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
            $key = CustomerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CustomerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Customer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CustomerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CustomerTableMap::COL_ID);
            $criteria->addSelectColumn(CustomerTableMap::COL_USERNAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_TITLE);
            $criteria->addSelectColumn(CustomerTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_SECOND_NAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_FIRST_SURNAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_SECOND_SURNAME);
            $criteria->addSelectColumn(CustomerTableMap::COL_ADDRESS_LINE1);
            $criteria->addSelectColumn(CustomerTableMap::COL_ADDRESS_LINE2);
            $criteria->addSelectColumn(CustomerTableMap::COL_HOUSE_NUMBER);
            $criteria->addSelectColumn(CustomerTableMap::COL_POSTCODE);
            $criteria->addSelectColumn(CustomerTableMap::COL_TOWN);
            $criteria->addSelectColumn(CustomerTableMap::COL_COUNTY);
            $criteria->addSelectColumn(CustomerTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(CustomerTableMap::COL_TELEPHONE1);
            $criteria->addSelectColumn(CustomerTableMap::COL_TELEPHONE2);
            $criteria->addSelectColumn(CustomerTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CustomerTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.second_name');
            $criteria->addSelectColumn($alias . '.first_surname');
            $criteria->addSelectColumn($alias . '.second_surname');
            $criteria->addSelectColumn($alias . '.address_line1');
            $criteria->addSelectColumn($alias . '.address_line2');
            $criteria->addSelectColumn($alias . '.house_number');
            $criteria->addSelectColumn($alias . '.postcode');
            $criteria->addSelectColumn($alias . '.town');
            $criteria->addSelectColumn($alias . '.county');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.telephone1');
            $criteria->addSelectColumn($alias . '.telephone2');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(CustomerTableMap::DATABASE_NAME)->getTable(CustomerTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CustomerTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CustomerTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CustomerTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Customer or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Customer object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AbcBank\Resources\Customer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CustomerTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(CustomerTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(CustomerTableMap::COL_USERNAME, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = CustomerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CustomerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CustomerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the customer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CustomerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Customer or Criteria object.
     *
     * @param mixed               $criteria Criteria or Customer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CustomerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Customer object
        }

        if ($criteria->containsKey(CustomerTableMap::COL_ID) && $criteria->keyContainsValue(CustomerTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CustomerTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CustomerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CustomerTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CustomerTableMap::buildTableMap();
