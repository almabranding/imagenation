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
$uploads_dir="../uploads";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form']=='delete')
{
    $consulta->setConsulta('SELECT * FROM project WHERE id='.$_POST['id']);
    $uploads_dir.='/'.$consulta->getData('id');
    $consulta->setConsulta('DELETE FROM project WHERE id="'.$_POST['id'].'"');
    delTree($uploads_dir);
    $consulta->setConsulta('DELETE FROM images WHERE project="'.$_POST['id'].'"');
    
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
        $pathinfo = pathinfo($_FILES["fileToUpload"]["name"]);
        $ext='.'.$pathinfo['extension'];
        $file = uniqid($pathinfo['filename'].'_');
        $nameFile=$file.$ext;
        $avatar = $file.'_avatar'.$ext;

        $column[]='img';    
        $insert[]=$nameFile;
        $column[]='avatar';    
        $insert[]=$avatar;
        $columna='';
        $inserta='';
        foreach($column as $key=>$value){
            $columna.=$value.","; 
        }
        foreach($insert as $key=>$value){
            $inserta.="'".$value."',"; 
        }
        $inserta=substr ( $inserta , 0, -1 );
        $columna=substr ( $columna , 0, -1 );
        $consulta->setConsulta('INSERT INTO project ('.$columna.') VALUES  ('.$inserta.')');	
        $uploads_dir.='/'.$consulta->lastID();
        mkdir($uploads_dir);
        mkdir($uploads_dir.'/images');
        move_uploaded_file($_FILES[$fileElementName]['tmp_name'], "$uploads_dir/$nameFile");
        copy("$uploads_dir/$nameFile", "$uploads_dir/$avatar");
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
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach($_POST['foo'] as $key=>$value){
             $consulta=new Consulta();
             $consulta->setConsulta('UPDATE project SET orderNum="'.$key.'" WHERE id="'.$value.'"');
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
 function hidePreview()
  {
    $preview.stop().fadeOut('fast');
  };
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
    console.log(sorted);
    $.post('',sorted+'&action=updateOrder').done(function(data) {});
  }
</script>
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="mainarea">
            <div class="white_full hide" onclick="$('.hide').css('display','none')"></div>
            <div class="white_box hide">
                 <h2 style="width:100%">Upload Work</h2>
                 <form name="form" action="" method="POST" enctype="multipart/form-data">
                    <input name="form" id="name" type="hidden" value="insert">
                    <p><label for="name">Name</label><input name="name" id="name" type="text" value=""></p>
                    <p class="foto"><label for="photo">Photographer</label><input name="photo" id="photo" type="text" value=""></p>
                    <p><label for="prod">Prod. Company</label><input name="prod" id="prod" type="text" value=""></p>       
                    <p class="video"><label for="scompany">Service Company</label><input name="scompany" id="scompany" type="text" value=""></p>
                    <p class="video"><label for="director">Director</label><input name="director" id="director" type="text" value=""></p>
                    <p><label for="agency">Agency</label><input name="agency" id="agency" type="text" value=""></p>
                    <p><label for="location">Location</label><input name="location" id="location" type="text" value=""></p>
                    <p class="video"><label for="urlVideo">Vimeo</label><input name="urlVideo" id="urlVideo" type="text" value=""></p>
                    <p class="video"><label for="dop">D.O.P.</label><input name="dop" id="dop" type="text" value=""></p>
                    <p><label for="video">Video</label><input id="video" type="checkbox" value="1" name="video"></p>
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Thumbnail</strong></span>
                            <input type="file" name="fileToUpload" />
                        </label>
                    </div>
                    <div><label for="save"></label><input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="$('.hide').css('display','none')"/></div>
                </form>
            </div>
            <h2>Works</h2>
            <div id="container">
                
                <ul id="sortable" style="width: 835px;" rel="cosa">                    
                    <?php 
                        $projects=new Consulta();
                        $projects->setConsulta("SELECT * FROM project ORDER BY orderNum");
                        if($projects->num) do{
                        ?>
                            <li class="ui-state-default" id="foo_<?php echo $projects->getData('id');?>">
                                <div style=""><form action="" method="post" onsubmit="" id="form">
                                <img src="../uploads/<?php echo $projects->getData('id').'/'.$projects->getData('img');?>">
                                <div class="gallery_box_info">
                                    <!--<label class="bold">Name</label>--><div class="edit_area" id="name_<?php echo $projects->getData('id');?>"><?php echo $projects->getData('name');?></div>
                                    <!--<label class="bold">Photographer</label><div class="edit_area" id="photo_<?php //echo $projects->getData('id');?>"><?php //echo $projects->getData('photo');?></div>
                                    <label class="bold">Prod. Company</label><div class="edit_area" id="prod_<?php //echo $projects->getData('id');?>"><?php //echo $projects->getData('prod');?></div>
                                    <label class="bold">Agency</label><div class="edit_area" id="agency_<?php //echo $projects->getData('id');?>"><?php //echo $projects->getData('agency');?></div>
                                    <label class="bold">Location</label><div class="edit_area" id="location_<?php //echo $projects->getData('id');?>"><?php //echo $projects->getData('location');?></div>
                                    <label class="bold">URL</label><div class="edit_area" id="urlVideo_<?php //echo $projects->getData('id');?>"><?php //echo $projects->getData('urlVideo');?></div>-->
                                </div>                                
                                </form> 
                                    </div>
                                <div style="text-align:left;margin-top:10px">
                                <form action="" method="POST" onsubmit="" id="">                                    
                                    <input type="hidden" value="delete" name="form">
                                    <input type="hidden" value="<?php echo $projects->getData('id');?>" name="id">
                                    <input type="button" id="save" value="Edit" onclick="document.location.href='project.php?id=<?php echo $projects->getData('id'); ?>';" style="margin:0 5px;" class="btn" /><input type="submit" id="save" value="Delete" onclick="" style="background: #bb0000;margin:0;" class="btn" />
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
<script>
    $('.video').hide();
    $("#video").on("change", function(event){
      var form=$(this).parents('form') ;
      if($(this).is(':checked')){
          form.children('.foto').hide();
          form.children('.video').show();
      }else{
          form.children('.foto').show();
          form.children('.video').hide();
      }
    });
</script>
    <?php include 'footer.php'; ?>
</body>