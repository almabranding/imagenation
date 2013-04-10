<?PHP
require_once 'auth.php';
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");
if (!isset($_SESSION))session_start();  $_SESSION['lang']='ES';
include_once("../functions/functions.php");
$consulta=new Consulta();
$fileElementName = 'fileToUpload';
$uploads_dir="../uploads";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form']=='delete')
{
    $consulta->setConsulta('SELECT * FROM project WHERE id='.$_POST['id']);
    unlink($uploads_dir."/".$consulta->getData('img'));
    unlink($uploads_dir."/".$consulta->getData('avatar'));
    $consulta->setConsulta('DELETE FROM project WHERE id="'.$_POST['id'].'"');
    
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form']=='insert')
{
    $insert=Array();
    foreach($_POST as $key=>$value){
        if($key!='form'){
            $column[]=$key;    
            $insert[]=$value;
        }
    }
    if(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
    {
        $error = 'No file was uploaded...';
    }else 
    {
        $tmp_name = $_FILES[$fileElementName]["tmp_name"];
        $ext = end(explode(".", $_FILES["fileToUpload"]["name"]));
        $name = uniqid('img_').'.'.$ext;
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $column[]='img';    
        $insert[]=$name;
        echo 'INSERT INTO project ('.$column[0].','.$column[1].','.$column[2].','.$column[3].','.$column[4].','.$column[5].','.$column[6].','.$column[7].') VALUES  (\''.$insert[0].'\',\''.$insert[1].'\',\''.$insert[2].'\',\''.$insert[3].'\',\''.$insert[4].'\',\''.$insert[5].'\',\''.$insert[6].'\',\''.$insert[7].'\')';
        $consulta->setConsulta('INSERT INTO project ('.$column[0].','.$column[1].','.$column[2].','.$column[3].','.$column[4].','.$column[5].','.$column[6].','.$column[7].') VALUES  (\''.$insert[0].'\',\''.$insert[1].'\',\''.$insert[2].'\',\''.$insert[3].'\',\''.$insert[4].'\',\''.$insert[5].'\',\''.$insert[6].'\',\''.$insert[7].'\')');	
        //createThumbs($name,"background/","background/thumbs/",140);
    }
    
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'  && !isset($_POST['form']))
{ 
    if(isset($_POST['id'])){
        list($column, $id) = explode("_", $_POST['id']);
        $consulta->setConsulta('UPDATE project SET '.$column.'="'.$_POST['value'].'" WHERE id='.$id);
        $consulta->setConsulta('SELECT * FROM project WHERE id='.$id);
        echo $consulta->getData($column);
        exit;
    }
} 
?>
<!DOCTYPE html>
<head>
     <?php include 'head.php'; ?>
</head>
<body>
    
    <script>
$(document).ready(function() {
     $('.edit_area').editable('videos.php', { 
         type      : 'textarea',
         onblur   : 'submit',
         indicator : '<img src="img/indicator.gif">',
         tooltip   : ''
     });
     $('select').live('change', function () {
            $('#form').submit();
       });
 });
</script>
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="mainarea">
            <div class="white_full hide" onclick="$('.hide').css('display','none')"></div>
            <div class="white_box hide">
                 <h2 style="width:100%">Upload Background</h2>
                 <form name="form" action="" method="POST" enctype="multipart/form-data">
                    <input name="form" id="name" type="hidden" value="insert">
                    <input name="video" id="video" type="hidden" value="1">
                    <p><label for="name">Name</label><input name="name" id="name" type="text" value=""></p>
                    <p><label for="photo">Photographer</label><input name="photo" id="photo" type="text" value=""></p>
                    <p><label for="prod">Productor</label><input name="prod" id="prod" type="text" value=""></p>
                    <p><label for="agency">Agency</label><input name="agency" id="agency" type="text" value=""></p>
                    <p><label for="agency">Location</label><input name="location" id="location" type="text" value=""></p>
                    <p><label for="urlVideo">URL</label><input name="urlVideo" id="urlVideo" type="text" value=""></p>
                   
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Thumbnail</strong></span>
                            <input type="file" name="fileToUpload" />
                        </label>
                    </div>
                    <div><label for="save"></label><input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="$('.hide').css('display','none')"/></div>
                </form>
            </div>
            <h2>Videos</h2>
            <div id="container">
                
                <ul id="sortable" rel="cosa">                    
                    <?php 
                        $projects=new Consulta();
                        $projects->setConsulta("SELECT * FROM project WHERE video='1'");
                        if($projects->num) do{
                        ?>
                            <li class="ui-state-default" id="">
                                <form action="" method="post" onsubmit="" id="form">
                                <img src="../uploads/<?php echo $projects->getData('imgVideo');?>">
                                <div class="gallery_box_info">
                                    <label class="bold">Name</label><div class="edit_area" id="name_<?php echo $projects->getData('id');?>"><?php echo $projects->getData('name');?></div>
                                    <label class="bold">Photographer</label><div class="edit_area" id="photo_<?php echo $projects->getData('id');?>"><?php echo $projects->getData('photo');?></div>
                                    <label class="bold">Productor</label><div class="edit_area" id="prod_<?php echo $projects->getData('id');?>"><?php echo $projects->getData('prod');?></div>
                                    <label class="bold">Agency</label><div class="edit_area" id="agency_<?php echo $projects->getData('id');?>"><?php echo $projects->getData('agency');?></div>
                                    <label class="bold">Location</label><div class="edit_area" id="location_<?php echo $projects->getData('id');?>"><?php echo $projects->getData('location');?></div>
                                    <label class="bold">URL</label><div class="edit_area" id="urlVideo_<?php echo $projects->getData('id');?>"><?php echo $projects->getData('urlVideo');?></div>
                                </div>                                
                                </form> 
                                <div style="text-align:right;margin-top:10px">
                                <form action="" method="POST" onsubmit="" id="">                                    
                                    <input type="hidden" value="delete" name="form">
                                    <input type="hidden" value="<?php echo $projects->getData('id');?>" name="id">
                                    <input type="submit" id="save" value="Delete" onclick="" style="background: #bb0000;margin:0;" class="btn" />
                                </form>
                                </div>
                            </li>
                        <?php }while($projects->nextRow());?>
                    </ul>
                    <div style="text-align: right;">
                       <input type="button" id="save" value="Upload" onclick="$('.hide').css('display','block')" class="btn" />
                    </div>              
            </div>
        </div>
    </div>   

    <?php include 'footer.php'; ?>
</body>