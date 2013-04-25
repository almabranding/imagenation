<?PHP
require_once 'auth.php';
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");
if (!isset($_SESSION))session_start();  $_SESSION['lang']='ES';
include_once("functions/functions.php");
$consulta=new Consulta();
$fileElementName = 'fileToUpload';
$uploads_dir="../uploads/background";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form']=='upload')
{
    $consulta->setConsulta('SELECT * FROM background WHERE id='.$_POST['id']);
    if(!empty($_FILES[$fileElementName]['tmp_name']))
    {  
        $tmp_name = $_FILES[$fileElementName]["tmp_name"];
        $ext = end(explode(".", $_FILES["fileToUpload"]["name"]));
        $name = uniqid('img_').'.'.$ext;
        if(move_uploaded_file($tmp_name, "$uploads_dir/$name")){
            unlink($uploads_dir."/".$consulta->getData('file'));
            $consulta->setConsulta('UPDATE background SET file="'.$name.'" WHERE id='.$_POST['id']);
        }
    }
    
    
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form']=='delete')
{
    $consulta->setConsulta('SELECT * FROM background WHERE id='.$_POST['id']);
    unlink($uploads_dir."/".$consulta->getData('file'));
    $consulta->setConsulta('DELETE FROM background WHERE id="'.$_POST['id'].'"');
    
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
        $column[]='file';    
        $insert[]=$name;
        
        $consulta->setConsulta('INSERT INTO background ('.$column[0].','.$column[1].','.$column[2].','.$column[3].','.$column[4].','.$column[5].','.$column[6].') VALUES  (\''.$insert[0].'\',\''.$insert[1].'\',\''.$insert[2].'\',\''.$insert[3].'\',\''.$insert[4].'\',\''.$insert[5].'\',\''.$insert[6].'\')');	
        //createThumbs($name,"background/","background/thumbs/",140);
    }
    
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'  && !isset($_POST['form']))
{ 
    if(isset($_POST['idStyle'])){
        $consulta->setConsulta('UPDATE background SET style="'.$_POST['sel'].'" WHERE id='.$_POST['idStyle']);
    }
 
    if(isset($_POST['id'])){
        $value=$_POST['value'];
        list($column, $id) = explode("_", $_POST['id']);
            if(strstr($column,'Link')){
                if(!strstr($value,'http')) $value='http://'.$value;
            }
        $consulta->setConsulta('UPDATE background SET '.$column.'="'.$value.'" WHERE id='.$id);
        $consulta->setConsulta('SELECT * FROM background WHERE id='.$id);
        echo $consulta->getData($column);
        exit;
    }
} 
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if(!empty($_FILES[$fileElementName]['error']))
{
        switch($_FILES[$fileElementName]['error'])
        {
            case '1':
                    $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                    break;
            case '2':
                    $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                    break;
            case '3':
                    $error = 'The uploaded file was only partially uploaded';
                    break;
            case '4':
                    $error = 'No file was uploaded.';
                    break;

            case '6':
                    $error = 'Missing a temporary folder';
                    break;
            case '7':
                    $error = 'Failed to write file to disk';
                    break;
            case '8':
                    $error = 'File upload stopped by extension';
                    break;
            case '999':
            default:
                        $error = 'No error code avaiable';
        }
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
			//for security reason, we force to remove all uploaded file
                        $uploads_dir="background";
			$tmp_name = $_FILES["fileToUpload"]["tmp_name"];
                        $name = $_FILES["fileToUpload"]["name"];
                        move_uploaded_file($tmp_name, "$uploads_dir/$name");
                        //@unlink($_FILES['fileToUpload']);		
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
}        
  */
?>
<!DOCTYPE html>
<head>
     <?php include 'head.php'; ?>
</head>
<body>
    
    <script>
$(document).ready(function() {
     $('.edit_area').editable('', { 
         type      : 'textarea',
         onblur   : 'submit',
         indicator : 'Saving...',
         tooltip   : ''
     });
     $('.edit_area_link').editable('', { 
         type      : 'textarea',
         onblur   : 'submit',
         indicator : 'Saving...',
         tooltip   : 'Link'
     });
     $('select').live('change', function () {
        $(this).parents('form').submit();

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
                    <p><label for="name">Name</label><input name="name" id="name" type="text" value=""></p>
                    <p><label for="job">Job</label><input name="job" id="job" type="text" value=""></p>
                    <p><label for="photographer">Photographer</label><input name="photographer" id="photographer" type="text" value=""></p>
                    <p><label for="client">Client</label><input name="client" id="production" type="text" value=""></p>
                    <p><label for="agency">Agency</label><input name="agency" id="agency" type="text" value=""></p>
                    <p><label for="agency">Style</label>
                        <select class="background_select" name="style">
                            <option value="Dark">Dark</option>
                            <option value="Black">Black</option>
                            <option value="Light">Light</option>
                        </select>
                    </p>
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Upload file</strong></span>
                            <input type="file" name="fileToUpload" />
                        </label>
                    </div>
                    <div><label for="save"></label><input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="$('.hide').css('display','none')"/></div>
                </form>
            </div>
            <h2>Background</h2>
            <div id="container">
                
                <ul id="sortable" rel="cosa">                    
                    <?php 
                        $bg=new Consulta();
                        $bg->setConsulta("SELECT * FROM background");
                        if($bg->num)do{
                        ?>
                            <li class="ui-state-default" id="">
                                <form action="" method="post" onsubmit="" id="form">
                                <input type="hidden" value="<?php echo $bg->getData('id');?>" name="idStyle">
                                <img src="<?php echo $uploads_dir."/".$bg->getData('file');?>">                          
                                
                                <div class="gallery_box_info">
                                    <select class="background_select" name="sel">
                                        <option value="Dark" <?php if($bg->getData('style')=='Dark') echo 'selected' ?>>Dark</option>
                                        <option value="Black" <?php if($bg->getData('style')=='Black') echo 'selected' ?>>Black</option>
                                        <option value="Light" <?php if($bg->getData('style')=='Light') echo 'selected' ?>>Light</option>
                                    </select><br>
                                </form>     
                                <form action="" method="post" onsubmit="" id="form">
                                    <label class="bold">Name</label><div class="edit_area" id="name_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('name');?></div>
                                    <label class="bold">Job</label><div class="edit_area" id="job_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('job');?></div><div class="edit_area_link" id="jobLink_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('jobLink');?></div>
                                    <label class="bold">Photographer</label><div class="edit_area" id="photographer_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('photographer');?></div><div class="edit_area_link" id="photographerLink_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('photographerLink');?></div>
                                    <label class="bold">Agency</label><div class="edit_area" id="agency_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('agency');?></div><div class="edit_area_link" id="agencyLink_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('agencyLink');?></div>
                                    <label class="bold">Client</label><div class="edit_area" id="client_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('client');?></div><div class="edit_area_link" id="clientLink_<?php echo $bg->getData('id');?>"><?php echo $bg->getData('clientLink');?></div>
                                 
                                                               
                                </form> 
                                </div>
                                <div style="text-align:right;margin-top:10px;float:left;">
                                    <form name="form" action="" method="POST" enctype="multipart/form-data">     
                                        <input type="hidden" value="upload" name="form">
                                        <input type="hidden" value="<?php echo $bg->getData('id');?>" name="id">
                                        <div class="field" style="clear:both; height:64px;width: 100%;float:left;">
                                            <label class="file-upload">
                                                <span><strong>Thumbnail</strong></span>
                                                <input type="file" name="fileToUpload" />
                                            </label>
                                        </div>
                                        <input type="submit" id="save" value="Save" onclick="" style="margin:0;float:left;" class="btn" />
                                    </form>
                                    <form action="" method="POST" onsubmit="" id="">                                    
                                    <input type="hidden" value="delete" name="form">
                                    <input type="hidden" value="<?php echo $bg->getData('id');?>" name="id">
                                    <input type="submit" id="save" value="Delete" onclick="" style="background: #bb0000;margin:0;float:left;" class="btn" />
                                </form>
                                </div>
                                <div style="text-align:right;margin-top:10px">
                                
                                </div>
                            </li>
                        <?php }while($bg->nextRow());?>
                    </ul>
                    <div style="text-align: right;">
                       <input type="button" id="save" value="Upload" onclick="$('.hide').css('display','block')" class="btn" />
                    </div>              
            </div>
        </div>
    </div>   

    <?php include 'footer.php'; ?>
</body>