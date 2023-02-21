<?php

namespace Core;


use PDO;
use PDOException;

abstract  class DBConnection
{
    protected static $pdo;

    function __construct()
    {
        if (empty(self::$pdo)) {
            self::connect();
        }
    }

    public static function connect(): void
    {
        $database = config("database.mysql");
        try {
            self::$pdo = new PDO(
                'mysql:host=' . $database['host'] . ';dbname=' . $database['database'],
                $database['username'],
                $database['password'],
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}