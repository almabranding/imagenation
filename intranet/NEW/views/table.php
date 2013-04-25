
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table" class="tbl_order">  
    <?php
    foreach ($this->list as $k => $w) {
        $alternate = (($k % 2) == 0) ? 'alternate-row' : '';
        echo '<tr id="order_'.$w['id'].'" class="' . $alternate . '">';
        if ($k == 0) {
            foreach ($w as $k => $v) {
                $style = 'width:' . $v['width'];
                echo '<th class="table-header-repeat line-left minwidth-1" style="' . $style . '"><a href="">' . $v['title'] . '</a></th>';
            }
        } else {
            foreach ($w as $k => $v) {

                echo '<td>' . $v . '</td>';
            }
        }
        echo '</tr>';
    }
    ?>
</table>
