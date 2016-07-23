<?php

abstract class DataBase 
{
    protected $dataBaseConnector;

    public function __construct(DataBaseConnector $dataBaseConnector)
    {
        $this->dataBaseConnector = $dataBaseConnector;
    }

    protected function dataBase()
    {
        return $this->dataBaseConnector;
    }
}