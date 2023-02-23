<?php

namespace Core;

use PDO;

abstract class Model extends DBConnection {
    protected string $table;
    private $columns = '*';
    private $where = [];
    private $params = [];


    public function where($column, $operator, $value) {
        $this->where[] = "$column $operator '$value'";
//        $this->params[] = $value;
        return $this;
    }

    public function first() {
        $sql = "";
        $sql .='SELECT '.$this->columns .' FROM '.$this->table;
        if (!empty($this->where)) {
            $sql .= " WHERE " . implode(' AND ', $this->where);
        }
        $stmt = parent::$pdo->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function query(): static
    {
        return (new static());
    }

    public static function all()
    {
        return (new static())->get();
    }
    public function find(int $id) {

        $sql ="SELECT $this->columns FROM  $this->table where `id`= $id";
        $stmt = parent::$pdo->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function get() {
        $sql = "";
        $sql .='SELECT '.$this->columns .' FROM '.$this->table;
        if (!empty($this->where)) {
            $sql .= " WHERE " . implode(' AND ', $this->where);
        }
        $stmt = parent::$pdo->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($data) {
        $keys = array_keys($data);
        $values = array_values($data);
        $placeholders = implode(',', array_fill(0, count($values), '?'));
        $stmt = parent::$pdo->prepare("INSERT INTO {$this->table} (" . implode(',', $keys) . ") VALUES ($placeholders)");
        $stmt->execute($values);
        return $this->find(parent::$pdo->lastInsertId());
    }

    public function update($data) {
        $set = [];

        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
        }
        $sql = "UPDATE {$this->table} SET " . implode(',', $set);
        if (!empty($this->where)) {
            $sql .= " WHERE " . implode(' AND ', $this->where);
        }
        $stmt = parent::$pdo->prepare($sql);

        return $stmt->execute(array_values($data));
    }

    public function delete() {
        $sql = "DELETE FROM {$this->table}";
        if (!empty($this->where)) {
            $sql .= " WHERE " . implode(' AND ', $this->where);
        }
        $stmt = parent::$pdo->prepare($sql);

        return $stmt->execute();
    }
}