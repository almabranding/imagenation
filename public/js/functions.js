/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function FB(link)
{   
    window.open('https://www.facebook.com/sharer/sharer.php?u='+link,'','width=600,height=200');
}
function pin(link)
{   
    window.open('https://www.facebook.com/sharer/sharer.php?u='+link,'','width=600,height=200');
}
function twitter(hash,text,related){
    $('body').append('<a id="tiwtter" name="twitter" href="https://twitter.com/intent/tweet?button_hashtag='+hash+'&text='+text+'" class="twitter-hashtag-button opacity"></a>');
    //$('body').append('<a id="tiwtter" name="twitter" href="https://twitter.com/share?hashtags='+hash+'&related='+related+'&text='+text+'" class="twitter-share-button" class="twitter-hashtag-button opacity"></a>');
    //$('#tiwtter').html('Tweet #TwitterStories');
    !function(d,s,id){
        var js,fjs=d.getElementsByTagName(s)[0];
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;
            js.src="https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js,fjs);
        }
    }(document,"script","twitter-wjs");
//!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
window.open($('#tiwtter').attr('href'), '_blank','scrollbars=1, width=580,height=300');
$('#tiwtter').remove();
}
function gallery(){
    $("a.embedClick").on('click', function(event){
        event.preventDefault();
        var url = $(this).attr("href");
        $('#white_box').html('<iframe src="'+url+'?autoplay=1" width="597" height="336" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
        $('#white_box').removeClass().addClass('embed').addClass('hide');
        $('.hide').css('display','inherit');
        return false;
   }); 
   if (screen.width > 699) {
        $(".group").colorbox({rel:'group', transition:"none",loop:false, width:"75%", height:"75%",onComplete:function(){$('#leyenda').fadeIn(300);$('body').css('overflow','hidden'); },onClosed:function(){ $('#leyenda').fadeOut(300);$('body').css('overflow','inherit');}});
    }
    $(window).resize(function() {
        var sborder=330;
        if($('#pics_r_side').width()+sborder<$(window).width()) {
            var resta=($(window).width()-sborder-$('#content').width())/2;  
            var cssObj = {
                'left' : resta
            }; 
            $('.pics_l_side ').css(cssObj);
        }                    
    });

        $('#cboxContent').bind("contextmenu",function(e){
            return false;
            });

        $('#content').masonry({
            itemSelector: '.box',
            isFitWidth: true,
            popo: function header_width(){
                var border=350;
                var ancho=$('#content').width()+border;
                var resta=($(window).width()-337-$('#content').width())/2;
                $('.footer').css('width',ancho+'px');
                $('.pics_l_side ').css('left',resta+'px');

            }
        });
}
function imagenation(){
    $(".top_arrow").on("click", function(event){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
    $('#container').masonry({
     itemSelector: '.box',
     isFitWidth: true,
     popo: function header_width(){
             var border=10;
             var ancho=$('#container').width()-border;
             $('.footer').css('width',ancho+'px');
         }
     });
    
}