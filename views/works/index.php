
<div id="container" class="clearfix fluid gallery_projects masonry" style="position: relative; height: 2519px; width: 1680px;">
<?php foreach($this->projectList as $key=>$value){
    if($value['video']==1){?>
    <div class="gallery_box box">
        <div onclick="location.href='works/video/<?php echo $value['id'].'/'.urlencode($value['name']);?>'" style="position:relative"><div class="embedVideo"></div><img alt="<?php echo $value['name'];?>" src="uploads/<?php echo $value['id'].'/'.$value['avatar'];?>"></div><div class="gallery_box_info">
            <div class="pico_gallery"></div><span class="gallery_info_title"><?php echo $value['name'];?></span><br>
            <span class="gallery_info_tr">Director</span> <?php if($value['directorLink']!='') echo '<a href="'.$value['directorLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['director'];?></span><?php if($value['directorLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Service Company</span> <?php if($value['sCompanyLink']!='') echo '<a href="'.$value['sCompanyLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['scompany'];?></span><?php if($value['sCompanyLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Prod. Company</span> <?php if($value['prodLink']!='') echo '<a href="'.$value['prodLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['prod'];?></span><?php if($value['prodLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Agency</span> <?php if($value['agencyLink']!='') echo '<a href="'.$value['agencyLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['agency'];?></span><?php if($value['agencyLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">D.O.P.</span> <?php if($value['dopLink']!='') echo '<a href="'.$value['dopLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['dop'];?></span><?php if($value['dopLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Location</span> <span class="gallery_info_name"><?php echo $value['location'];?></span><br>
        </div>
    </div>
    <?php }else{?>
    <div class="gallery_box box">
        <div onclick="location.href='works/gallery/<?php echo $value['id'].'/'.urlencode($value['name']);?>'" style="position:relative"><img alt="<?php echo $value['name'];?>" src="uploads/<?php echo $value['id'].'/'.$value['avatar'];?>"></div><div class="gallery_box_info">
            <div class="pico_gallery"></div><span class="gallery_info_title"><?php echo $value['name'];?></span><br>
            <span class="gallery_info_tr">Photographer</span> <?php if($value['photoLink']!='') echo '<a href="'.$value['photoLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['photo'];?></span><?php if($value['photoLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Prod. Company</span> <?php if($value['prodLink']!='') echo '<a href="'.$value['prodLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['prod'];?></span><?php if($value['prodLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Agency</span> <?php if($value['agencyLink']!='') echo '<a href="'.$value['agencyLink'].'" target="_blank">';?><span class="gallery_info_name"><?php echo $value['agency'];?></span><?php if($value['agencyLink']!='') echo '</a>';?><br>
            <span class="gallery_info_tr">Location</span> <span class="gallery_info_name"><?php echo $value['location'];?></span><br>
        </div>
    </div>
<?php }
    }?>
</div>
<div class="footer top_arrow"><div class="back_arrow" style="float: right;">Top</div></div>
<div class="clr"></div>

        <script>
            $(window).load(function(){  
                imagenation();
            }); 
        </script>