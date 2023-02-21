<?php

namespace Core;

class Request {
    private $data = array();

    public function __construct() {
        $this->data = array_merge($_GET, $_POST);
    }

    public function get($key) {
        return $this->data[$key] ?? null;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }
}
