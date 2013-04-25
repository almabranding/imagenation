<div id="container" class="container_gallery">
<div id="pics_l_side" class="pics_l_side ">                
    <div class="reference_pic">
        <?php $value=$this->projectInfo[0];?>
        <div class="reference_box_info gallery_box_info">
            <div class="picoR"></div>
            <span class="gallery_info_title"><?php echo $value['name'];?></span><br>
           <span class="gallery_info_tr">Director</span> <?php if($value['directorLink']!='') echo '<a href="'.$value['directorLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['director'];?></span><?php if($value['directorLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Service Company</span> <?php if($value['scompanyLink']!='') echo '<a href="'.$value['scompanyLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['scompany'];?></span><?php if($value['scompanyLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Prod. Company</span> <?php if($value['prodLink']!='') echo '<a href="'.$value['prodLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['prod'];?></span><?php if($value['prodLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Agency</span> <?php if($value['agencyLink']!='') echo '<a href="'.$value['agencyLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['agency'];?></span><?php if($value['agencyLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">D.O.P.</span> <?php if($value['dopLink']!='') echo '<a href="'.$value['dopLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['dop'];?></span><?php if($value['dopLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Location</span> <span class="gallery_info_name"><?php echo $value['location'];?></span><br>
        </div>
        <a href="<?php echo URL.'works';?>"><div class="back_arrow">Back to works</div></a>
    </div>
</div>
<div id="pics_r_side" class="pics_r_side">
    <div id="content" class="clearfix transitions-enabled" style="margin:auto;">
        <iframe src="http://player.vimeo.com/video/<?php echo $value['urlVideo'] ?>" width="<?php echo $value['wVideo'] ?>" height="<?php echo $value['hVideo'] ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </div>
</div>
 <div class="clr"></div>
</div>
