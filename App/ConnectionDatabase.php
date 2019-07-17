<?php

namespace App;

class ConnectionDatabase {

    public static function getDatabase() {
        try {
            $conn = new \PDO("mysql:host=localhost;dbname=twitter;charset=utf8", "root", "");

            return $conn;
        } catch (\PDOException $error) {
            echo "Connection error database! <br><br>" . $error->getMessage();
        }
    }

}
