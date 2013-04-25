<?php

class View {

    function __construct() {
        
    }

    public function render($name, $noInclude = false)
    {
        echo $this->model;
        if ($noInclude == true) {
            require 'views/' . $name . '.php';    
        }
        else {
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';    
        }
    }
    public function get($name)
    {
        require 'views/' . $name . '.php';
    }
    function viewUploadFile($id,$bbdd='images'){
        $view= '<h2 style="width:100%">Upload project</h2>
        <div id="dropbox">
            <input id="project" type="hidden" value="'.$id.'">
            <input id="bbdd" type="hidden" value="'.$bbdd.'">
            <span class="message">Drop images here to upload. <br /><i>(they will only be visible to you)</i></span>
        </div>';
        echo $view;
    }
}