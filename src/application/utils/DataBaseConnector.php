<?php

class DataBaseConnector 
{
    private $connection;

    public function __construct(array $parameters)
    {
        $this->connection = new mysqli($parameters["host"], $parameters["user"], $parameters["password"], $parameters["schema"]);
    }

    public function insert($table, $fields, $values)
    {
        $fieldsSql = $this->parseParameters($fields);
        $valuesSql = $this->parseParameters($values);
        $result = $this->connection->query("INSERT INTO {$table} ({$fieldsSql}) VALUES ({$valuesSql})");

        if ($result === false) {
            throw new Exception("Insert error");
        }
    }

    public function select($table, $fields, $where = '')
    {
        $fieldsSql = '*';

        if (!empty($fields)) {
            $fieldsSql = $this->parseParameters($fields);
        }

        if ($where !== '') {
            $where = "WHERE {$where}";
        }

        $result = $this->connection->query("SELECT {$fieldsSql} FROM $table {$where}");
        
        if ($result === false) {
            throw new Exception("Select error");
        }

        return $result;
    }

    private function parseParameters($parameters)
    {
        return implode(',', $parameters);
    }
}