<?php

namespace lwops\lwops\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use lwops\lwops\Expenseactivity as ChildExpenseactivity;
use lwops\lwops\ExpenseactivityQuery as ChildExpenseactivityQuery;
use lwops\lwops\Expenses as ChildExpenses;
use lwops\lwops\ExpensesQuery as ChildExpensesQuery;
use lwops\lwops\Map\ExpenseactivityTableMap;
use lwops\lwops\Map\ExpensesTableMap;

/**
 * Base class that represents a row from the 'expenseactivity' table.
 *
 *
 *
 * @package    propel.generator.lwops.lwops.Base
 */
abstract class Expenseactivity implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\lwops\\lwops\\Map\\ExpenseactivityTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the oid field.
     *
     * @var        int
     */
    protected $oid;

    /**
     * The value for the activity field.
     *
     * Note: this column has a database default value of: '00000'
     * @var        string
     */
    protected $activity;

    /**
     * The value for the createtmstp field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $createtmstp;

    /**
     * The value for the updttmstp field.
     *
     * @var        DateTime
     */
    protected $updttmstp;

    /**
     * @var        ObjectCollection|ChildExpenses[] Collection to store aggregation of ChildExpenses objects.
     */
    protected $collExpensess;
    protected $collExpensessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenses[]
     */
    protected $expensessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->activity = '00000';
    }

    /**
     * Initializes internal state of lwops\lwops\Base\Expenseactivity object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Expenseactivity</code> instance.  If
     * <code>obj</code> is an instance of <code>Expenseactivity</code>, delegates to
     * <code>equals(Expenseactivity)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Expenseactivity The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [oid] column value.
     *
     * @return int
     */
    public function getOid()
    {
        return $this->oid;
    }

    /**
     * Get the [activity] column value.
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Get the [optionally formatted] temporal [createtmstp] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatetmstp($format = NULL)
    {
        if ($format === null) {
            return $this->createtmstp;
        } else {
            return $this->createtmstp instanceof \DateTimeInterface ? $this->createtmstp->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updttmstp] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdttmstp($format = NULL)
    {
        if ($format === null) {
            return $this->updttmstp;
        } else {
            return $this->updttmstp instanceof \DateTimeInterface ? $this->updttmstp->format($format) : null;
        }
    }

    /**
     * Set the value of [oid] column.
     *
     * @param int $v new value
     * @return $this|\lwops\lwops\Expenseactivity The current object (for fluent API support)
     */
    public function setOid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->oid !== $v) {
            $this->oid = $v;
            $this->modifiedColumns[ExpenseactivityTableMap::COL_OID] = true;
        }

        return $this;
    } // setOid()

    /**
     * Set the value of [activity] column.
     *
     * @param string $v new value
     * @return $this|\lwops\lwops\Expenseactivity The current object (for fluent API support)
     */
    public function setActivity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->activity !== $v) {
            $this->activity = $v;
            $this->modifiedColumns[ExpenseactivityTableMap::COL_ACTIVITY] = true;
        }

        return $this;
    } // setActivity()

    /**
     * Sets the value of [createtmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Expenseactivity The current object (for fluent API support)
     */
    public function setCreatetmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createtmstp !== null || $dt !== null) {
            if ($this->createtmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->createtmstp->format("Y-m-d H:i:s.u")) {
                $this->createtmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExpenseactivityTableMap::COL_CREATETMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatetmstp()

    /**
     * Sets the value of [updttmstp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\lwops\lwops\Expenseactivity The current object (for fluent API support)
     */
    public function setUpdttmstp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updttmstp !== null || $dt !== null) {
            if ($this->updttmstp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updttmstp->format("Y-m-d H:i:s.u")) {
                $this->updttmstp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExpenseactivityTableMap::COL_UPDTTMSTP] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdttmstp()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->activity !== '00000') {
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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExpenseactivityTableMap::translateFieldName('Oid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->oid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExpenseactivityTableMap::translateFieldName('Activity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activity = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExpenseactivityTableMap::translateFieldName('Createtmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createtmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExpenseactivityTableMap::translateFieldName('Updttmstp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updttmstp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = ExpenseactivityTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\lwops\\lwops\\Expenseactivity'), 0, $e);
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
     * @throws PropelException
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
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseactivityTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildExpenseactivityQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collExpensess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Expenseactivity::setDeleted()
     * @see Expenseactivity::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseactivityTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildExpenseactivityQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseactivityTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ExpenseactivityTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->expensessScheduledForDeletion !== null) {
                if (!$this->expensessScheduledForDeletion->isEmpty()) {
                    \lwops\lwops\ExpensesQuery::create()
                        ->filterByPrimaryKeys($this->expensessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expensessScheduledForDeletion = null;
                }
            }

            if ($this->collExpensess !== null) {
                foreach ($this->collExpensess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ExpenseactivityTableMap::COL_OID] = true;
        if (null !== $this->oid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ExpenseactivityTableMap::COL_OID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ExpenseactivityTableMap::COL_OID)) {
            $modifiedColumns[':p' . $index++]  = 'oid';
        }
        if ($this->isColumnModified(ExpenseactivityTableMap::COL_ACTIVITY)) {
            $modifiedColumns[':p' . $index++]  = 'activity';
        }
        if ($this->isColumnModified(ExpenseactivityTableMap::COL_CREATETMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'createTmstp';
        }
        if ($this->isColumnModified(ExpenseactivityTableMap::COL_UPDTTMSTP)) {
            $modifiedColumns[':p' . $index++]  = 'updtTmstp';
        }

        $sql = sprintf(
            'INSERT INTO expenseactivity (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'oid':
                        $stmt->bindValue($identifier, $this->oid, PDO::PARAM_INT);
                        break;
                    case 'activity':
                        $stmt->bindValue($identifier, $this->activity, PDO::PARAM_STR);
                        break;
                    case 'createTmstp':
                        $stmt->bindValue($identifier, $this->createtmstp ? $this->createtmstp->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updtTmstp':
                        $stmt->bindValue($identifier, $this->updttmstp ? $this->updttmstp->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setOid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ExpenseactivityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getOid();
                break;
            case 1:
                return $this->getActivity();
                break;
            case 2:
                return $this->getCreatetmstp();
                break;
            case 3:
                return $this->getUpdttmstp();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Expenseactivity'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Expenseactivity'][$this->hashCode()] = true;
        $keys = ExpenseactivityTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getOid(),
            $keys[1] => $this->getActivity(),
            $keys[2] => $this->getCreatetmstp(),
            $keys[3] => $this->getUpdttmstp(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collExpensess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expensess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expensess';
                        break;
                    default:
                        $key = 'Expensess';
                }

                $result[$key] = $this->collExpensess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\lwops\lwops\Expenseactivity
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ExpenseactivityTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\lwops\lwops\Expenseactivity
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setOid($value);
                break;
            case 1:
                $this->setActivity($value);
                break;
            case 2:
                $this->setCreatetmstp($value);
                break;
            case 3:
                $this->setUpdttmstp($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ExpenseactivityTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setOid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setActivity($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCreatetmstp($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUpdttmstp($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\lwops\lwops\Expenseactivity The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ExpenseactivityTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExpenseactivityTableMap::COL_OID)) {
            $criteria->add(ExpenseactivityTableMap::COL_OID, $this->oid);
        }
        if ($this->isColumnModified(ExpenseactivityTableMap::COL_ACTIVITY)) {
            $criteria->add(ExpenseactivityTableMap::COL_ACTIVITY, $this->activity);
        }
        if ($this->isColumnModified(ExpenseactivityTableMap::COL_CREATETMSTP)) {
            $criteria->add(ExpenseactivityTableMap::COL_CREATETMSTP, $this->createtmstp);
        }
        if ($this->isColumnModified(ExpenseactivityTableMap::COL_UPDTTMSTP)) {
            $criteria->add(ExpenseactivityTableMap::COL_UPDTTMSTP, $this->updttmstp);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildExpenseactivityQuery::create();
        $criteria->add(ExpenseactivityTableMap::COL_OID, $this->oid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getOid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getOid();
    }

    /**
     * Generic method to set the primary key (oid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setOid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getOid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \lwops\lwops\Expenseactivity (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setActivity($this->getActivity());
        $copyObj->setCreatetmstp($this->getCreatetmstp());
        $copyObj->setUpdttmstp($this->getUpdttmstp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getExpensess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenses($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setOid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \lwops\lwops\Expenseactivity Clone of current object.
     * @throws PropelException
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Expenses' == $relationName) {
            $this->initExpensess();
            return;
        }
    }

    /**
     * Clears out the collExpensess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addExpensess()
     */
    public function clearExpensess()
    {
        $this->collExpensess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collExpensess collection loaded partially.
     */
    public function resetPartialExpensess($v = true)
    {
        $this->collExpensessPartial = $v;
    }

    /**
     * Initializes the collExpensess collection.
     *
     * By default this just sets the collExpensess collection to an empty array (like clearcollExpensess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpensess($overrideExisting = true)
    {
        if (null !== $this->collExpensess && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpensesTableMap::getTableMap()->getCollectionClassName();

        $this->collExpensess = new $collectionClassName;
        $this->collExpensess->setModel('\lwops\lwops\Expenses');
    }

    /**
     * Gets an array of ChildExpenses objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildExpenseactivity is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     * @throws PropelException
     */
    public function getExpensess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collExpensess) {
                // return empty collection
                $this->initExpensess();
            } else {
                $collExpensess = ChildExpensesQuery::create(null, $criteria)
                    ->filterByExpenseactivity($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpensessPartial && count($collExpensess)) {
                        $this->initExpensess(false);

                        foreach ($collExpensess as $obj) {
                            if (false == $this->collExpensess->contains($obj)) {
                                $this->collExpensess->append($obj);
                            }
                        }

                        $this->collExpensessPartial = true;
                    }

                    return $collExpensess;
                }

                if ($partial && $this->collExpensess) {
                    foreach ($this->collExpensess as $obj) {
                        if ($obj->isNew()) {
                            $collExpensess[] = $obj;
                        }
                    }
                }

                $this->collExpensess = $collExpensess;
                $this->collExpensessPartial = false;
            }
        }

        return $this->collExpensess;
    }

    /**
     * Sets a collection of ChildExpenses objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $expensess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildExpenseactivity The current object (for fluent API support)
     */
    public function setExpensess(Collection $expensess, ConnectionInterface $con = null)
    {
        /** @var ChildExpenses[] $expensessToDelete */
        $expensessToDelete = $this->getExpensess(new Criteria(), $con)->diff($expensess);


        $this->expensessScheduledForDeletion = $expensessToDelete;

        foreach ($expensessToDelete as $expensesRemoved) {
            $expensesRemoved->setExpenseactivity(null);
        }

        $this->collExpensess = null;
        foreach ($expensess as $expenses) {
            $this->addExpenses($expenses);
        }

        $this->collExpensess = $expensess;
        $this->collExpensessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Expenses objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Expenses objects.
     * @throws PropelException
     */
    public function countExpensess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collExpensessPartial && !$this->isNew();
        if (null === $this->collExpensess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpensess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpensess());
            }

            $query = ChildExpensesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByExpenseactivity($this)
                ->count($con);
        }

        return count($this->collExpensess);
    }

    /**
     * Method called to associate a ChildExpenses object to this object
     * through the ChildExpenses foreign key attribute.
     *
     * @param  ChildExpenses $l ChildExpenses
     * @return $this|\lwops\lwops\Expenseactivity The current object (for fluent API support)
     */
    public function addExpenses(ChildExpenses $l)
    {
        if ($this->collExpensess === null) {
            $this->initExpensess();
            $this->collExpensessPartial = true;
        }

        if (!$this->collExpensess->contains($l)) {
            $this->doAddExpenses($l);

            if ($this->expensessScheduledForDeletion and $this->expensessScheduledForDeletion->contains($l)) {
                $this->expensessScheduledForDeletion->remove($this->expensessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenses $expenses The ChildExpenses object to add.
     */
    protected function doAddExpenses(ChildExpenses $expenses)
    {
        $this->collExpensess[]= $expenses;
        $expenses->setExpenseactivity($this);
    }

    /**
     * @param  ChildExpenses $expenses The ChildExpenses object to remove.
     * @return $this|ChildExpenseactivity The current object (for fluent API support)
     */
    public function removeExpenses(ChildExpenses $expenses)
    {
        if ($this->getExpensess()->contains($expenses)) {
            $pos = $this->collExpensess->search($expenses);
            $this->collExpensess->remove($pos);
            if (null === $this->expensessScheduledForDeletion) {
                $this->expensessScheduledForDeletion = clone $this->collExpensess;
                $this->expensessScheduledForDeletion->clear();
            }
            $this->expensessScheduledForDeletion[]= clone $expenses;
            $expenses->setExpenseactivity(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenseactivity is new, it will return
     * an empty collection; or if this Expenseactivity has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenseactivity.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     */
    public function getExpensessJoinLineofbusiness(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Lineofbusiness', $joinBehavior);

        return $this->getExpensess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Expenseactivity is new, it will return
     * an empty collection; or if this Expenseactivity has previously
     * been saved, it will retrieve related Expensess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Expenseactivity.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenses[] List of ChildExpenses objects
     */
    public function getExpensessJoinExpensecategory(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpensesQuery::create(null, $criteria);
        $query->joinWith('Expensecategory', $joinBehavior);

        return $this->getExpensess($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->oid = null;
        $this->activity = null;
        $this->createtmstp = null;
        $this->updttmstp = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collExpensess) {
                foreach ($this->collExpensess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collExpensess = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ExpenseactivityTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
