<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        var_dump($_GET['url']);
        $url = $this->parseUrl();
        var_dump($url);
        if (file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
            //unset robiony po to, żeby w tablicy params zostały nam już same parametry
        }
        $this->controller .= 'Controller';
        var_dump($this->controller);

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller; //musi być w ten sposób,
        //żeby w metodach kontrolera nie trzeba było tworzyć nowych obiektów

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
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