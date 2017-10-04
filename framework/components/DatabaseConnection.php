<?php

namespace framework\components;

use PDO;
use framework\App;

class DatabaseConnection {

    private $con;

    public static function get() {
        static $inst = null;
        if (null === $inst) {
            $inst = new static();
        }

        return $inst;
    }

    private function __construct() {
        // prevent public initialization
    }

    public function __destruct() {
        $this->con = null;
    }

    public function query($query) {
        $this->initConnection();
        return $this->con->query($query);
    }

    public function execute($query) {
        $this->initConnection();
        return $this->con->exec($query);
    }

    public function prepare($query) {
        $this->initConnection();
        return $this->con->prepare($query);
    }

    public function lastInsertId() {
        $this->initConnection();
        return $this->con->lastInsertId();
    }

    /**
     * Gets the raw PDO connection.
     * @return \PDO
     */
    public function getRawConnection() {
        $this->initConnection();

        return $this->con;
    }

    /**
     * Inits the pdo connection if not it is not already initialised.
     */
    private function initConnection() {
        if (null === $this->con) {
            $config = App::getInst()->getConfig();
            $this->con = new PDO(
                'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['db_name'],
                $config['db']['username'],
                $config['db']['password']
            );

            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

}
