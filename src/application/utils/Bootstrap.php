<?php

class Bootstrap
{
    private $baseHost;
    private $staticHost;
    private $viewPath;

    public function __construct(array $global)
    {
        $this->baseHost = $global['host']['base_host'];
        $this->staticHost = $global['host']['static_host'];
        $this->viewPath = dirname(dirname(__FILE__)) . '/view' ;
    }

    public function getBaseHost()
    {
        return $this->baseHost;
    }

    public function renderView($path, array $data = [])
    {
        extract($this->buildViewData($data));
        $header = include_once "{$this->viewPath}/layout/header.phtml";
        $body = include_once "{$this->viewPath}{$path}";
        $footer = include_once "{$this->viewPath}/layout/footer.phtml";
        header('Content-Type: text/html; charset=utf-8');
    }

    private function buildViewData($data)
    {
        return [
            'baseHost' => $this->baseHost,
            'staticHost' => $this->staticHost,
            'data' => $data,
        ];
    }
}