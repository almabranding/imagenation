<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $_POST['w'];
        $targ_h = $_POST['h'];
	$jpeg_quality = 90;

	$src = 'demo_files/pool.jpg';
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	//header('Content-Type: image/jpeg');
	imagejpeg($dst_r,'demo_files/pool_nuevo.jpg',$jpeg_quality);

	exit;
}

// If not a POST request, display page below:

?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Cropping Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <base href="http://borndevelopments.com/imagenation/intranet/"/>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="demo_files/main.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  
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
    
    console.log('init',[xsize,ysize]);
    $('#target').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      minSize: [ 300, 0 ],
      maxSize: [ 300, 0 ],
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
      updateCoords(c)
    };

  });
  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }
.jcrop-holder #preview-pane {
    background-color: white;
    border: 1px solid rgba(0, 0, 0, 0.4);
    border-radius: 6px 6px 6px 6px;
    box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    display: block;
    padding: 6px;
    position: absolute;
    right: -339px;
    top: 10px;
    z-index: 2000;
}
#preview-pane .preview-container {
    height: 170px;
    overflow: hidden;
    width: 250px;
}

</style>

</head>
<body>
        <?php include 'sidebar.php'; ?>
    <div class="container" class="container_intranet">
        <!-- This is the image we're attaching Jcrop to -->
        <img src="demo_files/pool.jpg" id="target" />
        <div id="preview-pane">
            <div class="preview-container">
            <img src="demo_files/pool.jpg" class="jcrop-preview" alt="Preview" />
            </div>
        </div>
        <!-- This is the form that our event handler fills -->
        <form action="crop.php" method="post" onsubmit="return checkCoords();">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
        </form>

    </div>
    <div class="clr"></div>
	<?php include '../footer.php'; ?>
</body>

</html>
