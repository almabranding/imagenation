<div id="container" class="contact_gallery clr">
<div style="width: 100%;max-width: 1800px; margin: auto;"> <ul>
    <?php foreach($this->getContacts as $key=>$value){ ?>
    <li>
        <div class="person_box box">
            <a href='mailto:<?php echo $value['mail'];?>'><div class="contact_face"><img src="uploads/contact/<?php echo $value['img'];?>"></div></a>
            <div class="gallery_box_info">
                <div class="pico_gallery"></div>
                <span class="contact_info_title"><?php echo $value['name'];?></span><br>
                <span class="contact_info_name"><?php echo $value['job'];?></span><br>
                <span class="contact_info_name"><?php echo $value['tel'];?></span><br>
                <a href="mailto:<?php echo $value['mail'];?>"><span class="contact_info_name"><?php echo $value['mail'];?></span></a><br>
                <?php if($value['vcard']!='') echo '<a href="uploads/contact/'.$value['vcard'].'">';?><div class="v_card"></div><?php if($value['vcard']!='') echo '</a>';?>
            </div>
        </div>
    </li>

    <?php } ?> 
</ul>
</div>

<div class='contact_line clr'></div>
<?php $value=$this->getInfo; $value=$value[0]; ?>
<div class='contact_text'><?php echo $value['value'];?><h2 style='margin-top: 5px;'>Let's do it</h2></div>
<!--<div class="footer_social" style='margin: auto;'>
    <a href='https://www.facebook.com/imagenationbcn' target='_blank'><div class="social_fb"></div></a>
    <a href='https://vimeo.com/user8621304' target='_blank'><div class="social_vi"></div></a>
    <a href='http://www.linkedin.com/company/imagenation-s-l' target='_blank'><div class="social_in"></div></a>
</div>-->
</div>
<script>
            
$(function(){
   $(window).load(function(){  
       var ancho=$('#container ul').width();
       $('.footer').css('width',ancho+'px');  
   }).resize(function(){  
       var ancho=$('#container ul').width();
       $('.footer').css('width',ancho+'px');  
   }); 
});


</script>