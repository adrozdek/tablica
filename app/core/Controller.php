<?php

class Controller
{
    protected function model($modelName) {
        require_once '../app/models' . $modelName . '.php';
        return new $modelName;
    }

    protected function view($viewName, $data = []) {
        require_once '../app/views/' . $viewName . '.php';
    }

    protected function checkIfOwner($userId) {

    }

}