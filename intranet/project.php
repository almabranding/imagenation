<?PHP
require_once 'auth.php';
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

if (!isset($_SESSION))session_start();  $_SESSION['lang']='ES';
include_once("functions/functions.php");
$consulta=new Consulta();
$fileElementName = 'fileToUpload';
$fileFB = 'fbToUpload';
$uploads_dir="../uploads";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['foo'])) {
        foreach($_POST['foo'] as $key=>$value){
         $consulta=new Consulta();
         $consulta->setConsulta('UPDATE images SET orden="'.$key.'" WHERE id="'.$value.'"');
         
        }
    }
    if (isset($_POST['editImg'])) { 
        $id = $_POST['id'];
        $video=(isset($_POST['video']))?$_POST['video']:'0';
        $urlVideo=(isset($_POST['urlVideo']))?$_POST['urlVideo']:'';
        $wVideo=(isset($_POST['wVideo']))?$_POST['wVideo']:'600';
        $hVideo=(isset($_POST['hVideo']))?$_POST['hVideo']:'300';
        $consulta->setConsulta('UPDATE images SET caption="'.$_POST['caption'].'",urlVideo="'.$urlVideo.'",video="'.$video.'",wVideo="'.$wVideo.'",hVideo="'.$hVideo.'" WHERE id="'.$id.'"');
    }
    if (isset($_POST['edit'])) {
        foreach($_POST as $id=>$value){
            if(strstr($id,'Link')){
                if(!strstr($value,'http') && $value!=null) $value='http://'.$value;
                $_POST[$id]=$value;
            }
        }
        $video=(isset($_POST['video']))?$_POST['video']:'0';
        $rel = $_POST['rel'];
        $targ_w = $_POST['w'];
        $targ_h = $_POST['h'];
        $ext = $_POST['ext'];
        $id = $_POST['id'];
        $name = $_POST['name'];
        $production = $_POST['production'];
        $agency = $_POST['agency'];
        $location = $_POST['location'];
        $dop=(isset($_POST['dop']))?$_POST['dop']:'';
        $director=(isset($_POST['director']))?$_POST['director']:'';
        $wVideo=(isset($_POST['wVideo']))?$_POST['wVideo']:'';
        $hVideo=(isset($_POST['hVideo']))?$_POST['hVideo']:'';
        $scompany=(isset($_POST['scompany']))?$_POST['scompany']:'';
        $photographer=(isset($_POST['photographer']))?$_POST['photographer']:'';
        $urlVideo=(isset($_POST['urlVideo']))?$_POST['urlVideo']:'';
        $directorLink=(isset($_POST['directorLink']))?$_POST['directorLink']:'';
        $dopLink=(isset($_POST['dopLink']))?$_POST['dopLink']:'';
        $scompanyLink=(isset($_POST['scompanyLink']))?$_POST['scompanyLink']:'';
        $photoLink=(isset($_POST['photoLink']))?$_POST['photoLink']:'';
        $agencyLink=(isset($_POST['agencyLink']))?$_POST['agencyLink']:'';
        $productionLink=(isset($_POST['prodLink']))?$_POST['prodLink']:'';
        
        
        $uploads_dir=$uploads_dir.'/'.$id;
        $consulta->setConsulta('SELECT * FROM project WHERE id=' . $id);
        $fbFile=$consulta->getData('fb');
        $avatar=$consulta->getData('avatar');
        $nameFile=$consulta->getData('img');  
        if(empty($_FILES[$fileFB]['tmp_name']) || $_FILES[$fileFB]['tmp_name'] == 'none')
        {
        }else 
        {
            $tmp_name = $_FILES[$fileFB]["tmp_name"];
            $pathinfo = pathinfo($_FILES[$fileFB]["name"]);
            $ext='.'.$pathinfo['extension'];
            $file = uniqid($pathinfo['filename'].'_');
            $fbFile=$file.$ext;
            move_uploaded_file($tmp_name, "$uploads_dir/$fbFile");
        }
        if(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
        {
        }else 
        {
            $tmp_name = $_FILES[$fileElementName]["tmp_name"];
            $pathinfo = pathinfo($_FILES[$fileElementName]["name"]);
            $ext='.'.$pathinfo['extension'];
            $file = uniqid($pathinfo['filename'].'_');
            $nameFile=$file.$ext;
            move_uploaded_file($tmp_name, "$uploads_dir/$nameFile");
        }
        $pathinfo = pathinfo($nameFile);
        $ext='.'.$pathinfo['extension'];
        $file = uniqid($pathinfo['filename'].'_');
        if(isset($_POST['w']) && $_POST['w']!=''){
            if($nameFile!=$avatar) unlink($uploads_dir.'/'.$avatar);
            $jpeg_quality = 90;
            $avatar = $file.'_avatar'.$ext;
            $src =$uploads_dir.'/'.$nameFile;
            $srcD=$uploads_dir.'/'.$avatar;
          
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x']*$rel,$_POST['y']*$rel,$targ_w,$targ_h,$_POST['w']*$rel,$_POST['h']*$rel);
        }
        $consulta->setConsulta('UPDATE project SET name="'.$name.'",img="'.$nameFile.'",avatar="'.$avatar.'",fb="'.$fbFile.'",photo="'.$photographer.'",director="'.$director.'",prod="'.$production.'",scompany="'.$scompany.'",agency="'.$agency.'",location="'.$location.'",urlVideo="'.$urlVideo.'",wVideo="'.$wVideo.'",hVideo="'.$hVideo.'",video="'.$video.'",dop="'.$dop.'",dopLink="'.$dopLink.'",scompanyLink="'.$scompanyLink.'",photoLink="'.$photoLink.'",agencyLink="'.$agencyLink.'",prodLink="'.$productionLink.'",directorLink="'.$directorLink.'" WHERE id="'.$id.'"');
        imagejpeg($dst_r,$srcD,$jpeg_quality);
    }
    if (isset($_POST['delete'])) {
        $consulta->setConsulta('SELECT * FROM images WHERE id=' . $_POST['id']);
        $id=$consulta->getData('project'); 
        unlink('../uploads/'.$id,'/images/'.$consulta->getData('name'));
        unlink('../uploads/'.$id,'/images/thumb_'.$consulta->getData('name'));
        
        $consulta->setConsulta('DELETE FROM images WHERE id=' . $_POST['id']);
    }
}

// If not a POST request, display page below:

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="last-modified" content="0">

    <meta http-equiv="expires" content="0">

    <meta http-equiv="cache-control" content="no-cache, mustrevalidate">

    <meta http-equiv="pragma" content="no-cache">

  <?php include 'head.php'; ?>
<script type="text/javascript">
 jQuery(function($){
    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
    $('#target').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      aspectRatio: 0
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;

      // Move the preview into the jcrop container for css positioning
      $preview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      $('.avatar').css('display','none');
      $('.preview').css('display','inherit');
      if (parseInt(c.w) > 0)
      {
        var rx = c.w / c.w;
        var ry = c.h / c.h;

        $pcnt.css({
          width: Math.round(c.w) + 'px',
          height: Math.round(c.h) + 'px'
        });
        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
      updateCoords(c);
    };
  });
  function updateCoords(c)
  {
      var img = document.getElementById('target');
//or however you get a handle to the IMG

    var width = img.width;
    var width = img.width;
    var height = img.height
    var rel=width/$('#target').width();
    //rel=1.98;
    $('#rel').val(rel);
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
    $('#width').text(c.w);
    $('#height').text(c.h);
    if(c.w<300) $('#width').css('color','#ef3333');
    if(c.w<350 && c.w>300 ) $('#width').css('color','#278654');
    if(c.w>350 ) $('#width').css('color','#ffa61a');
    
    if(c.h<200 || c.h>400) $('#height').css('color','#ffa61a');
    else $('#height').css('color','#278654');
  };
  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    return true;
  };
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
});
function updateListItem(itemId, newStatus) {
    var sorted = $( "#sortable" ).sortable( "serialize" );
    $.post('',sorted+'&action=updateOrder').done(function(data) {});
  }

  
</script>

</head>
<body>
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        <?php 
        $id=$_GET['id'];
        $embedVideo="";
        $project=new Consulta();
        $project->setConsulta("SELECT * FROM project WHERE id='".$id."'");
        $preview=$project->getData('img');
        $avatar=$project->getData('avatar');
        $pathinfo = pathinfo($preview);
        $ext='.'.$pathinfo['extension'];
        $file = uniqid($pathinfo['filename'].'_');
        if($project->getData('video')==1)$embedVideo='<div class="embedVideo"></div>';
        ?>
        <div id="container"  style="padding-left: 30px;">
            <div id="white_full" class="white_full hide" onclick="$('.hide').css('display','none')"></div>
            <?php
                $consulta->setConsulta('SELECT * FROM images WHERE project="' . $id . '" ORDER BY orden');
                if($consulta->num) do{
                ?>
                     <div class="white_box hide img" id="hide_h<?php echo $consulta->getData('id'); ?>">
                    <h2 style="width:100%">Edit Picture</h2>
                    <form action="" method="post"  enctype="multipart/form-data" >
                    <p><label for="caption">Caption</label><input name="caption" id="caption" type="text" value="<?php echo $consulta->getData('caption');?>"></p>
                    <p><label for="urlVideo">Vimeo</label><input name="urlVideo" id="urlVideo" type="text" value="<?php echo $consulta->getData('urlVideo');?>"></p>
                    <p><label for="urlVideo">Video Height</label><input name="hVideo" id="urlVideo" type="text" value="<?php echo $consulta->getData('hVideo');?>"></p>
                    <p><label for="urlVideo">Video Width</label><input name="wVideo" id="urlVideo" type="text" value="<?php echo $consulta->getData('wVideo');?>"></p>
                    <p><label for="video">Video</label><input name="video" type="checkbox" <?php if($consulta->getData('video')==1) echo "checked='checked'"?> value="1"></p>
                    <input type="hidden" id="editImg" name="editImg" value="1"/>
                    <input type="hidden" id="id" name="id" value="<?php echo $consulta->getData('id');?>"/>

                    <input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="$('.hide').css('display','none')"/>
                </form>
                     </div>
                      
             <?php }while($consulta->nextRow());?>
            <div class="project_form">
                <form action="" method="post" onsubmit="return checkCoords();" enctype="multipart/form-data" >
                    <p><label for="name">Name</label><input name="name" id="name" type="text" value="<?php echo $project->getData('name');?>"></p>
                    <p class="video"><label for="urlVideo">Vimeo</label><input name="urlVideo" id="urlVideo" type="text" value="<?php echo $project->getData('urlVideo');?>"></p>
                    <p class="video"><label for="urlVideo">Video Height</label><input name="hVideo" id="urlVideo" type="text" value="<?php echo $project->getData('hVideo');?>"></p>
                    <p class="video"><label for="urlVideo">Video Width</label><input name="wVideo" id="urlVideo" type="text" value="<?php echo $project->getData('wVideo');?>"></p>
                    <p><label for="location">Location</label><input name="location" id="location" type="text" value="<?php echo $project->getData('location');?>"></p>
                    <p class="video"><label for="director">Director</label><input name="director" id="director" type="text" value="<?php echo $project->getData('director');?>"></p>
                    <p  class="video"><label for="directorLink"></label><input class="linkExt" name="directorLink" id="directorLink" type="text" value="<?php echo $project->getData('directorLink');?>" placeholder="Link"></p>
                    <p  class="foto"><label for="photographer">Photographer</label><input name="photographer" id="photographer" type="text" value="<?php echo $project->getData('photo');?>"></p>
                    <p  class="foto"><label for="photographerLink"></label><input class="linkExt" name="photoLink" id="photographerLink" type="text" value="<?php echo $project->getData('photoLink');?>" placeholder="Link"></p>
                    <p><label for="production">Prod. Company</label><input name="production" id="production" type="text" value="<?php echo $project->getData('prod');?>"></p>
                    <p><label for="production"></label><input class="linkExt" placeholder="Link" name="prodLink" id="prodLink" type="text" value="<?php echo $project->getData('prodLink');?>"></p>
                    <p class="video"><label for="scompany">Service Company</label><input  name="scompany" id="scompany" type="text" value="<?php echo $project->getData('scompany');?>"></p>
                    <p class="video"><label for="scompany"></label><input class="linkExt" placeholder="Link" name="scompanyLink" id="scompany" type="text" value="<?php echo $project->getData('scompanyLink');?>"></p>
                    <p><label for="agency">Agency</label><input name="agency" id="agency" type="text" value="<?php echo $project->getData('agency');?>"></p>
                    <p><label for="agency"></label><input class="linkExt" placeholder="Link" name="agencyLink" id="agencyLink" type="text" value="<?php echo $project->getData('agencyLink');?>"></p>
                    <p class="video"><label for="dop">D.O.P.</label><input name="dop" id="dop" type="text" value="<?php echo $project->getData('dop');?>"></p>
                    <p class="video"><label for="dop"></label><input class="linkExt" placeholder="Link" name="dopLink" id="dop" type="text" value="<?php echo $project->getData('dopLink');?>"></p>
                    <p><label for="video">Video</label><input id="video" type="checkbox" value="1" name="video" <?php if($project->getData('video')==1) echo 'checked="checked"'?>><span style='font-size:9px;'> (If no pictures in this project)</span></p>
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Thumbnail</strong></span>
                            <input type="file" name="fileToUpload" />
                        </label>
                    </div>
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Facebook</strong></span>
                            <input type="file" name="fbToUpload" />
                        </label>
                    </div>
                    <input type="hidden" id="file" name="file" value="<?php echo $file;?>"/>
                    <input type="hidden" id="edit" name="edit" value="1"/>
                    <input type="hidden" id="ext" name="ext" value="<?php echo $ext;?>"/>
                    <input type="hidden" id="id" name="id" value="<?php echo $id;?>"/>
                    <input type="hidden" id="rel" name="rel" />
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y"  />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h"/>
                    <label ></label><input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="document.location.href='works.php';"/>
                </form>
            </div>
            
            <div id="preview-pane">
                <div class="preview-container">
                <img src="../uploads/<?php echo $id.'/'.$preview;?>" class="preview jcrop-preview" alt="Preview" />
                <img src="../uploads/<?php echo $id.'/'.$avatar;?>" class="avatar" alt="No preview selected" />
                </div>
            </div>
            <img src="../uploads/<?php echo $id.'/'.$preview;?>" id="target" />
            <div class="size_info">Width:<span id="width">0</span>, Hight:<span id="height">0</span> (Optimal width:300px)</div>
            <ul id="sortable" class="ui-sortable" rel="cosa">
                <?php
                $consulta->setConsulta('SELECT * FROM images WHERE project="' . $id . '" ORDER BY orden');
                if($consulta->num) do{
                ?>
                        <li id="foo_<?php echo $consulta->getData('id'); ?>" class="ui-state-default" onclick="">
                            <img src="../uploads/<?php echo $consulta->getData('project').'/images/'.$consulta->getData('name'); ?>" caption="<?php echo $consulta->getData('caption'); ?>">
                            <form action="" method="post">
                            <input type="hidden" id="delete" name="delete" value="1"/>
                            <input id="h<?php echo $consulta->getData('id'); ?>" class="btn editImg" type="button" style="margin:0;" onclick="" value="Edit">
                            <input id="save" class="btn" type="submit" style="background: #bb0000;margin:0;" onclick="" value="Delete">
                            <input type="hidden" id="id" name="id" value="<?php echo $consulta->getData('id'); ?>"/>
                            <input type="hidden" id="img" name="idImg" value="<?php echo $consulta->getData('id'); ?>"/>
                            </form>
                        </li>
                <?php }while($consulta->nextRow());?>
                    </ul>
            <div id="dropbox">
                <input id="project" type="hidden" value="<?php echo $id; ?>">
                <input id="uploadType" type="hidden" value="practice">
                <input id="bbdd" type="hidden" value="images">
                <span class="message">Drop images here to upload. <br /><i>(they will only be visible to you)</i></span>
            </div>
        </div>
    </div>
	<?php include '../footer.php'; ?>
<script>
    $("#container").on("click",".editImg", function(event){
      var h=$(this).attr('id');
      $('#white_full').css('display','block');
      $('#hide_'+h).css('display','block');
    });


    if($('#video').is(':checked')){
          $('.foto').hide();
          $('.video').show();
      }else{
          $('.foto').show();
          $('.video').hide();
      }
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
</body>

</html>
