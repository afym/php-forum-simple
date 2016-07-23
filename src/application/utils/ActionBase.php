<?php

abstract class ActionBase 
{
    protected $bootstrap;
    protected $data;

    public function __construct(Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    public function setData($data) 
    {
        $this->data = $data;
    }

    public function data()
    {
        return $this->data;
    }

    public abstract function doRequest();

    protected function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }

        return null;
    }

    protected function post($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }

        return null;
    }

    protected function setKey($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    protected function getKey($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    protected function isLogin()
    {
        if ($this->getKey('login') === null) {
            return false;
        }

        return true;
    }

    protected function redirect($action)
    {
        header("Location: {$this->bootstrap->getBaseHost()}{$action}");
        exit(0);
    }
}