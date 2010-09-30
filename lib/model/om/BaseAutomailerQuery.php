<?php


/**
 * Base class that represents a query for the 'af_automailer' table.
 *
 * 
 *
 * @method     AutomailerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AutomailerQuery orderByFromEmail($order = Criteria::ASC) Order by the from_email column
 * @method     AutomailerQuery orderByFromName($order = Criteria::ASC) Order by the from_name column
 * @method     AutomailerQuery orderByToEmail($order = Criteria::ASC) Order by the to_email column
 * @method     AutomailerQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 * @method     AutomailerQuery orderByBody($order = Criteria::ASC) Order by the body column
 * @method     AutomailerQuery orderByAltBody($order = Criteria::ASC) Order by the alt_body column
 * @method     AutomailerQuery orderBySentDate($order = Criteria::ASC) Order by the sent_date column
 * @method     AutomailerQuery orderBySendAtDate($order = Criteria::ASC) Order by the send_at_date column
 * @method     AutomailerQuery orderByIsSent($order = Criteria::ASC) Order by the is_sent column
 * @method     AutomailerQuery orderByIsHtml($order = Criteria::ASC) Order by the is_html column
 * @method     AutomailerQuery orderByIsFailed($order = Criteria::ASC) Order by the is_failed column
 *
 * @method     AutomailerQuery groupById() Group by the id column
 * @method     AutomailerQuery groupByFromEmail() Group by the from_email column
 * @method     AutomailerQuery groupByFromName() Group by the from_name column
 * @method     AutomailerQuery groupByToEmail() Group by the to_email column
 * @method     AutomailerQuery groupBySubject() Group by the subject column
 * @method     AutomailerQuery groupByBody() Group by the body column
 * @method     AutomailerQuery groupByAltBody() Group by the alt_body column
 * @method     AutomailerQuery groupBySentDate() Group by the sent_date column
 * @method     AutomailerQuery groupBySendAtDate() Group by the send_at_date column
 * @method     AutomailerQuery groupByIsSent() Group by the is_sent column
 * @method     AutomailerQuery groupByIsHtml() Group by the is_html column
 * @method     AutomailerQuery groupByIsFailed() Group by the is_failed column
 *
 * @method     AutomailerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AutomailerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AutomailerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Automailer findOne(PropelPDO $con = null) Return the first Automailer matching the query
 * @method     Automailer findOneOrCreate(PropelPDO $con = null) Return the first Automailer matching the query, or a new Automailer object populated from the query conditions when no match is found
 *
 * @method     Automailer findOneById(int $id) Return the first Automailer filtered by the id column
 * @method     Automailer findOneByFromEmail(string $from_email) Return the first Automailer filtered by the from_email column
 * @method     Automailer findOneByFromName(string $from_name) Return the first Automailer filtered by the from_name column
 * @method     Automailer findOneByToEmail(string $to_email) Return the first Automailer filtered by the to_email column
 * @method     Automailer findOneBySubject(string $subject) Return the first Automailer filtered by the subject column
 * @method     Automailer findOneByBody(string $body) Return the first Automailer filtered by the body column
 * @method     Automailer findOneByAltBody(string $alt_body) Return the first Automailer filtered by the alt_body column
 * @method     Automailer findOneBySentDate(string $sent_date) Return the first Automailer filtered by the sent_date column
 * @method     Automailer findOneBySendAtDate(string $send_at_date) Return the first Automailer filtered by the send_at_date column
 * @method     Automailer findOneByIsSent(int $is_sent) Return the first Automailer filtered by the is_sent column
 * @method     Automailer findOneByIsHtml(int $is_html) Return the first Automailer filtered by the is_html column
 * @method     Automailer findOneByIsFailed(int $is_failed) Return the first Automailer filtered by the is_failed column
 *
 * @method     array findById(int $id) Return Automailer objects filtered by the id column
 * @method     array findByFromEmail(string $from_email) Return Automailer objects filtered by the from_email column
 * @method     array findByFromName(string $from_name) Return Automailer objects filtered by the from_name column
 * @method     array findByToEmail(string $to_email) Return Automailer objects filtered by the to_email column
 * @method     array findBySubject(string $subject) Return Automailer objects filtered by the subject column
 * @method     array findByBody(string $body) Return Automailer objects filtered by the body column
 * @method     array findByAltBody(string $alt_body) Return Automailer objects filtered by the alt_body column
 * @method     array findBySentDate(string $sent_date) Return Automailer objects filtered by the sent_date column
 * @method     array findBySendAtDate(string $send_at_date) Return Automailer objects filtered by the send_at_date column
 * @method     array findByIsSent(int $is_sent) Return Automailer objects filtered by the is_sent column
 * @method     array findByIsHtml(int $is_html) Return Automailer objects filtered by the is_html column
 * @method     array findByIsFailed(int $is_failed) Return Automailer objects filtered by the is_failed column
 *
 * @package    propel.generator.plugins.afAutomailerPlugin.lib.model.om
 */
abstract class BaseAutomailerQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseAutomailerQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'propel', $modelName = 'Automailer', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AutomailerQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AutomailerQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AutomailerQuery) {
			return $criteria;
		}
		$query = new AutomailerQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Automailer|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = AutomailerPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{	
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AutomailerPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AutomailerPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 * 
	 * @param     int|array $id The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AutomailerPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the from_email column
	 * 
	 * @param     string $fromEmail The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByFromEmail($fromEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fromEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fromEmail)) {
				$fromEmail = str_replace('*', '%', $fromEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::FROM_EMAIL, $fromEmail, $comparison);
	}

	/**
	 * Filter the query on the from_name column
	 * 
	 * @param     string $fromName The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByFromName($fromName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fromName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fromName)) {
				$fromName = str_replace('*', '%', $fromName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::FROM_NAME, $fromName, $comparison);
	}

	/**
	 * Filter the query on the to_email column
	 * 
	 * @param     string $toEmail The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByToEmail($toEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($toEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $toEmail)) {
				$toEmail = str_replace('*', '%', $toEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::TO_EMAIL, $toEmail, $comparison);
	}

	/**
	 * Filter the query on the subject column
	 * 
	 * @param     string $subject The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterBySubject($subject = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($subject)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $subject)) {
				$subject = str_replace('*', '%', $subject);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::SUBJECT, $subject, $comparison);
	}

	/**
	 * Filter the query on the body column
	 * 
	 * @param     string $body The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByBody($body = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($body)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $body)) {
				$body = str_replace('*', '%', $body);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::BODY, $body, $comparison);
	}

	/**
	 * Filter the query on the alt_body column
	 * 
	 * @param     string $altBody The value to use as filter.
	 *            Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByAltBody($altBody = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($altBody)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $altBody)) {
				$altBody = str_replace('*', '%', $altBody);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::ALT_BODY, $altBody, $comparison);
	}

	/**
	 * Filter the query on the sent_date column
	 * 
	 * @param     string|array $sentDate The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterBySentDate($sentDate = null, $comparison = null)
	{
		if (is_array($sentDate)) {
			$useMinMax = false;
			if (isset($sentDate['min'])) {
				$this->addUsingAlias(AutomailerPeer::SENT_DATE, $sentDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sentDate['max'])) {
				$this->addUsingAlias(AutomailerPeer::SENT_DATE, $sentDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::SENT_DATE, $sentDate, $comparison);
	}

	/**
	 * Filter the query on the send_at_date column
	 * 
	 * @param     string|array $sendAtDate The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterBySendAtDate($sendAtDate = null, $comparison = null)
	{
		if (is_array($sendAtDate)) {
			$useMinMax = false;
			if (isset($sendAtDate['min'])) {
				$this->addUsingAlias(AutomailerPeer::SEND_AT_DATE, $sendAtDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sendAtDate['max'])) {
				$this->addUsingAlias(AutomailerPeer::SEND_AT_DATE, $sendAtDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::SEND_AT_DATE, $sendAtDate, $comparison);
	}

	/**
	 * Filter the query on the is_sent column
	 * 
	 * @param     int|array $isSent The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByIsSent($isSent = null, $comparison = null)
	{
		if (is_array($isSent)) {
			$useMinMax = false;
			if (isset($isSent['min'])) {
				$this->addUsingAlias(AutomailerPeer::IS_SENT, $isSent['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isSent['max'])) {
				$this->addUsingAlias(AutomailerPeer::IS_SENT, $isSent['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::IS_SENT, $isSent, $comparison);
	}

	/**
	 * Filter the query on the is_html column
	 * 
	 * @param     int|array $isHtml The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByIsHtml($isHtml = null, $comparison = null)
	{
		if (is_array($isHtml)) {
			$useMinMax = false;
			if (isset($isHtml['min'])) {
				$this->addUsingAlias(AutomailerPeer::IS_HTML, $isHtml['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isHtml['max'])) {
				$this->addUsingAlias(AutomailerPeer::IS_HTML, $isHtml['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::IS_HTML, $isHtml, $comparison);
	}

	/**
	 * Filter the query on the is_failed column
	 * 
	 * @param     int|array $isFailed The value to use as filter.
	 *            Accepts an associative array('min' => $minValue, 'max' => $maxValue)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function filterByIsFailed($isFailed = null, $comparison = null)
	{
		if (is_array($isFailed)) {
			$useMinMax = false;
			if (isset($isFailed['min'])) {
				$this->addUsingAlias(AutomailerPeer::IS_FAILED, $isFailed['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isFailed['max'])) {
				$this->addUsingAlias(AutomailerPeer::IS_FAILED, $isFailed['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AutomailerPeer::IS_FAILED, $isFailed, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Automailer $automailer Object to remove from the list of results
	 *
	 * @return    AutomailerQuery The current query, for fluid interface
	 */
	public function prune($automailer = null)
	{
		if ($automailer) {
			$this->addUsingAlias(AutomailerPeer::ID, $automailer->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseAutomailerQuery
