<h1>Help</h1>
<div>
    <?php $this->form->render(); ?>
</div>
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
      aspectRatio: xsize / ysize
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
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
    };

  });


</script>
<style type="text/css">

/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 250px;
  height: 170px;
  overflow: hidden;
}
/*
function updateCoords(c)
  {
      var img = document.getElementById('target');

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
  };*/
</style>
<div class="container">
    <?php foreach($this->img as $value){?>
  <img src="<?php echo UPLOAD_ABS.$value['project'].'/'.$value['img'];?>" id="target" alt="[Jcrop Example]" />
  <div id="preview-pane">
    <div class="preview-container">
      <img src="<?php echo UPLOAD_ABS.$value['project'].'/'.$value['img'];?>" class="jcrop-preview" alt="Preview" />
    </div>
  </div>
  <?php   } ?>
<div class="clearfix"></div>
</div>
