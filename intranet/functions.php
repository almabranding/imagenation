<?php
class Consulta{	
    public $texto_consulta;
    public $resultado;
    public $resultado_aux;
    public $row;
    public $fila;
    public $num;

     public function __construct(){
        $this->database = "ny";
        $this->conexion=get_db_conn();
        mysql_set_charset('utf8',$this->conexion); 	

    }
    private function __clone(){ }

    public static function getInstance(){
        if (!(self::$_instance instanceof self)){
            self::$_instance=new self();
        }
        return self::$_instance;
    }
   
   public function conectar(){
      $this->conexion = mysql_connect($this->hostname, $this->username, $this->password) or trigger_error(mysql_error(),E_USER_ERROR);
      mysql_select_db($this->database,$this->conexion);
      @mysql_query("SET NAMES 'utf8'");
   }
	
    public function setConsulta($consulta){
        $this->texto_consulta=$consulta;
        self::ejecutar();
    }
    function getData($columna){
        return $this->row[$columna];	
    }
    function getNum(){
        echo $this->num;	
    }
    function nextRow(){
        if ($this->row=@mysql_fetch_assoc($this->resultado_aux)) return true;	
    }

   function ejecutar(){
        if($this->conexion){
            mysql_select_db($this->database_carsurfing);
            $this->resultado=mysql_query($this->texto_consulta) or die(mysql_error());
            $this->resultado_aux=$this->resultado;
            //mysql_close();
        }
        if ($this->resultado){
            $this->fila = @mysql_fetch_assoc($this->resultado_aux); 
            $this->row = @mysql_fetch_assoc($this->resultado_aux);
            $this->num = @mysql_num_rows($this->resultado_aux);
        }
    }
    public function lastID(){
        return @mysql_insert_id($this->Flowing);
   }	
}


class Archivo extends Consulta
{
    public $target_path;
    public $name;
    public $file_name;
    public $SQL;
    public $BBDD;
    public $id;

    public function __construct() {	
        parent::__construct(); 	
    }
    function upload()
    {	
        if ($_FILES[$this->name]['tmp_name']!=""){
            $this->file_name=basename($_FILES[$this->name]['name']);
            $this->target_path ="../images/". $this->file_name;
            move_uploaded_file($_FILES[$this->name]['tmp_name'], $this->target_path);
            $this->SQL = sprintf("UPDATE ".$this->BBDD." SET ".$this->name."=%s WHERE id=%s", GetSQLValueString($this->file_name, "text"), GetSQLValueString($this->id, "int"));
            $this->texto_consulta=$this->SQL;
            parent::ejecutar();
        }
    }
}

function insert_bbdd($POST,$table){

    $SQL ="INSERT INTO ".$table." (";
    foreach ($POST as $key => $value) {
        if($value!='') $SQL=$SQL.$key.",";
    }
    $SQL = substr ($SQL, 0, strlen($SQL) - 1);	
    $SQL=$SQL.") VALUES (";
    foreach ($POST as $key => $value) {
        $insert=GetSQLValueString($value, "text");
        if($value!='') $SQL=$SQL.$insert.",";	
    }
    $SQL = substr ($SQL, 0, strlen($SQL) - 1);
    $SQL=$SQL.")";  

    $consulta=new Consulta();
    $consulta->texto_consulta=$SQL;
    $consulta->ejecutar();
    return mysql_insert_id();
    //return $consulta->texto_consulta;
}

function update_bbdd($POST,$table,$id){
    $SQL ="UPDATE ".$table." SET ";
    foreach ($POST as $key => $value) {
        $insert=GetSQLValueString($value, "text");
        if($value!=''){	
            if($key!=$id) $SQL=$SQL.$key."=".$insert.",";
        }	
    }
    $SQL = substr ($SQL, 0, strlen($SQL) - 1);
    $SQL=$SQL." WHERE ".$id."=".$POST[$id];
    $consulta=new Consulta();
    $consulta->texto_consulta=$SQL;
    $consulta->ejecutar();
    return $SQL;
    return mysql_insert_id();
}




?>