<?php
class uploadVideo_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function upload($sub='',$name='video'){
        $allowed_ext = array('mov','mp4');
        if(!is_dir(VUPLOAD)) mkdir(VUPLOAD);
        $uploadDir = VUPLOAD.$sub.'/';
        if(!is_dir($uploadDir))mkdir($uploadDir);
        if(array_key_exists($name,$_FILES) && $_FILES[$name]['error'] == 0 ){
            $video = $_FILES[$name];
            $pathinfo = pathinfo($video["name"]);
            $name = $pathinfo['filename'].'_'.rand();
            $uploadDir=$uploadDir.$name.".flv";
            
            if(!in_array($pathinfo['extension'],$allowed_ext)){
                $this->exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
            }	  
            $imagenes=(exec("ffmpeg -i ".$video."  ".$uploadDir.".flv  2>&1",$output));
            echo $imagenes."<br>";
            foreach($output as $item){
               echo $item;
            }
        }
        $this->exit_status('Something went wrong with your upload!');
    }
    function exit_status($str){
        echo json_encode(array('status'=>$str));
    }
    
    public function insertVideo($img){
        $postData = array(
            'video' => $img['name']
        );
        $this->db->update('images', $postData, "`id` = {$img['id']}");
    }
}