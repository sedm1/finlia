<?php

namespace Methods;

use PDO;

class AbstractMethod
{
    protected array $params;

    protected PDO $pdo;

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
