<?php
class Works extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array('works/js/custom.js');
    }
    function index() {
        $this->view->projectList = $this->model->lista();
        $this->view->render('works/index');  
    }
    public function gallery($id) 
    {
        $this->view->id=$id;
        $this->view->projectInfo = $this->model->projectInfo($id);
        $this->view->projectGallery = $this->model->gallery($id);
        $this->view->render('works/gallery');  
    }
    public function video($id) 
    {
        $this->view->id=$id;
        $this->view->projectInfo = $this->model->projectInfo($id);
        $this->view->projectGallery = $this->model->gallery($id);
        $this->view->render('works/video');  
    }

}