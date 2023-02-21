<?php

namespace App\Controllers;
class TestClass
{
    protected $test = [];
    /**
     * @var array
     */
    private $data;

    public static function query()
    {
        return (new static());
    }

    public function addData(array $data)
    {
        $this->data[] = $data;
        return $this;
    }

    public function all()
    {
        return $this->data;
    }

    public function getTest()
    {
        return $this->data['test'];
    }

}