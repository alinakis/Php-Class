<?php
/**
 * Database class
 * 
 * @param string $host The database host
 * @param string $user The database username
 * @param string $pass The database password
 * @param string $db The database name
 * 
 */
class Database {
    private $host;
    private $user;
    private $pass;
    private $db;
    public $mysqli;

    public function __construct($host, $user, $pass, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;

        $this->connect();
    }

    public function connect() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->mysqli->connect_error) {
            die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }

        $this->mysqli->set_charset('utf8');
    }

    public function disconnect() {
        $this->mysqli->close();
    }
}
?>