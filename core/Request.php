<?php

namespace Core;

class Request {
    protected array $data;

    public function __construct() {
        $this->data = array_merge($_GET, $_POST);
    }

    public function get($key) {
        return $this->data[$key] ?? null;
    }

    public function set($key, $value): static
    {
        $this->data[$key] = $value;
        return $this;
    }
}
