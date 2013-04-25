<?php

class uploadVideo extends Controller {

    function __construct() {
        parent::__construct();
    }
    function upload($project=0) {
       $data=$this->model->upload($project);
       $data['id']=$project;
       $this->model->insertVideo($data);
    }
}