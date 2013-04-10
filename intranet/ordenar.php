<?PHP
require_once 'auth.php';
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");
if (!isset($_SESSION))session_start();  $_SESSION['lang']='ES';
include_once("../functions/functions.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
        foreach($_POST['foo'] as $key=>$value){
             $consulta=new Consulta();
             $consulta->setConsulta('UPDATE project SET orderNum="'.$key.'" WHERE id="'.$value.'"');
        }
        exit;
}
?>
<!DOCTYPE html>
<head>
     <?php include 'head.php'; ?>
</head>
<body>
    <script>
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
    $.post('ordenar.php',sorted+'&action=updateOrder').done(function(data) {});
  }
</script>
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <div id="mainarea">
            <h2>Imagenation</h2>
            <div id="container">
                <ul id="sortable" rel="cosa">
                    <?php 
                $projects=new Consulta();
                $projects->setConsulta("SELECT * FROM project ORDER BY orderNum");
                do{
                    $class='';
                    $embedVideo='';
                    $img=$projects->getData('avatar');
                    if($projects->getData('video')==1){
                        //$img=$projects->getData('avatar');
                        $embedVideo='<div class="embedVideo"></div>';
                        $link='project.php?id='.$projects->getData('id');
                    
                    }else{
                        $project=new Consulta();
                        $project->setConsulta("SELECT * FROM image WHERE album_id='".$projects->getData('idProject')."' ORDER BY order_num");
                        //$img=$project->getData('raw_name').'_thumb'.$project->getData('file_ext');
                        $link='project.php?id='.$projects->getData('id');
                     
                    }
                    ?>
                    <li onClick="location.href='<?php echo $link;?>'" class="ui-state-default <?php echo $class;?>" id="foo_<?php echo $project->getData('id');?>">
                        <?php echo $embedVideo;?>
                        <img src="../uploads/<?php echo $img;?>">
                        <div class="gallery_box_info"></div>
                    </li>
                <?php }while($projects->nextRow());?>
</ul>
            </div>
        </div>
    </div>    
    <?php include 'footer.php'; ?>
</body>