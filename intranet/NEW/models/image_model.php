<?php
class Image_Model extends Model {
    public function __construct() {
        parent::__construct();
    }  
    public function form($type='add',$id='null') {
        $action=($type=='add')?URL.'image/create':URL.'image/edit/'.$id;
        if ($type=='edit')
            foreach ($this->getInfo($id) as $value);
        $form = new Zebra_Form('addProject','POST',$action);
        $obj = $form->add('hidden', '_add', 'page');

        $form->add('label', 'label_name', 'name', 'Name');
        $obj = $form->add('text', 'name', $value['name'], array('autocomplete' => 'off','required'  =>  array('error', 'Name is required!')));
        $form->add('label', 'label_info', 'info', 'Information');
        $obj = $form->add('textarea', 'info', $value['info'], array('autocomplete' => 'off'));

        $form->add('submit', '_btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }
    public function getInfo($id){
        $consulta=$this->db->select('SELECT * FROM images WHERE id = :id', 
           array('id' => $id));
        return $consulta;
    }
    public function edit($id){
        $data = array(
            'name' => $_POST['name'],
            'info' => $_POST['info']
        );
        $this->db->update('images', $data, 
            "`id` = '{$id}'");
    }
    public function delete($id){
         foreach ($this->getInfo($id) as $value){
            $this->db->delete('images', "`id` = {$id}");
            unlink(UPLOAD.$value['page'].'/'.$value['img']);
         } 
    }
    public function uploadEdit($id,$img){  
        $parts = explode(".",$img);
	$suffix = array_pop($parts);		
	$thumb=implode(".",$parts) . '_thumb' .".". $suffix;
        $data = array(
            'name' => $img,
            'thumb'      => $thumb,
        );
        var_dump($data);
        echo $this->db->update('images', $data, 
            "`id` = '{$id}'");
    }
    public function uploadSave($id,$img){
        $parts = explode(".",$img);
	$suffix = array_pop($parts);		
	$thumb=implode(".",$parts) . '_thumb' .".". $suffix;
        
        $data = array(
            'name'       => $img,
            'caption'   => $img,
            'thumb'      => $thumb,
            'project'      => $id,
        );
        $this->db->insert('images', $data);
        echo $this->db->lastInsertId();
    }
    public function upload($id){
        $_POST['qqfile']=$_GET['qqfile'];

        date_default_timezone_set('UTC');

        define('DS', DIRECTORY_SEPARATOR);
        define('UTIL_DIR', ROOT.'util/');
        define('CURR_DIR', UTIL_DIR);
        define('UPLOAD_DIR', UPLOADS_ROOT.$id.'/images/');

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