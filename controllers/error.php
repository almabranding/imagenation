<?php

class Error extends Controller {

    function __construct() {
        parent::__construct();
    }
    function index() {
        header('location: /');
        $this->view->render('index/index');
    }

}