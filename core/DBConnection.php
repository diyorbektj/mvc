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
        try {
            self::$pdo = new PDO(
                'mysql:host=' . env("DB_HOST") . ';dbname=' . env("DB_DATABASE"),
                env("DB_USERNAME"),
                env("DB_PASSWORD"),
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}