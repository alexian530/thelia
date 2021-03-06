<?php

namespace Thelia\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Thelia\Model\ProductSaleElements as ChildProductSaleElements;
use Thelia\Model\ProductSaleElementsQuery as ChildProductSaleElementsQuery;
use Thelia\Model\Map\ProductSaleElementsTableMap;

/**
 * Base class that represents a query for the 'product_sale_elements' table.
 *
 *
 *
 * @method     ChildProductSaleElementsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductSaleElementsQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProductSaleElementsQuery orderByRef($order = Criteria::ASC) Order by the ref column
 * @method     ChildProductSaleElementsQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildProductSaleElementsQuery orderByPromo($order = Criteria::ASC) Order by the promo column
 * @method     ChildProductSaleElementsQuery orderByNewness($order = Criteria::ASC) Order by the newness column
 * @method     ChildProductSaleElementsQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildProductSaleElementsQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildProductSaleElementsQuery orderByEanCode($order = Criteria::ASC) Order by the ean_code column
 * @method     ChildProductSaleElementsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProductSaleElementsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProductSaleElementsQuery groupById() Group by the id column
 * @method     ChildProductSaleElementsQuery groupByProductId() Group by the product_id column
 * @method     ChildProductSaleElementsQuery groupByRef() Group by the ref column
 * @method     ChildProductSaleElementsQuery groupByQuantity() Group by the quantity column
 * @method     ChildProductSaleElementsQuery groupByPromo() Group by the promo column
 * @method     ChildProductSaleElementsQuery groupByNewness() Group by the newness column
 * @method     ChildProductSaleElementsQuery groupByWeight() Group by the weight column
 * @method     ChildProductSaleElementsQuery groupByIsDefault() Group by the is_default column
 * @method     ChildProductSaleElementsQuery groupByEanCode() Group by the ean_code column
 * @method     ChildProductSaleElementsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProductSaleElementsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProductSaleElementsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductSaleElementsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductSaleElementsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductSaleElementsQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProductSaleElementsQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProductSaleElementsQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProductSaleElementsQuery leftJoinAttributeCombination($relationAlias = null) Adds a LEFT JOIN clause to the query using the AttributeCombination relation
 * @method     ChildProductSaleElementsQuery rightJoinAttributeCombination($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AttributeCombination relation
 * @method     ChildProductSaleElementsQuery innerJoinAttributeCombination($relationAlias = null) Adds a INNER JOIN clause to the query using the AttributeCombination relation
 *
 * @method     ChildProductSaleElementsQuery leftJoinCartItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the CartItem relation
 * @method     ChildProductSaleElementsQuery rightJoinCartItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CartItem relation
 * @method     ChildProductSaleElementsQuery innerJoinCartItem($relationAlias = null) Adds a INNER JOIN clause to the query using the CartItem relation
 *
 * @method     ChildProductSaleElementsQuery leftJoinProductPrice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductPrice relation
 * @method     ChildProductSaleElementsQuery rightJoinProductPrice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductPrice relation
 * @method     ChildProductSaleElementsQuery innerJoinProductPrice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductPrice relation
 *
 * @method     ChildProductSaleElements findOne(ConnectionInterface $con = null) Return the first ChildProductSaleElements matching the query
 * @method     ChildProductSaleElements findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductSaleElements matching the query, or a new ChildProductSaleElements object populated from the query conditions when no match is found
 *
 * @method     ChildProductSaleElements findOneById(int $id) Return the first ChildProductSaleElements filtered by the id column
 * @method     ChildProductSaleElements findOneByProductId(int $product_id) Return the first ChildProductSaleElements filtered by the product_id column
 * @method     ChildProductSaleElements findOneByRef(string $ref) Return the first ChildProductSaleElements filtered by the ref column
 * @method     ChildProductSaleElements findOneByQuantity(double $quantity) Return the first ChildProductSaleElements filtered by the quantity column
 * @method     ChildProductSaleElements findOneByPromo(int $promo) Return the first ChildProductSaleElements filtered by the promo column
 * @method     ChildProductSaleElements findOneByNewness(int $newness) Return the first ChildProductSaleElements filtered by the newness column
 * @method     ChildProductSaleElements findOneByWeight(double $weight) Return the first ChildProductSaleElements filtered by the weight column
 * @method     ChildProductSaleElements findOneByIsDefault(boolean $is_default) Return the first ChildProductSaleElements filtered by the is_default column
 * @method     ChildProductSaleElements findOneByEanCode(string $ean_code) Return the first ChildProductSaleElements filtered by the ean_code column
 * @method     ChildProductSaleElements findOneByCreatedAt(string $created_at) Return the first ChildProductSaleElements filtered by the created_at column
 * @method     ChildProductSaleElements findOneByUpdatedAt(string $updated_at) Return the first ChildProductSaleElements filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildProductSaleElements objects filtered by the id column
 * @method     array findByProductId(int $product_id) Return ChildProductSaleElements objects filtered by the product_id column
 * @method     array findByRef(string $ref) Return ChildProductSaleElements objects filtered by the ref column
 * @method     array findByQuantity(double $quantity) Return ChildProductSaleElements objects filtered by the quantity column
 * @method     array findByPromo(int $promo) Return ChildProductSaleElements objects filtered by the promo column
 * @method     array findByNewness(int $newness) Return ChildProductSaleElements objects filtered by the newness column
 * @method     array findByWeight(double $weight) Return ChildProductSaleElements objects filtered by the weight column
 * @method     array findByIsDefault(boolean $is_default) Return ChildProductSaleElements objects filtered by the is_default column
 * @method     array findByEanCode(string $ean_code) Return ChildProductSaleElements objects filtered by the ean_code column
 * @method     array findByCreatedAt(string $created_at) Return ChildProductSaleElements objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildProductSaleElements objects filtered by the updated_at column
 *
 */
abstract class ProductSaleElementsQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Thelia\Model\Base\ProductSaleElementsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Thelia\\Model\\ProductSaleElements', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductSaleElementsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductSaleElementsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Thelia\Model\ProductSaleElementsQuery) {
            return $criteria;
        }
        $query = new \Thelia\Model\ProductSaleElementsQuery();
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
     * @return ChildProductSaleElements|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProductSaleElementsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductSaleElementsTableMap::DATABASE_NAME);
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
     * @return   ChildProductSaleElements A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `PRODUCT_ID`, `REF`, `QUANTITY`, `PROMO`, `NEWNESS`, `WEIGHT`, `IS_DEFAULT`, `EAN_CODE`, `CREATED_AT`, `UPDATED_AT` FROM `product_sale_elements` WHERE `ID` = :p0';
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
            $obj = new ChildProductSaleElements();
            $obj->hydrate($row);
            ProductSaleElementsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProductSaleElements|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
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
    public function findPks($keys, $con = null)
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
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductSaleElementsTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductSaleElementsTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @see       filterByProduct()
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the ref column
     *
     * Example usage:
     * <code>
     * $query->filterByRef('fooValue');   // WHERE ref = 'fooValue'
     * $query->filterByRef('%fooValue%'); // WHERE ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ref The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByRef($ref = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ref)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ref)) {
                $ref = str_replace('*', '%', $ref);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::REF, $ref, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the promo column
     *
     * Example usage:
     * <code>
     * $query->filterByPromo(1234); // WHERE promo = 1234
     * $query->filterByPromo(array(12, 34)); // WHERE promo IN (12, 34)
     * $query->filterByPromo(array('min' => 12)); // WHERE promo > 12
     * </code>
     *
     * @param     mixed $promo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByPromo($promo = null, $comparison = null)
    {
        if (is_array($promo)) {
            $useMinMax = false;
            if (isset($promo['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::PROMO, $promo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promo['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::PROMO, $promo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::PROMO, $promo, $comparison);
    }

    /**
     * Filter the query on the newness column
     *
     * Example usage:
     * <code>
     * $query->filterByNewness(1234); // WHERE newness = 1234
     * $query->filterByNewness(array(12, 34)); // WHERE newness IN (12, 34)
     * $query->filterByNewness(array('min' => 12)); // WHERE newness > 12
     * </code>
     *
     * @param     mixed $newness The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByNewness($newness = null, $comparison = null)
    {
        if (is_array($newness)) {
            $useMinMax = false;
            if (isset($newness['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::NEWNESS, $newness['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newness['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::NEWNESS, $newness['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::NEWNESS, $newness, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight(1234); // WHERE weight = 1234
     * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
     * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
     * </code>
     *
     * @param     mixed $weight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (is_array($weight)) {
            $useMinMax = false;
            if (isset($weight['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weight['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::WEIGHT, $weight, $comparison);
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     boolean|string $isDefault The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, $comparison = null)
    {
        if (is_string($isDefault)) {
            $is_default = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::IS_DEFAULT, $isDefault, $comparison);
    }

    /**
     * Filter the query on the ean_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEanCode('fooValue');   // WHERE ean_code = 'fooValue'
     * $query->filterByEanCode('%fooValue%'); // WHERE ean_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eanCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByEanCode($eanCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eanCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $eanCode)) {
                $eanCode = str_replace('*', '%', $eanCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::EAN_CODE, $eanCode, $comparison);
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
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::CREATED_AT, $createdAt, $comparison);
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
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProductSaleElementsTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductSaleElementsTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Thelia\Model\Product object
     *
     * @param \Thelia\Model\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Thelia\Model\Product) {
            return $this
                ->addUsingAlias(ProductSaleElementsTableMap::PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductSaleElementsTableMap::PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \Thelia\Model\Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\Thelia\Model\ProductQuery');
    }

    /**
     * Filter the query by a related \Thelia\Model\AttributeCombination object
     *
     * @param \Thelia\Model\AttributeCombination|ObjectCollection $attributeCombination  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByAttributeCombination($attributeCombination, $comparison = null)
    {
        if ($attributeCombination instanceof \Thelia\Model\AttributeCombination) {
            return $this
                ->addUsingAlias(ProductSaleElementsTableMap::ID, $attributeCombination->getProductSaleElementsId(), $comparison);
        } elseif ($attributeCombination instanceof ObjectCollection) {
            return $this
                ->useAttributeCombinationQuery()
                ->filterByPrimaryKeys($attributeCombination->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAttributeCombination() only accepts arguments of type \Thelia\Model\AttributeCombination or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AttributeCombination relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function joinAttributeCombination($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AttributeCombination');

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
            $this->addJoinObject($join, 'AttributeCombination');
        }

        return $this;
    }

    /**
     * Use the AttributeCombination relation AttributeCombination object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\AttributeCombinationQuery A secondary query class using the current class as primary query
     */
    public function useAttributeCombinationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAttributeCombination($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AttributeCombination', '\Thelia\Model\AttributeCombinationQuery');
    }

    /**
     * Filter the query by a related \Thelia\Model\CartItem object
     *
     * @param \Thelia\Model\CartItem|ObjectCollection $cartItem  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByCartItem($cartItem, $comparison = null)
    {
        if ($cartItem instanceof \Thelia\Model\CartItem) {
            return $this
                ->addUsingAlias(ProductSaleElementsTableMap::ID, $cartItem->getProductSaleElementsId(), $comparison);
        } elseif ($cartItem instanceof ObjectCollection) {
            return $this
                ->useCartItemQuery()
                ->filterByPrimaryKeys($cartItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCartItem() only accepts arguments of type \Thelia\Model\CartItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CartItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function joinCartItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CartItem');

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
            $this->addJoinObject($join, 'CartItem');
        }

        return $this;
    }

    /**
     * Use the CartItem relation CartItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\CartItemQuery A secondary query class using the current class as primary query
     */
    public function useCartItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCartItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CartItem', '\Thelia\Model\CartItemQuery');
    }

    /**
     * Filter the query by a related \Thelia\Model\ProductPrice object
     *
     * @param \Thelia\Model\ProductPrice|ObjectCollection $productPrice  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function filterByProductPrice($productPrice, $comparison = null)
    {
        if ($productPrice instanceof \Thelia\Model\ProductPrice) {
            return $this
                ->addUsingAlias(ProductSaleElementsTableMap::ID, $productPrice->getProductSaleElementsId(), $comparison);
        } elseif ($productPrice instanceof ObjectCollection) {
            return $this
                ->useProductPriceQuery()
                ->filterByPrimaryKeys($productPrice->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductPrice() only accepts arguments of type \Thelia\Model\ProductPrice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductPrice relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function joinProductPrice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductPrice');

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
            $this->addJoinObject($join, 'ProductPrice');
        }

        return $this;
    }

    /**
     * Use the ProductPrice relation ProductPrice object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\ProductPriceQuery A secondary query class using the current class as primary query
     */
    public function useProductPriceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductPrice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductPrice', '\Thelia\Model\ProductPriceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProductSaleElements $productSaleElements Object to remove from the list of results
     *
     * @return ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function prune($productSaleElements = null)
    {
        if ($productSaleElements) {
            $this->addUsingAlias(ProductSaleElementsTableMap::ID, $productSaleElements->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_sale_elements table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductSaleElementsTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductSaleElementsTableMap::clearInstancePool();
            ProductSaleElementsTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildProductSaleElements or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildProductSaleElements object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductSaleElementsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductSaleElementsTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        ProductSaleElementsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductSaleElementsTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductSaleElementsTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ProductSaleElementsTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductSaleElementsTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductSaleElementsTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ProductSaleElementsTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildProductSaleElementsQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ProductSaleElementsTableMap::CREATED_AT);
    }

} // ProductSaleElementsQuery
