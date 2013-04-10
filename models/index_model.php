<?php
class Index_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    public function selectBG(){
        $_SESSION['bground']=(isset($_SESSION['bground']))?$_SESSION['bground']:-1;
        $value=$this->db->select("SELECT * FROM background WHERE id!=:id ORDER BY rand() LIMIT 1", 
           array('id' => $_SESSION['bground']));
        $_SESSION['bground'] =$value[0]['id'];
        return $value;
    }
    
}