
  <div class="white_box hide" id="newProject">
        <h2 style="width:100%">Upload project</h2>
        <?php
            $this->form->render();
        ?>
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