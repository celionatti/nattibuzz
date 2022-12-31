<?php

declare(strict_types=1);

namespace Core;

use PDO;
use Exception;

defined('ROOT_PATH') or exit('Access Denied!');

class Database
{
    protected $_dbh, $_results, $_lastInsertId, $_rowCount = 0, $_fetchType = PDO::FETCH_OBJ, $_class, $_error = false;
    protected $_stmt;
    protected static $_db;

    public function __construct()
    {
        $drivers = Config::get('DATABASE_DRIVERS');
        $host = Config::get('DATABASE_HOST');
        $port = Config::get('DATABASE_PORT');
        $name = Config::get('DATABASE_NAME');
        $user = Config::get('DATABASE_USER');
        $pass = Config::get('DATABASE_PASSWORD');
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
        try {
            $this->_dbh = new PDO("{$drivers}:host={$host};port={$port};dbname={$name}", $user, $pass, $options);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int) $e->getCode());
        }
    }

    /**
     * Summary of getInstance
     * Get Database Instance.
     * @return Database
     */
    public static function getInstance()
    {
        if (!self::$_db) {
            self::$_db = new self();
        }
        return self::$_db;
    }

    /**
     * Summary of execute
     * @param mixed $sql
     * @param mixed $bind
     * @return Database
     */
    public function execute($sql, $bind = [])
    {
        $this->_results = null;
        $this->_lastInsertId = null;
        $this->_error = false;
        $this->_stmt = $this->_dbh->prepare($sql);
        if (!$this->_stmt->execute($bind)) {
            $this->_error = true;
        } else {
            $this->_lastInsertId = $this->_dbh->lastInsertId();
        }

        return $this;
    }

    /**
     * Summary of query
     * Query the database.
     * @param mixed $sql
     * @param mixed $bind
     * @return Database
     */
    public function query($sql, $bind = [])
    {
        $this->execute($sql, $bind);
        if (!$this->_error) {
            $this->_rowCount = $this->_stmt->rowCount();
            if ($this->_fetchType === PDO::FETCH_CLASS) {
                $this->_results = $this->_stmt->fetchAll($this->_fetchType, $this->_class);
            } else {
                $this->_results = $this->_stmt->fetchAll($this->_fetchType);
            }
        }
        return $this;
    }

    /**
     * Summary of insert
     * Insert into the database.
     * @param mixed $table
     * @param mixed $values
     * @return bool
     */
    public function insert($table, $values)
    {
        $fields = [];
        $binds = [];
        foreach ($values as $key => $value) {
            $fields[] = $key;
            $binds[] = ":{$key}";
        }
        $fieldStr = implode('`, `', $fields);
        $bindStr = implode(', ', $binds);
        $sql = "INSERT INTO {$table} (`{$fieldStr}`) VALUES ({$bindStr})";
        $this->execute($sql, $values);
        return !$this->_error;
    }

    /**
     * Summary of update
     * Update the database record.
     * @param mixed $table
     * @param mixed $values
     * @param mixed $conditions
     * @return bool
     */
    public function update($table, $values, $conditions)
    {
        $binds = [];
        $valueStr = "";
        foreach ($values as $field => $value) {
            $valueStr .= ", `{$field}` = :{$field}";
            $binds[$field] = $value;
        }
        $valueStr = ltrim($valueStr, ', ');
        $sql = "UPDATE {$table} SET {$valueStr}";

        if (!empty($conditions)) {
            $conditionStr = " WHERE ";
            foreach ($conditions as $field => $value) {
                $conditionStr .= "`{$field}` = :cond{$field} AND ";
                $binds['cond' . $field] = $value;
            }
            $conditionStr = rtrim($conditionStr, ' AND ');
            $sql .= $conditionStr;
        }
        $this->execute($sql, $binds);
        return !$this->_error;
    }

    /**
     * Summary of results
     * @return mixed|null
     */
    public function results()
    {
        return $this->_results;
    }

    /**
     * Summary of count
     * @return int|mixed
     */
    public function count()
    {
        return $this->_rowCount;
    }

    /**
     * Summary of lastInsertId
     * return the last inserted Id.
     * @return mixed|null
     */
    public function lastInsertId()
    {
        return $this->_lastInsertId;
    }

    /**
     * Summary of setClass
     * @param mixed $class
     * @return void
     */
    public function setClass($class)
    {
        $this->_class = $class;
    }

    /**
     * Summary of getClass
     * @return mixed
     */
    public function getClass()
    {
        return $this->_class;
    }

    /**
     * Summary of setFetchType
     * @param mixed $type
     * @return void
     */
    public function setFetchType($type)
    {
        $this->_fetchType = $type;
    }

    /**
     * Summary of getFetchType
     * @return int|mixed
     */
    public function getFetchType()
    {
        return $this->_fetchType;
    }
}