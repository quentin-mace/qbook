<?php

namespace lib\models;
use PDO;
use PDOStatement;

/**
 * Singleton class used to connect to the database. Use getInstance method.
 */
class DBManager
{
    private static $instance;

    private $db;

    /**
     * DBManager constructor.
     * Initialize DB connexion.
     */
    private function __construct()
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * Method to access DBManager singleton instance.
     * @return DBManager
     */
    public static function getInstance(): DBManager
    {
        if (!self::$instance) {
            self::$instance = new DBManager();
        }
        return self::$instance;
    }

    /**
     * Method to get PDO object used to connect to DB.
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->db;
    }

    /**
     * Method to execute SQL queries.
     * If params are passed, we use a prepared request.
     * @param string $sql : SQL request to run.
     * @param array|null $params : SQL request params.
     * @return PDOStatement : SQL request result.
     */
    public function query(string $sql, ?array $params = null): PDOStatement
    {
        if ($params == null) {
            $query = $this->db->query($sql);
        } else {
            $query = $this->db->prepare($sql);
            $query->execute($params);
        }
        return $query;
    }

}