<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2016-04-11
 * Time: 18:17
 */
class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
            //unset robiony po to, żeby w tablicy params zostały nam już same parametry
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $controllerObject = new $this->controller;
        if (isset($url[1])) {
            if (method_exists($controllerObject, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        } else {
            $url = null;
        }
        return $url;
    }
}