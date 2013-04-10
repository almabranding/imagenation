<?php
class Contact_Model extends Model {
    public function __construct() {
        parent::__construct();  
    }
    public function getContacts() {
        return $this->db->select('SELECT * FROM contact order by orden'); 
    }
    public function getInfo(){
        return $this->db->select('SELECT * FROM info WHERE options="about"'); 
        
    }
}