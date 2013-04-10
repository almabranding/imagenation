
            <div id="container" class="container_gallery">
            <div id="pics_l_side" class="pics_l_side ">                
                <div class="reference_pic">
                    <?php $value=$this->projectInfo;  $value=$value[0];?>
                    <div class="reference_box_info gallery_box_info">
                        <div class="picoR"></div>
                        <span class="gallery_info_title"><?php echo $value['name'];?></span><br>
                        <span class="gallery_info_tr">Photographer</span> <?php if($value['photoLink']!='') echo '<a href="'.$value['photoLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['photo'];?></span><?php if($value['photoLink']!='') echo '</a>';?><br>
                        <span class="gallery_info_tr">Prod. Company</span> <?php if($value['prodLink']!='') echo '<a href="'.$value['prodLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['prod'];?></span><?php if($value['prodLink']!='') echo '</a>';?><br>
                        <span class="gallery_info_tr">Agency</span> <?php if($value['agencyLink']!='') echo '<a href="'.$value['agencyLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['agency'];?></span><?php if($value['agencyLink']!='') echo '</a>';?><br>
                        <span class="gallery_info_tr">Location</span> <span class="gallery_info_name"><?php echo $value['location'];?></span><br>
                   </div>
                    <div id="leyenda" class="reference_box_info gallery_box_info" style="display:none;">
                        <span class="gallery_info_title"><?php echo $value['name'];?></span><br>
                        <span class="gallery_info_tr">Photographer</span> <?php if($value['photoLink']!='') echo '<a href="'.$value['photoLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['photo'];?></span><?php if($value['photoLink']!='') echo '</a>';?><br>
                        <span class="gallery_info_tr">Prod. Company</span> <?php if($value['prodLink']!='') echo '<a href="'.$value['prodLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['prod'];?></span><?php if($value['prodLink']!='') echo '</a>';?><br>
                        <span class="gallery_info_tr">Agency</span> <?php if($value['agencyLink']!='') echo '<a href="'.$value['agencyLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['agency'];?></span><?php if($value['agencyLink']!='') echo '</a>';?><br>
                        <span class="gallery_info_tr">Location</span> <span class="gallery_info_name"><?php echo $value['location'];?></span><br>
                    </div>
                    <a href="<?php echo URL.'works';?>"><div class="back_arrow">Back to works</div></a>
                </div>
            </div>
            <div id="pics_r_side" class="pics_r_side">
                <div id="content" class="clearfix transitions-enabled" style="margin:auto;">
                <?php
                 foreach($this->projectGallery as $key=>$value){
                    list($ancho, $alto, $tipo, $atributos) = getimagesize(URL.'uploads/'.$value['project'].'/images/'.$value['name']);
                    if($ancho>$alto)$class=($ancho/$alto>=1.7)?'pic_box_h':'';
                    if($alto>$ancho)$class=($alto/$ancho>=1.2)?'pic_box_v':'';
                    $class.=($value['video']==1)?' videoCapa':'';
                    ?>
                <div class="pic_box <?php echo $class;?> box">
                    <?php if($value['video']==1){ ?>
                        <a class="embedClick zgallery1" href="http://player.vimeo.com/video/<?php echo $value['urlVideo']; ?>" ><div class="embedVideo"></div></a><img src="<?php echo URL.'uploads/'.$value['project'].'/images/'.$value['name'];?>"  alt="<?php echo $value['caption'];?>">
                            <?php }else{ ?>
                        <a class="zoombox zgallery1 group" href="<?php echo URL.'uploads/'.$value['project'].'/images/'.$value['name'];?>" title="<?php echo $value['caption'];?>"><img src="<?php echo URL.'uploads/'.$value['project'].'/images/'.$value['name'];?>"  alt="<?php echo $value['caption'];?>"></a>
                    <?php }?>
                </div>                
                <?php }?>
                <div class="clr"></div>
                </div>
            </div>
             <div class="clr"></div>
            </div>
  
        <script>

$(window).load(function(){
    gallery();    
    
});
        </script>
