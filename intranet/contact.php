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
$vcard= 'vcard';
$uploads_dir="../uploads/contact";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($_POST['form']=='delete'){
        $consulta->setConsulta('SELECT * FROM contact WHERE id='.$_POST['id']);
        unlink($uploads_dir."/".$consulta->getData('img'));
        unlink($uploads_dir."/".$consulta->getData('vcard'));
        $consulta->setConsulta('DELETE FROM contact WHERE id="'.$_POST['id'].'"');
    }
    if($_POST['form']=='updateOrder'){
        foreach($_POST['foo'] as $key=>$value){
             $consulta=new Consulta();
             $consulta->setConsulta('UPDATE contact SET orden="'.$key.'" WHERE id="'.$value.'"');
        }
    }
    if($_POST['form']=='insert'){
        $insert=Array();
        foreach($_POST as $key=>$value){
            if($key!='form'){
                $column[]=$key;    
                $insert[]=$value;
            }
        }
        if(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
        {
            
        }else 
        {
            $tmp_name = $_FILES[$fileElementName]["tmp_name"];
            $pathinfo = pathinfo($_FILES[$fileElementName]["name"]);
            $ext='.'.$pathinfo['extension'];
            $file = uniqid($pathinfo['filename'].'_');
            $name=$file.$ext;          
            move_uploaded_file($tmp_name, "$uploads_dir/$name");
            $column[]='img';    
            $insert[]=$name;
            
            if(empty($_FILES[$vcard]['tmp_name']) || $_FILES[$vcard]['tmp_name'] == 'none'){}else 
            {
                $tmp_name = $_FILES[$vcard]["tmp_name"];
                $pathinfo = pathinfo($_FILES[$vcard]["name"]);
                $ext='.'.$pathinfo['extension'];
                $file = uniqid($pathinfo['filename'].'_');
                $name=$file.$ext;
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
                $column[]='vcard';    
                $insert[]=$name;
            }
            foreach($column as $key=>$value){
                $columna.=$value.","; 
            }
            foreach($insert as $key=>$value){
                $inserta.="'".$value."',"; 
            }
            $inserta=substr ( $inserta , 0, -1 );
            $columna=substr ( $columna , 0, -1 );
            $consulta->setConsulta('INSERT INTO contact ('.$columna.') VALUES  ('.$inserta.')');	
        }
    }
    if(isset($_POST['idPerson'])){
        list($column, $id) = explode("_", $_POST['idPerson']);
        $consulta->setConsulta('UPDATE contact SET '.$column.'="'.$_POST['value'].'" WHERE id='.$id);
        $consulta->setConsulta('SELECT * FROM contact WHERE id='.$id);
        echo $consulta->getData($column);
        exit;
    }
    if(isset($_POST['idText'])){
        $consulta->setConsulta('UPDATE info SET value="'.$_POST['value'].'" WHERE options="about"');
        $consulta->setConsulta('SELECT * FROM info WHERE options="about"');
        echo $consulta->getData('value');
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
     $('.edit_area').editable('', { 
         type      : 'textarea',
         onblur   : 'submit',
         id     : 'idPerson',
         indicator : '<img src="img/indicator.gif">',
         tooltip   : ''
     });
     $('.edit_info').editable('', { 
         type      : 'textarea',
         submit        : 'Ok',
         cancel    : 'Cancel',
         id     : 'idText',
         indicator : '<img src="img/indicator.gif">',
         tooltip   : ''
     });
     $('select').live('change', function () {
        $(this).parents('form').submit();

       });
 });
 $(function() {
   $('#sortable').sortable({
        start: function(event, ui) {
            $(ui.helper).addClass("sortable-drag-clone");
        },
        stop: function(event, ui) {
            $(ui.helper).removeClass("sortable-drag-clone");
        },
        update: function(event, ui) {
            updateListItem($(ui.item).attr('rel'), $(this).attr('rel'));
        },
        tolerance: "pointer",
        connectWith: "#sortable",
        placeholder: "sortable-draggable-placeholder",
        forcePlaceholderSize: true,
        appendTo: 'body',
        helper: 'clone',
        zIndex: 666
    }).disableSelection();
    //var sorted = $( "#sortable" ).sortable( "serialize", { key: "sort" } );    
});
function updateListItem(itemId, newStatus) {
    //var sorted = $( "#sortable" ).sortable( "toArray" );
    var sorted = $( "#sortable" ).sortable( "serialize" );
    $.post('',sorted+'&form=updateOrder').done(function(data) {});
  }
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
                    <p><label for="tel">Telephone</label><input name="tel" id="photographer" type="text" value=""></p>
                    <p><label for="client">Mail</label><input name="mail" id="production" type="text" value=""></p>
                       
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Image</strong></span>
                            <input type="file" name="fileToUpload" />
                        </label>
                    </div>
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Vcard</strong></span>
                            <input type="file" name="vcard" />
                        </label>
                    </div>
                    <div><label for="save"></label><input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="$('.hide').css('display','none')"/></div>
                </form>
            </div>
            <h2>Contact</h2>
            <div id="container"> 
                <h2>Info</h2>
                <div class="edit_info" id="about" style='height: auto; margin-bottom: 20px;'>
                <?php 
                $consulta->setConsulta('SELECT  * FROM info WHERE  options =  "about"');
                echo $consulta->getData('value');?>
                </div>
                <h2>Personal</h2>
                <ul id="sortable" rel="cosa">                    
                    <?php 
                        $consulta->setConsulta("SELECT * FROM contact order by orden");
                        $id=$consulta->getData('id');
                        if($consulta->num)do{
                        ?>
                            <li class="ui-state-default" id="foo_<?php echo $consulta->getData('id');?>">
                                <form action="" method="post" onsubmit="" id="form">
                                <input type="hidden" value="<?php echo $consulta->getData('id');?>" name="id">
                                <img src="../uploads/contact/<?php echo $consulta->getData('img');?>">                              
                                <form action="" method="post" onsubmit="" id="form">
                                    <label class="bold">Name</label><div class="edit_area" id="name_<?php echo $id;?>"><?php echo $consulta->getData('name');?></div>
                                    <label class="bold">Job</label><div class="edit_area" id="job_<?php echo $id;?>"><?php echo $consulta->getData('job');?></div>
                                    <label class="bold">Telephone</label><div class="edit_area" id="photographer_<?php echo $id;?>"><?php echo $consulta->getData('tel');?></div>
                                    <label class="bold">Mail</label><div class="edit_area" id="agency_<?php echo $id;?>"><?php echo $consulta->getData('mail');?></div> 
                                            
                                </form> 
                                <div style="text-align:right;margin-top:10px">
                                <form action="" method="POST" onsubmit="" id="">                                    
                                    <input type="hidden" value="delete" name="form">
                                    <input type="hidden" value="<?php echo $id;?>" name="id">
                                    <input type="submit" id="save" value="Delete" onclick="" style="background: #bb0000;margin:0;" class="btn" />
                                </form>
                                </div>
                            </li>
                        <?php }while($consulta->nextRow());?>
                    </ul>
                
                    <div style="text-align: right;">
                       <input type="button" id="save" value="Upload" onclick="$('.hide').css('display','block')" class="btn" />
                    </div>              
            </div>
        </div>
    </div>   

    <?php include 'footer.php'; ?>
</body>