<?php
class Works_Model extends Model {
    public function __construct() {
        parent::__construct();
    } 
    public function getList() {
        $lista=$this->db->select("SELECT * FROM project order by orderNum");
        $b[0]=array(
           array(
               "title"  =>"Id",
               "width"  =>"5%"
           ),array(
               "title"  =>"Name",
               "width"  =>"50%"
           ),array(
               "title"  =>"Options",
               "width"  =>"40%"
           ));
                     
        foreach($lista as $key => $value) {
            $b[]=
            array(
                "id"  =>$value['orderNum'],
                "name"  =>$value['name'],
                "Options"  =>'<a href="'.URL.'works/view/'.$value['id'].'"><div class="editTBtn"></div></a><a href="'.URL.'works/delete/'.$value['id'].'"><div class="deleteTBtn"></div></a>'
            );
        }
        return $b;
    }
    public function create() {
        $data = array(
            'name' => $_POST['name'],
            'photo'  => $_POST['photo'],
            'prod' => $_POST['prod'],
            'scompany' => $_POST['scompany'],
            'director' => $_POST['director'],
            'agency' => $_POST['agency'],
            'location' => $_POST['location'],
            'urlVideo' => $_POST['urlVideo'],
            'dop' => $_POST['dop'],
            'video' => $_POST['video'],
        );
        return $this->db->insert('project', $data);
    }
    public function edit($id){
        $fileElementName = 'fileToUpload';
        $nameFile=$_POST['img']; 
        $uploads_dir=UPLOAD.$id.'/';
        if(!empty($_FILES[$fileElementName]['tmp_name']) && !$_FILES[$fileElementName]['tmp_name'] == 'none')
        {
            $pathinfo = pathinfo($_FILES[$fileElementName]["name"]);
            $ext='.'.$pathinfo['extension'];
            $file = uniqid($pathinfo['filename'].'_');
            $nameFile=$file.$ext;
            move_uploaded_file($_FILES[$fileElementName]["tmp_name"], $uploads_dir.$nameFile);
        }
        $pathinfo = pathinfo($nameFile);
        $ext='.'.$pathinfo['extension'];
        $file = uniqid($pathinfo['filename'].'_');
        if(isset($_POST['w']) && $_POST['w']!=''){
            if($nameFile!=$_POST['avatar']) unlink($uploads_dir.$_POST['avatar']);
            $jpeg_quality = 90;
            $avatar = $file.'_avatar'.$ext;
            $src =$uploads_dir.$nameFile;
            $srcD=$uploads_dir.$avatar;
          
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x']*$_POST['rel'],$_POST['y']*$_POST['rel'],$_POST['w'],$_POST['h'],$_POST['w']*$_POST['rel'],$_POST['h']*$_POST['rel']);
        }
        imagejpeg($dst_r,$srcD,$jpeg_quality);
        
        $data = array(
            'name' => $_POST['name'],
            'photo'  => $_POST['photo'],
            'prod' => $_POST['prod'],
            'scompany' => $_POST['scompany'],
            'director' => $_POST['director'],
            'agency' => $_POST['agency'],
            'location' => $_POST['location'],
            'urlVideo' => $_POST['urlVideo'],
            'dop' => $_POST['dop'],
            'video' => $_POST['video'],
            'wVideo' => $_POST['wVideo'],
            'hVideo' => $_POST['hVideo'],
            'scompany' => $_POST['scompany'],
            'urlVideo' => $_POST['urlVideo'],
            'directorLink' => $_POST['directorLink'],
            'dopLink' => $_POST['dopLink'],
            'scompanyLink' => $_POST['scompanyLink'],
            'photoLink' => $_POST['photoLink'],
            'agencyLink' => $_POST['agencyLink'],
            'prodLink' => $_POST['prodLink'],
        );
        echo $this->db->update('project', $data, 
            "`id` = '{$id}'");
    }
    public function delete($id){
         $this->db->delete('project', "`id` = {$id}");
         $this->delTree(UPLOAD.$id);
    }   
    public function uploadSave($id,$img){
        $parts = explode(".",$img);
	$suffix = array_pop($parts);		
	$avatar=implode(".",$parts) . '_thumb' .".". $suffix;
        
        $data = array(
            'img' => $img,
            'avatar' => $avatar,
        );
        var_dump($data);
        echo $this->db->update('project', $data, 
            "`id` = '{$id}'");
    }
    public function upload($id){
        $_POST['qqfile']=$_GET['qqfile'];

        date_default_timezone_set('UTC');

        define('DS', DIRECTORY_SEPARATOR);
        define('UTIL_DIR', ROOT.'util/');
        define('CURR_DIR', UTIL_DIR);
        define('UPLOAD_DIR', UPLOADS_ROOT.$id.'/');

        require CURR_DIR."fineuploader.php";

        $allowedExtensions = array('jpeg','jpg','gif','png');
        $sizeLimit = 2 * 1024 * 1024; // max file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

        $result = $uploader->handleUpload(UPLOAD_DIR, false, md5(uniqid())); //handleUpload($uploadDirectory, $replaceOldFile=FALSE, $filename='')

        require CURR_DIR."gd_image.php";
        $gd = new GdImage();

        $filePath = UPLOAD_DIR . $result['filename'];
        $copyName = $gd->createName($result['filename'], '_FULLSIZE');
        $gd->copy($filePath, UPLOAD_DIR.$copyName);

        $oldSize = $gd->getProperties($filePath);
        $newSize = $gd->getAspectRatio($oldSize['w'], $oldSize['h'], 500, 0);
        $gd->resize($filePath, $newSize['w'], $newSize['h']);

        echo json_encode($result);exit();

    }
}