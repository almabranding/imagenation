<?php

class Works extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('works/js/custom.js');
    }
    function index() { 
        $this->view->list = $this->model->getList();
        $this->view->render('works/index');  
    }
    public function view($id) 
    {
        $this->view->id=$id;
        //$this->view->form=$this->model->form('edit',$id);
        $this->view->project=$this->model->getProject($id);
        $this->view->gallery=$this->model->getGallery($id);
        $this->view->render('works/view');  
    }
    public function create() 
    {
        $this->model->create();
        header('location: ' . URL . 'works');
    }
    public function edit($id) 
    {
        $this->model->edit($id);
        //header('location: ' . URL . 'works');
    }
    public function delete($id) 
    {
        $this->model->delete($id);
        header('location: ' . URL . 'works');
    }
    public function upload($id) 
    {
        $this->model->upload($id);
    }
    public function uploadSave($id,$name) 
    {
        $this->model->uploadSave($id,$name);
    }
}