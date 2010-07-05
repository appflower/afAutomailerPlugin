<?php

/**
 * Base class that represents a row from the 'af_automailer' table.
 *
 * 
 *
 * @package    plugins.afAutomailerPlugin.lib.model.om
 */
abstract class BaseAutomailer extends BaseObject  implements Persistent {


  const PEER = 'AutomailerPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AutomailerPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the from_email field.
	 * Note: this column has a database default value of: 'null'
	 * @var        string
	 */
	protected $from_email;

	/**
	 * The value for the from_name field.
	 * @var        string
	 */
	protected $from_name;

	/**
	 * The value for the to_email field.
	 * Note: this column has a database default value of: 'null'
	 * @var        string
	 */
	protected $to_email;

	/**
	 * The value for the subject field.
	 * @var        string
	 */
	protected $subject;

	/**
	 * The value for the body field.
	 * @var        string
	 */
	protected $body;

	/**
	 * The value for the alt_body field.
	 * @var        string
	 */
	protected $alt_body;

	/**
	 * The value for the sent_date field.
	 * @var        string
	 */
	protected $sent_date;

	/**
	 * The value for the is_sent field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_sent;

	/**
	 * The value for the is_html field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_html;

	/**
	 * The value for the is_failed field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_failed;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of BaseAutomailer object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->from_email = 'null';
		$this->to_email = 'null';
		$this->is_sent = 0;
		$this->is_html = 0;
		$this->is_failed = 0;
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [from_email] column value.
	 * 
	 * @return     string
	 */
	public function getFromEmail()
	{
		return $this->from_email;
	}

	/**
	 * Get the [from_name] column value.
	 * 
	 * @return     string
	 */
	public function getFromName()
	{
		return $this->from_name;
	}

	/**
	 * Get the [to_email] column value.
	 * 
	 * @return     string
	 */
	public function getToEmail()
	{
		return $this->to_email;
	}

	/**
	 * Get the [subject] column value.
	 * 
	 * @return     string
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * Get the [body] column value.
	 * 
	 * @return     string
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * Get the [alt_body] column value.
	 * 
	 * @return     string
	 */
	public function getAltBody()
	{
		return $this->alt_body;
	}

	/**
	 * Get the [optionally formatted] temporal [sent_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getSentDate($format = 'Y-m-d H:i:s')
	{
		if ($this->sent_date === null) {
			return null;
		}


		if ($this->sent_date === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->sent_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->sent_date, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [is_sent] column value.
	 * 
	 * @return     int
	 */
	public function getIsSent()
	{
		return $this->is_sent;
	}

	/**
	 * Get the [is_html] column value.
	 * 
	 * @return     int
	 */
	public function getIsHtml()
	{
		return $this->is_html;
	}

	/**
	 * Get the [is_failed] column value.
	 * 
	 * @return     int
	 */
	public function getIsFailed()
	{
		return $this->is_failed;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AutomailerPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [from_email] column.
	 * 
	 * @param      string $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setFromEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->from_email !== $v || $v === 'null') {
			$this->from_email = $v;
			$this->modifiedColumns[] = AutomailerPeer::FROM_EMAIL;
		}

		return $this;
	} // setFromEmail()

	/**
	 * Set the value of [from_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setFromName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->from_name !== $v) {
			$this->from_name = $v;
			$this->modifiedColumns[] = AutomailerPeer::FROM_NAME;
		}

		return $this;
	} // setFromName()

	/**
	 * Set the value of [to_email] column.
	 * 
	 * @param      string $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setToEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->to_email !== $v || $v === 'null') {
			$this->to_email = $v;
			$this->modifiedColumns[] = AutomailerPeer::TO_EMAIL;
		}

		return $this;
	} // setToEmail()

	/**
	 * Set the value of [subject] column.
	 * 
	 * @param      string $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setSubject($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->subject !== $v) {
			$this->subject = $v;
			$this->modifiedColumns[] = AutomailerPeer::SUBJECT;
		}

		return $this;
	} // setSubject()

	/**
	 * Set the value of [body] column.
	 * 
	 * @param      string $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setBody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = AutomailerPeer::BODY;
		}

		return $this;
	} // setBody()

	/**
	 * Set the value of [alt_body] column.
	 * 
	 * @param      string $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setAltBody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->alt_body !== $v) {
			$this->alt_body = $v;
			$this->modifiedColumns[] = AutomailerPeer::ALT_BODY;
		}

		return $this;
	} // setAltBody()

	/**
	 * Sets the value of [sent_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setSentDate($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->sent_date !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->sent_date !== null && $tmpDt = new DateTime($this->sent_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->sent_date = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = AutomailerPeer::SENT_DATE;
			}
		} // if either are not null

		return $this;
	} // setSentDate()

	/**
	 * Set the value of [is_sent] column.
	 * 
	 * @param      int $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setIsSent($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_sent !== $v || $v === 0) {
			$this->is_sent = $v;
			$this->modifiedColumns[] = AutomailerPeer::IS_SENT;
		}

		return $this;
	} // setIsSent()

	/**
	 * Set the value of [is_html] column.
	 * 
	 * @param      int $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setIsHtml($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_html !== $v || $v === 0) {
			$this->is_html = $v;
			$this->modifiedColumns[] = AutomailerPeer::IS_HTML;
		}

		return $this;
	} // setIsHtml()

	/**
	 * Set the value of [is_failed] column.
	 * 
	 * @param      int $v new value
	 * @return     Automailer The current object (for fluent API support)
	 */
	public function setIsFailed($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_failed !== $v || $v === 0) {
			$this->is_failed = $v;
			$this->modifiedColumns[] = AutomailerPeer::IS_FAILED;
		}

		return $this;
	} // setIsFailed()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array(AutomailerPeer::FROM_EMAIL,AutomailerPeer::TO_EMAIL,AutomailerPeer::IS_SENT,AutomailerPeer::IS_HTML,AutomailerPeer::IS_FAILED))) {
				return false;
			}

			if ($this->from_email !== 'null') {
				return false;
			}

			if ($this->to_email !== 'null') {
				return false;
			}

			if ($this->is_sent !== 0) {
				return false;
			}

			if ($this->is_html !== 0) {
				return false;
			}

			if ($this->is_failed !== 0) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->from_email = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->from_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->to_email = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->subject = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->body = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->alt_body = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->sent_date = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->is_sent = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->is_html = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->is_failed = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = AutomailerPeer::NUM_COLUMNS - AutomailerPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Automailer object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AutomailerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AutomailerPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAutomailer:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AutomailerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AutomailerPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAutomailer:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAutomailer:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AutomailerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAutomailer:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			AutomailerPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AutomailerPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AutomailerPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += AutomailerPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = AutomailerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AutomailerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getFromEmail();
				break;
			case 2:
				return $this->getFromName();
				break;
			case 3:
				return $this->getToEmail();
				break;
			case 4:
				return $this->getSubject();
				break;
			case 5:
				return $this->getBody();
				break;
			case 6:
				return $this->getAltBody();
				break;
			case 7:
				return $this->getSentDate();
				break;
			case 8:
				return $this->getIsSent();
				break;
			case 9:
				return $this->getIsHtml();
				break;
			case 10:
				return $this->getIsFailed();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AutomailerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getFromEmail(),
			$keys[2] => $this->getFromName(),
			$keys[3] => $this->getToEmail(),
			$keys[4] => $this->getSubject(),
			$keys[5] => $this->getBody(),
			$keys[6] => $this->getAltBody(),
			$keys[7] => $this->getSentDate(),
			$keys[8] => $this->getIsSent(),
			$keys[9] => $this->getIsHtml(),
			$keys[10] => $this->getIsFailed(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AutomailerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setFromEmail($value);
				break;
			case 2:
				$this->setFromName($value);
				break;
			case 3:
				$this->setToEmail($value);
				break;
			case 4:
				$this->setSubject($value);
				break;
			case 5:
				$this->setBody($value);
				break;
			case 6:
				$this->setAltBody($value);
				break;
			case 7:
				$this->setSentDate($value);
				break;
			case 8:
				$this->setIsSent($value);
				break;
			case 9:
				$this->setIsHtml($value);
				break;
			case 10:
				$this->setIsFailed($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AutomailerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFromEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFromName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setToEmail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSubject($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setBody($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAltBody($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSentDate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIsSent($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIsHtml($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsFailed($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AutomailerPeer::DATABASE_NAME);

		if ($this->isColumnModified(AutomailerPeer::ID)) $criteria->add(AutomailerPeer::ID, $this->id);
		if ($this->isColumnModified(AutomailerPeer::FROM_EMAIL)) $criteria->add(AutomailerPeer::FROM_EMAIL, $this->from_email);
		if ($this->isColumnModified(AutomailerPeer::FROM_NAME)) $criteria->add(AutomailerPeer::FROM_NAME, $this->from_name);
		if ($this->isColumnModified(AutomailerPeer::TO_EMAIL)) $criteria->add(AutomailerPeer::TO_EMAIL, $this->to_email);
		if ($this->isColumnModified(AutomailerPeer::SUBJECT)) $criteria->add(AutomailerPeer::SUBJECT, $this->subject);
		if ($this->isColumnModified(AutomailerPeer::BODY)) $criteria->add(AutomailerPeer::BODY, $this->body);
		if ($this->isColumnModified(AutomailerPeer::ALT_BODY)) $criteria->add(AutomailerPeer::ALT_BODY, $this->alt_body);
		if ($this->isColumnModified(AutomailerPeer::SENT_DATE)) $criteria->add(AutomailerPeer::SENT_DATE, $this->sent_date);
		if ($this->isColumnModified(AutomailerPeer::IS_SENT)) $criteria->add(AutomailerPeer::IS_SENT, $this->is_sent);
		if ($this->isColumnModified(AutomailerPeer::IS_HTML)) $criteria->add(AutomailerPeer::IS_HTML, $this->is_html);
		if ($this->isColumnModified(AutomailerPeer::IS_FAILED)) $criteria->add(AutomailerPeer::IS_FAILED, $this->is_failed);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AutomailerPeer::DATABASE_NAME);

		$criteria->add(AutomailerPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Automailer (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFromEmail($this->from_email);

		$copyObj->setFromName($this->from_name);

		$copyObj->setToEmail($this->to_email);

		$copyObj->setSubject($this->subject);

		$copyObj->setBody($this->body);

		$copyObj->setAltBody($this->alt_body);

		$copyObj->setSentDate($this->sent_date);

		$copyObj->setIsSent($this->is_sent);

		$copyObj->setIsHtml($this->is_html);

		$copyObj->setIsFailed($this->is_failed);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Automailer Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     AutomailerPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AutomailerPeer();
		}
		return self::$peer;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAutomailer:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAutomailer::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseAutomailer
