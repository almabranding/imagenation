$(document).ready(function() {
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
});
$(function() {

$(".tbl_order tbody").tableDnD({
    onDrop: function(table, row) {
        var orders = $.tableDnD.serialize();
        console.log(orders);
        $.post('util/order.php', { orders : orders });
    }
});

});
function showPop(id){
    $('#white_full').css('display','block');
    $('#'+id).css('display','block');  
}
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

function uploadAvatar(path,id){
     $('#uploadAvatar').uberuploadcropper({
            //---------------------------------------------------
            // uploadify options..
            //---------------------------------------------------
            fineuploader: {
                    //debug : true,
                    request	: { 
                            // params: {}
                            endpoint: '../upload/'+id+'/'
                    },						
                    validation: {
                            sizeLimit	: 1500000,
                            allowedExtensions: ['jpg','jpeg','png','gif']
                    }
            },
            //---------------------------------------------------
            //now the cropper options..
            //---------------------------------------------------
            jcrop: {
                    aspectRatio  : 0, 
                    allowSelect  : true, //can reselect
                    allowResize  : true,  //can resize selection
                    setSelect    : [ 0, 0, 200, 200 ], //these are the dimensions of the crop box x1,y1,x2,y2
                    minSize      : [ 200, 200 ], //if you want to be able to resize, use these
                    maxSize      : [ 500, 500 ],
                    changeW      : false,
                    changeH      : false,
                    newW         : 300,
                    newH         : false
            },
            //---------------------------------------------------
            //now the uber options..
            //---------------------------------------------------
            folder           : path, // only used in uber, not passed to server
            cropAction       : '/imagenation/intranet/util/crop.php?id='+id, // server side request to crop image
            onComplete       : function(e,imgs,data){ 
                    for(var i=0,l=imgs.length; i<l; i++){
                            var fn=imgs[i].originalFilename.split('.');
                            var ext =  fn.pop();
                            var filename = fn.join('.');
                            $.post("../uploadSave/"+id+"/"+imgs[i].originalFilename);
                            $('#targetUpload').find('img').attr('src',"/imagenation/uploads/"+id+"/"+imgs[i].originalFilename);
                            $('#avatar').attr('src',"/imagenation/uploads/"+id+"/"+filename+'_thumb.'+ext);
                    }
            }
    });

}
function uploadImages(path,id){
     $('#uploadImages').uberuploadcropper({
            //---------------------------------------------------
            // uploadify options..
            //---------------------------------------------------
            fineuploader: {
                    //debug : true,
                    request	: { 
                            // params: {}
                            endpoint: '../../image/upload/'+id+'/'
                    },						
                    validation: {
                            sizeLimit	: 1500000,
                            allowedExtensions: ['jpg','jpeg','png','gif']
                    }
            },
            //---------------------------------------------------
            //now the cropper options..
            //---------------------------------------------------
            jcrop: {
                    aspectRatio  : 0, 
                    allowSelect  : true, //can reselect
                    allowResize  : true,  //can resize selection
                    setSelect    : [ 0, 0, 200, 200 ], //these are the dimensions of the crop box x1,y1,x2,y2
                    minSize      : [ 200, 200 ], //if you want to be able to resize, use these
                    maxSize      : [ 500, 500 ],
                    changeW      : false,
                    changeH      : false,
                    newW         : 300,
                    newH         : false
            },
            //---------------------------------------------------
            //now the uber options..
            //---------------------------------------------------
            folder           : path, // only used in uber, not passed to server
            cropAction       : '/imagenation/intranet/util/crop.php?id='+id+'/images', // server side request to crop image
            onComplete       : function(e,imgs,data){ 
                    for(var i=0,l=imgs.length; i<l; i++){
                            var fn=imgs[i].originalFilename.split('.');
                            var ext =  fn.pop();
                            var filename = fn.join('.');
                            $.post("../../image/uploadSave/"+id+"/"+imgs[i].originalFilename, function(data) {
                                $('#sortable').append('<li id="foo_'+data+'" class="ui-state-default" onclick=""><img caption="seat._mii_heme_spain_001.jpg" src="/imagenation/uploads/'+id+'/images/'+filename+'_thumb.'+ext+'"><form method="post" action=""><input id="delete" type="hidden" value="1" name="delete"><input id="h'+data+'" class="btn editImg" type="button" value="Edit" onclick="" style="margin:0;"><input id="save" class="btn" type="submit" value="Delete" onclick="" style="background: #bb0000;margin:0;"><input id="id" type="hidden" value="'+data+'" name="id"><input id="img" type="hidden" value="'+data+'" name="idImg"></form></li>');
                            });
                    }
            }
    });

}
