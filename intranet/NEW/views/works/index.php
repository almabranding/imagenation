
  <div class="white_box hide" id="newProject">
        <h2 style="width:100%">Upload Work</h2>
                 <form name="form" action="<?php echo URL;?>works/create" method="POST" enctype="multipart/form-data">
                    <input name="form" id="name" type="hidden" value="insert">
                    <p><label for="name">Name</label><input name="name" id="name" type="text" value=""></p>
                    <p class="foto"><label for="photo">Photographer</label><input name="photo" id="photo" type="text" value=""></p>
                    <p><label for="prod">Prod. Company</label><input name="prod" id="prod" type="text" value=""></p>       
                    <p class="video"><label for="scompany">Service Company</label><input name="scompany" id="scompany" type="text" value=""></p>
                    <p class="video"><label for="director">Director</label><input name="director" id="director" type="text" value=""></p>
                    <p><label for="agency">Agency</label><input name="agency" id="agency" type="text" value=""></p>
                    <p><label for="location">Location</label><input name="location" id="location" type="text" value=""></p>
                    <p class="video"><label for="urlVideo">Vimeo</label><input name="urlVideo" id="urlVideo" type="text" value=""></p>
                    <p class="video"><label for="dop">D.O.P.</label><input name="dop" id="dop" type="text" value=""></p>
                    <p><label for="video">Video</label><input id="video" type="checkbox" value="1" name="video"></p>
                    <div class="field" style="clear:both; height: 40px;width: 100%;">
                        <label class="file-upload">
                            <span><strong>Thumbnail</strong></span>
                            <input type="file" name="fileToUpload" />
                        </label>
                    </div>
                    <div><label for="save"></label><input type="submit" id="save" value="Save" class="btn" /><input type="button" id="save" value="Cancel" class="btn" onclick="$('.hide').css('display','none')"/></div>
                </form>
   </div>
<?php $this->get('table');?>
    <div style="text-align: right;">
       <input type="button" id="save" value="Upload" onclick="showPop('newProject');" class="btn" />
    </div>
<script>
function showPop(id){
    $('#white_full').css('display','block');
    $('#'+id).css('display','block');    
}
</script>