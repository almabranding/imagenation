<?php
$id = $this->id;
?>
<script>
    $(document).ready(function() {
        uploadAvatar('/imagenation/uploads/<?php echo $id;?>/','<?php echo $id;?>');
        uploadImages('/imagenation/uploads/<?php echo $id;?>/images/','<?php echo $id;?>');
    });
</script>
<div class="white_box hide" id="newImage">
        <div id="uploadImages">
                <noscript>Please enable javascript to upload and crop images.</noscript>
        </div>
</div>
<?php foreach ($this->gallery as $k => $value) { ?>
    <div class="white_box hide img" id="hide_h<?php echo $value['id']; ?>">
        <h2 style="width:100%">Edit Picture</h2>
        <form action="" method="post"  enctype="multipart/form-data" >
            <p><label for="caption">Caption</label><input name="caption" id="caption" type="text" value="<?php echo $value['caption']; ?>"></p>
            <p><label for="urlVideo">Vimeo</label><input name="urlVideo" id="urlVideo" type="text" value="<?php echo $value['urlVideo']; ?>"></p>
            <p><label for="urlVideo">Video Height</label><input name="hVideo" id="urlVideo" type="text" value="<?php echo $value['hVideo']; ?>"></p>
            <p><label for="urlVideo">Video Width</label><input name="wVideo" id="urlVideo" type="text" value="<?php echo $value['wVideo']; ?>"></p>
            <p><label for="video">Video</label><input name="video" type="checkbox" <?php if ($value['video'] == 1) echo "checked='checked'" ?> value="1"></p>
            <input type="hidden" id="editImg" name="editImg" value="1"/>
            <input type="hidden" id="id" name="id" value="<?php echo $value['id']; ?>"/>

            <input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="$('.hide').css('display', 'none')"/>
        </form>
    </div>
<?php } ?>
<div class="project_form">
    <?php foreach ($this->project as $k => $value) { ?>
        <form action="<?php echo URL; ?>works/edit/<?php echo $id;?>" method="post" onsubmit="return checkCoords();" enctype="multipart/form-data" >
            <p><label for="name">Name</label><input name="name" id="name" type="text" value="<?php echo $value['name']; ?>"></p>
            <p class="video"><label for="urlVideo">Vimeo</label><input name="urlVideo" id="urlVideo" type="text" value="<?php echo $value['urlVideo']; ?>"></p>
            <p class="video"><label for="urlVideo">Video Height</label><input name="hVideo" id="urlVideo" type="text" value="<?php echo $value['hVideo']; ?>"></p>
            <p class="video"><label for="urlVideo">Video Width</label><input name="wVideo" id="urlVideo" type="text" value="<?php echo $value['wVideo']; ?>"></p>
            <p><label for="location">Location</label><input name="location" id="location" type="text" value="<?php echo $value['location']; ?>"></p>
            <p class="video"><label for="director">Director</label><input name="director" id="director" type="text" value="<?php echo $value['director']; ?>"></p>
            <p  class="video"><label for="directorLink"></label><input class="linkExt" name="directorLink" id="directorLink" type="text" value="<?php echo $value['directorLink']; ?>" placeholder="Link"></p>
            <p  class="foto"><label for="photographer">Photographer</label><input name="photographer" id="photographer" type="text" value="<?php echo $value['photo']; ?>"></p>
            <p  class="foto"><label for="photographerLink"></label><input class="linkExt" name="photoLink" id="photographerLink" type="text" value="<?php echo $value['photoLink']; ?>" placeholder="Link"></p>
            <p><label for="production">Prod. Company</label><input name="production" id="production" type="text" value="<?php echo $value['prod']; ?>"></p>
            <p><label for="production"></label><input class="linkExt" placeholder="Link" name="prodLink" id="prodLink" type="text" value="<?php echo $value['prodLink']; ?>"></p>
            <p class="video"><label for="scompany">Service Company</label><input  name="scompany" id="scompany" type="text" value="<?php echo $value['scompany']; ?>"></p>
            <p class="video"><label for="scompany"></label><input class="linkExt" placeholder="Link" name="scompanyLink" id="scompany" type="text" value="<?php echo $value['scompanyLink']; ?>"></p>
            <p><label for="agency">Agency</label><input name="agency" id="agency" type="text" value="<?php echo $value['agency']; ?>"></p>
            <p><label for="agency"></label><input class="linkExt" placeholder="Link" name="agencyLink" id="agencyLink" type="text" value="<?php echo $value['agencyLink']; ?>"></p>
            <p class="video"><label for="dop">D.O.P.</label><input name="dop" id="dop" type="text" value="<?php echo $value['dop']; ?>"></p>
            <p class="video"><label for="dop"></label><input class="linkExt" placeholder="Link" name="dopLink" id="dop" type="text" value="<?php echo $value['dopLink']; ?>"></p>
            <p><label for="video">Video</label><input id="video" type="checkbox" value="1" name="video" <?php if ($value['video'] == 1) echo 'checked="checked"' ?>><span style='font-size:9px;'> (If no pictures in this project)</span></p>
            <div class="field" style="clear:both; height: 40px;width: 100%;">
                <label class="file-upload">
                    <span><strong>Thumbnail</strong></span>
                    <input type="file" name="fileToUpload" />
                </label>
            </div>
            <input type="hidden" id="file" name="img" value="<?php echo $value['img']; ?>"/>
            <input type="hidden" id="file" name="avatar" value="<?php echo $value['avatar']; ?>"/>
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
            <input type="hidden" id="rel" name="rel" />
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y"  />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h"/>
            <label ></label><input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="document.location.href = 'works.php';"/>
        </form>
    <?php } ?>
</div>


<div id="uploadAvatar">
        <noscript>Please enable javascript to upload and crop images.</noscript>
</div>

			<div id="PhotoPrevs">
				<!-- The cropped images will be populated here -->
			</div>
<div id='targetUpload'>
<div id="preview-pane">
    <div class="preview-container">
        <img src="<?php echo UPLOAD_ABS . $id . '/' . $value['img']; ?>" class="preview jcrop-preview" id="preview" alt="Preview" />
        <img src="<?php echo UPLOAD_ABS . $id . '/' . $value['avatar']; ?>" class="avatar" id="avatar" alt="No preview selected" />
    </div>
</div>
<img src="<?php echo UPLOAD_ABS . $id . '/' . $value['img']; ?>" id="target" />
</div>

<ul id="sortable" class="ui-sortable" rel="cosa">     
    <?php foreach ($this->gallery as $k => $value) { ?>
        <li id="foo_<?php echo $value['id']; ?>" class="ui-state-default" onclick="">
            <img src="<?php echo UPLOAD_ABS . $value['project'] . '/images/' . $value['name']; ?>" caption="<?php echo $value['caption']; ?>">
            <form action="" method="post">
                <input type="hidden" id="delete" name="delete" value="1"/>
                <input id="h<?php echo $value['id']; ?>" class="btn editImg" type="button" style="margin:0;" onclick="" value="Edit">
                <input id="save" class="btn" type="submit" style="background: #bb0000;margin:0;" onclick="" value="Delete">
                <input type="hidden" id="id" name="id" value="<?php echo $value['id']; ?>"/>
                <input type="hidden" id="img" name="idImg" value="<?php echo $value['id']; ?>"/>
            </form>
        </li>
    <?php } ?>
</ul>
<div style="text-align: right;">
    <input type="button" id="save" value="Upload" onclick="showPop('newImage');" class="btn" />
</div>