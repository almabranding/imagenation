<?php 
$value=$this->selectBG[0];
$leyenda="";
$creditos=Array();
$creditos[]='client';
$creditos[]='job';
$creditos[]='agency';
$creditos[]='photographer';
foreach($creditos as $credit){
    if($value[$credit]){
        if($value[$credit.'Link']) $leyenda.='<a target="_blank" class="creditos" href="'.$value[$credit.'Link'].'">'.$credit.': '.$value[$credit].'</a>';
        else $leyenda.='<span class="creditos">'.$credit.': '.$value[$credit].'</span>';
        $leyenda.=' - ';
    }
}
$leyenda = substr($leyenda, 0, -3);
if($value['style']=='Light')$color='#ffffff';
elseif($value['style']=='Dark') $color='#9C9D9F';
elseif($value['style']=='Black') $color='#4c4c4c';
?>
        <link rel="stylesheet" type="text/css" href="<?php echo URL.'public/css/'.$value['style'].'.css';?>" media="screen" />
        <style>
            footer{
               opacity: 0;
            }
        </style>
        <script>
            if (screen.width <= 699) {
            document.location = "<?php echo URL.'works';?>";
            }

            
            $(document).ready(function() {
                Cufon.set('fontSize', '12px').set('color', '<?php echo $color;?>').replace('.logo p', { fontFamily: 'Gill Sans Std'}); 
                $("body").ezBgResize({
                        img     : "<?php echo URL.'uploads/background/'.$value['file'];?>", // Relative path example.  You could also use an absolute url (http://...).
                        opacity : 1, // Opacity. 1 = 100%.  This is optional.
                        center  : true // Boolean (true or false). This is optional. Default is true.
                });
            });
	</script>

             <div class="leyend">
                 <?php echo $leyenda;?>
             </div>
             <div class="clr"></div>   
    
  