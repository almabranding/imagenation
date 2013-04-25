<div class="white_box hide" id="edit">
    <?php $this->form->render(); ?>
</div>
<div>
    <table>
   <?php 
   foreach($this->client as $k=>$v){
       echo '<tr><th>'.$k.'</th><td>'.$v.'</td></tr>';
   }
   ?>
    </table>
</div>
<div style="text-align: right;">
   <input type="button" id="save" value="Upload" onclick="showPop('edit');" class="btn" />
</div>