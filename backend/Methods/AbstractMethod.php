<?php

namespace Methods;

class AbstractMethod
{
    protected $params;

    protected $pdo;

    public function __construct($params = [], $pdo = null)
    {

        $this->params = $params;
        $this->pdo = $pdo;

        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
