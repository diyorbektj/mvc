<?php

namespace Core;

class Request {
    private array $data;

    public function __construct() {
//        $this->data = array_merge($_GET, $_POST, (array)file_get_contents('php://input'));
    }

    public function get($key) {
        return $this->data[$key] ?? file_get_contents('php://input');
//       return json_decode(file_get_contents('php://input'), );
//        $data = json_decode(file_get_contents("php://input"), true);
//        return $data->do;
    }

    public function set($key, $value) {
        return $this->data[$key] = $value;
    }
}
