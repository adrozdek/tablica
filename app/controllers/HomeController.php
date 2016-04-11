<?php

class Controller {
    protected function model($modelName) {
        require_once '../app/models/' . $modelName . '.php';
        return new $modelName();
    }

    protected function view($viewName, $data = []) {
        require_once '../app/views/' . $viewName . '.php';
    }
}

//require_once '../core/Controller.php';

class HomeController extends Controller
{
    public function index($name = '') {
        $user = $this->model('User');
        var_dump($user);
        $user->name = $name;
        $this->view('home', ['name' => $user->name]);
    }
}