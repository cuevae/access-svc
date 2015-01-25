<?php

namespace AbcBank\Resources\Map;

use AbcBank\Resources\Address;
use AbcBank\Resources\AddressQuery;
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
 * This class defines the structure of the 'address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'AbcBank.Resources.Map.AddressTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'abcbank';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'address';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\AbcBank\\Resources\\Address';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'AbcBank.Resources.Address';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id field
     */
    const COL_ID = 'address.id';

    /**
     * the column name for the client_id field
     */
    const COL_CLIENT_ID = 'address.client_id';

    /**
     * the column name for the number field
     */
    const COL_NUMBER = 'address.number';

    /**
     * the column name for the line_1 field
     */
    const COL_LINE_1 = 'address.line_1';

    /**
     * the column name for the line_2 field
     */
    const COL_LINE_2 = 'address.line_2';

    /**
     * the column name for the line_3 field
     */
    const COL_LINE_3 = 'address.line_3';

    /**
     * the column name for the postcode field
     */
    const COL_POSTCODE = 'address.postcode';

    /**
     * the column name for the town field
     */
    const COL_TOWN = 'address.town';

    /**
     * the column name for the county field
     */
    const COL_COUNTY = 'address.county';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'address.country';

    /**
     * the column name for the telephone_1 field
     */
    const COL_TELEPHONE_1 = 'address.telephone_1';

    /**
     * the column name for the telephone_2 field
     */
    const COL_TELEPHONE_2 = 'address.telephone_2';

    /**
     * the column name for the telephone_3 field
     */
    const COL_TELEPHONE_3 = 'address.telephone_3';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'address.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'address.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'ClientId', 'Number', 'Line1', 'Line2', 'Line3', 'Postcode', 'Town', 'County', 'Country', 'Telephone1', 'Telephone2', 'Telephone3', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'clientId', 'number', 'line1', 'line2', 'line3', 'postcode', 'town', 'county', 'country', 'telephone1', 'telephone2', 'telephone3', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(AddressTableMap::COL_ID, AddressTableMap::COL_CLIENT_ID, AddressTableMap::COL_NUMBER, AddressTableMap::COL_LINE_1, AddressTableMap::COL_LINE_2, AddressTableMap::COL_LINE_3, AddressTableMap::COL_POSTCODE, AddressTableMap::COL_TOWN, AddressTableMap::COL_COUNTY, AddressTableMap::COL_COUNTRY, AddressTableMap::COL_TELEPHONE_1, AddressTableMap::COL_TELEPHONE_2, AddressTableMap::COL_TELEPHONE_3, AddressTableMap::COL_CREATED_AT, AddressTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'client_id', 'number', 'line_1', 'line_2', 'line_3', 'postcode', 'town', 'county', 'country', 'telephone_1', 'telephone_2', 'telephone_3', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ClientId' => 1, 'Number' => 2, 'Line1' => 3, 'Line2' => 4, 'Line3' => 5, 'Postcode' => 6, 'Town' => 7, 'County' => 8, 'Country' => 9, 'Telephone1' => 10, 'Telephone2' => 11, 'Telephone3' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'clientId' => 1, 'number' => 2, 'line1' => 3, 'line2' => 4, 'line3' => 5, 'postcode' => 6, 'town' => 7, 'county' => 8, 'country' => 9, 'telephone1' => 10, 'telephone2' => 11, 'telephone3' => 12, 'createdAt' => 13, 'updatedAt' => 14, ),
        self::TYPE_COLNAME       => array(AddressTableMap::COL_ID => 0, AddressTableMap::COL_CLIENT_ID => 1, AddressTableMap::COL_NUMBER => 2, AddressTableMap::COL_LINE_1 => 3, AddressTableMap::COL_LINE_2 => 4, AddressTableMap::COL_LINE_3 => 5, AddressTableMap::COL_POSTCODE => 6, AddressTableMap::COL_TOWN => 7, AddressTableMap::COL_COUNTY => 8, AddressTableMap::COL_COUNTRY => 9, AddressTableMap::COL_TELEPHONE_1 => 10, AddressTableMap::COL_TELEPHONE_2 => 11, AddressTableMap::COL_TELEPHONE_3 => 12, AddressTableMap::COL_CREATED_AT => 13, AddressTableMap::COL_UPDATED_AT => 14, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'client_id' => 1, 'number' => 2, 'line_1' => 3, 'line_2' => 4, 'line_3' => 5, 'postcode' => 6, 'town' => 7, 'county' => 8, 'country' => 9, 'telephone_1' => 10, 'telephone_2' => 11, 'telephone_3' => 12, 'created_at' => 13, 'updated_at' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
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
        $this->setName('address');
        $this->setPhpName('Address');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AbcBank\\Resources\\Address');
        $this->setPackage('AbcBank.Resources');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('client_id', 'ClientId', 'INTEGER', 'client', 'id', true, null, null);
        $this->addColumn('number', 'Number', 'VARCHAR', true, 255, null);
        $this->addColumn('line_1', 'Line1', 'VARCHAR', true, 255, null);
        $this->addColumn('line_2', 'Line2', 'VARCHAR', false, 255, null);
        $this->addColumn('line_3', 'Line3', 'VARCHAR', false, 255, null);
        $this->addColumn('postcode', 'Postcode', 'VARCHAR', true, 255, null);
        $this->addColumn('town', 'Town', 'VARCHAR', true, 255, null);
        $this->addColumn('county', 'County', 'VARCHAR', true, 255, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 255, null);
        $this->addColumn('telephone_1', 'Telephone1', 'VARCHAR', true, 255, null);
        $this->addColumn('telephone_2', 'Telephone2', 'VARCHAR', false, 255, null);
        $this->addColumn('telephone_3', 'Telephone3', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Client', '\\AbcBank\\Resources\\Client', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':client_id',
    1 => ':id',
  ),
), null, null, null, false);
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
        );
    } // getBehaviors()

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
        return $withPrefix ? AddressTableMap::CLASS_DEFAULT : AddressTableMap::OM_CLASS;
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
     * @return array           (Address object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AddressTableMap::OM_CLASS;
            /** @var Address $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AddressTableMap::addInstanceToPool($obj, $key);
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
            $key = AddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Address $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AddressTableMap::COL_ID);
            $criteria->addSelectColumn(AddressTableMap::COL_CLIENT_ID);
            $criteria->addSelectColumn(AddressTableMap::COL_NUMBER);
            $criteria->addSelectColumn(AddressTableMap::COL_LINE_1);
            $criteria->addSelectColumn(AddressTableMap::COL_LINE_2);
            $criteria->addSelectColumn(AddressTableMap::COL_LINE_3);
            $criteria->addSelectColumn(AddressTableMap::COL_POSTCODE);
            $criteria->addSelectColumn(AddressTableMap::COL_TOWN);
            $criteria->addSelectColumn(AddressTableMap::COL_COUNTY);
            $criteria->addSelectColumn(AddressTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(AddressTableMap::COL_TELEPHONE_1);
            $criteria->addSelectColumn(AddressTableMap::COL_TELEPHONE_2);
            $criteria->addSelectColumn(AddressTableMap::COL_TELEPHONE_3);
            $criteria->addSelectColumn(AddressTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AddressTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.client_id');
            $criteria->addSelectColumn($alias . '.number');
            $criteria->addSelectColumn($alias . '.line_1');
            $criteria->addSelectColumn($alias . '.line_2');
            $criteria->addSelectColumn($alias . '.line_3');
            $criteria->addSelectColumn($alias . '.postcode');
            $criteria->addSelectColumn($alias . '.town');
            $criteria->addSelectColumn($alias . '.county');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.telephone_1');
            $criteria->addSelectColumn($alias . '.telephone_2');
            $criteria->addSelectColumn($alias . '.telephone_3');
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
        return Propel::getServiceContainer()->getDatabaseMap(AddressTableMap::DATABASE_NAME)->getTable(AddressTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AddressTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AddressTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AddressTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Address or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Address object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AbcBank\Resources\Address) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AddressTableMap::DATABASE_NAME);
            $criteria->add(AddressTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Address or Criteria object.
     *
     * @param mixed               $criteria Criteria or Address object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Address object
        }

        if ($criteria->containsKey(AddressTableMap::COL_ID) && $criteria->keyContainsValue(AddressTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AddressTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AddressTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AddressTableMap::buildTableMap();
