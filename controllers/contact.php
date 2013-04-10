<?php
class Contact extends Controller {

    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->view->getContacts = $this->model->getContacts();
        $this->view->getInfo = $this->model->getInfo();
        $this->view->render('contact/index');  
    }
}