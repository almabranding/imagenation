<?php

class uploadFile extends Controller {

    function __construct() {
        parent::__construct();
    }
    function upload($project=0) {
       $img=$this->model->upload($project);
       $this->model->insertImg($img,$project);
    }
}