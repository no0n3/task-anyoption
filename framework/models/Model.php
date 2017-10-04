<?php

namespace framework\models;

use framework\App;
use framework\components\DatabaseConnection;

abstract class Model {

    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct() {
        $this->initDB();
    }

    /**
     * Inits the database connection.
     */
    private function initDB() {
//        Uncomment to init the database without wrapper class. Works the same both ways.
//        $config = App::getInst()->getConfig();
//        $this->pdo = new \PDO(
//            'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['db_name'],
//            $config['db']['username'],
//            $config['db']['password']
//        );
        $this->pdo = DatabaseConnection::get()->getRawConnection();

        $this->pdo->exec("SET NAMES 'utf8'");
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array|boolean
     */
    protected function getRow($sql, array $params = []) {
        if (!is_string($sql)) {
            return false;
        }
        $row = false;

        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);
        if ($result) {
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if (isset($data[0])) {
                $row = $data[0];
            }
        }

        return $row;
    }

}
