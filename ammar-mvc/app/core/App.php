<?php

class App
{
    protected $controller = "home"; // DEFAULT CONTROLLER
    protected $method = "index"; // DEFAULT CONTROLLER METHOD
    protected $params = []; //DEFAULT PARAMETERS

    public function __construct()
    {
        $url = $this->parseUrl();

        // CHECK CONTROLLER PASS IN URL SET AND EXISTS OR NOT
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }
        // IF NOT EXISTS DEFAUL SHOW HOME CONTROLLER CLASS AND CREATE ITS OBJECT
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // CHECK CONTROLLER METHOD PASS IN URL SET AND EXSITS OR NOT
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // CHECK PARAMETER PASS IN URL HAVE [] VALUE OTHRWISE EMPTY []
        $this->params = $url ? array_values($url) : [];

        // DISPLAY CONTROLLER METHOD WITH PARAMETERS
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // DIVIDE URL IN CONTROLLER/METHOD/PARAMETERS
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
