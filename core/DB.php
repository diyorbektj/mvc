<?php
use Core\Model;

abstract class DB  extends \Core\DBConnection {
    private $table;

    private string $columns = '*';

    public static function query()
    {
        return ;
    }
    public function select($columns = '*') {
        $this->columns = $columns;
        return $this;
    }

    public function insert($data) {
        $keys = array_keys($data);
        $values = array_values($data);
        $placeholders = implode(',', array_fill(0, count($values), '?'));

        $stmt = parent::$pdo->prepare("INSERT INTO {$this->table} (" . implode(',', $keys) . ") VALUES ($placeholders)");

        return $stmt->execute($values);
    }

    public function update($data) {
        $set = [];

        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
        }

        $stmt = parent::$pdo->prepare("UPDATE {$this->table} SET " . implode(',', $set));

        return $stmt->execute(array_values($data));
    }

    public function delete($id) {
        $stmt = parent::$pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");

        return $stmt->execute([$id]);
    }
}