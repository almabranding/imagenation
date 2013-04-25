<?php
class Model {
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }
    function getProject($id=null,$column=null){
        $c=($column==null)?'*':$column;
        if($id==null){
            $sth = $this->db->prepare("SELECT * FROM project");
            $sth->execute();
            return $sth->fetchAll();
        }else{
            $data=$this->db->select('SELECT '.$c.' FROM project WHERE id = :id',array(':id' => $id)); 
            if($column==null) return $data;
            return $data[0][$c];
        }
    }
    function getGallery($id){
        $data=$this->db->select('SELECT * FROM images WHERE project = :id',array(':id' => $id)); 
        return $data;
    }
    function getClient($id=null,$column=null){
        $c=($column==null)?'*':$column;
        if($id==null){
            $sth = $this->db->prepare("SELECT * FROM client");
            $sth->execute();
            return $sth->fetchAll();
        }else{
            $data=$this->db->select('SELECT '.$c.' FROM client WHERE id = :id',array(':id' => $id)); 
            if($column==null) return $data[0];
            return $data[0][$c];
        }
    }
    function getMenu($id=null,$column=null){
        $column=($column==null)?'*':$column;
        if($id==null)return $this->db->select("SELECT * FROM menu WHERE parent=0");
        else $consulta=$this->db->select('SELECT '.$column.' FROM menu WHERE id = :id', 
            array('id' => $id));
        if($column==null) return $consulta;
        else return $consulta[0][$column];
    }
    function getTemplate($id=null,$column=null){
        $column=($column==null)?'*':$column;
        if($id==null)return $this->db->select("SELECT * FROM template");
        else $consulta=$this->db->select('SELECT '.$column.' FROM template WHERE id = :id', 
            array('id' => $id));
        if($column==null) return $consulta;
        else return $consulta[0][$column];
    }
    function delTree($dir) { 
        if(!is_dir($dir)) return false;
        $files = array_diff(scandir($dir), array('.','..')); 
         foreach ($files as $file) { 
           (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
         } 
        return rmdir($dir); 
    } 

}