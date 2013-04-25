<?php
class Client extends Controller {

    function __construct() {
        parent::__construct();
    }
    function index() { 
        $this->view->form = $this->model->form();
        $this->view->list = $this->model->getList();
        $this->view->render('client/index');  
    }
    public function view($id) 
    {
        $this->view->id=$id;
        $this->view->form=$this->model->form('edit',$id);
        $this->view->client=$this->model->getClient($id);
        $this->view->render('client/view');  
    }
    public function create() 
    {
        $this->model->create();
        header('location: ' . URL . 'client');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        header('location: ' . URL . 'client');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . 'client');
    }
}