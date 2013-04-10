<?php
class Works_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function lista() {
        return $this->db->select("SELECT * FROM project WHERE avatar!='' ORDER BY orderNum");
        
    }
    public function projectInfo($id) {
        return $this->db->select("SELECT * FROM project WHERE id='".$id."'"); 
    }
    public function gallery($id) {
        return $this->db->select("SELECT * FROM images WHERE project='".$id."' ORDER BY orden"); 
    }
    
    
}