<?php
class uploadFile_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function upload($sub='',$name='pic'){
        $allowed_ext = array('jpg','jpeg','png','gif');
        if(!is_dir(UPLOAD))mkdir(UPLOAD);
        $uploadDir = UPLOAD.$sub.'/';
        if(!is_dir($uploadDir))mkdir($uploadDir);
        $thumbWidth=rand(200,500);
        if(array_key_exists($name,$_FILES) && $_FILES[$name]['error'] == 0 ){
            $pic = $_FILES[$name];
            $pathinfo = pathinfo($pic["name"]);
            $ext='.'.$pathinfo['extension'];
            $file = ($pathinfo['filename'].'_'.rand());
            $nameFile=$file.$ext;
            if(!in_array($pathinfo['extension'],$allowed_ext)){
                $this->exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
            }	  
            if(move_uploaded_file($pic['tmp_name'], $uploadDir.$nameFile)){
                //$SQL="INSERT INTO ".$bbdd." (project,name,caption,img) VALUES ('".$project."','".$nameFile."','".$pathinfo['filename']."','".$nameFile."')";
                //$consulta->setConsulta($SQL);
                $data=$this->createThumbs($nameFile,$uploadDir, $uploadDir, $thumbWidth );
                $this->exit_status('File was uploaded successfuly!');
                $data['name']=$nameFile;
                return $data;
            }

        }
        
        $this->exit_status('Something went wrong with your upload!');
        
        
    }
    function exit_status($str){
        echo json_encode(array('status'=>$str));
    }
    
    public function insertImg($img,$page){
        $name=$img['name'];
        $p=$this->db->select("SELECT info FROM page WHERE id=:id",
            array('id' => $page));
        $this->db->insert('images', array(
            'img'       => $name,
            'caption'   => $name,
            'name'      => $name,
            'page'      => $page,
            'w'         => $img['w'],
            'h'         => $img['h'],
            'info'      => $p[0]['info']
        ));
    }
    public function createThumbs($fname,$pathToImages, $pathToThumbs, $thumbWidth ) 
    {
        $info = pathinfo($pathToImages . $fname);
        if ( strtolower($info['extension']) == 'jpg' ) $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
        if ( strtolower($info['extension']) == 'png' ) $img = imagecreatefrompng( "{$pathToImages}{$fname}" );

          $width = imagesx( $img );
          $height = imagesy( $img );
          $fname='thumb_'.$fname;
          // calculate thumbnail size
          $new_width = $thumbWidth;
          $new_height = floor( $height * ( $thumbWidth / $width ) );
          $data['w']=$new_width;
          $data['h']=$new_height;
          // create a new temporary image
          $tmp_img = imagecreatetruecolor( $new_width, $new_height ); 
          // copy and resize old image into new image 
          imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
          // save thumbnail into a file
          imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
          return $data;

    }
}