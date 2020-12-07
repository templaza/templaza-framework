<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

$options        = Functions::get_theme_options();

$topsidebar_layout  = isset($options['topsidebar-layout'])?$options['topsidebar-layout']:'wide';
$topsidebar_columns = isset($options['topsidebar-columns'])?(int) $options['topsidebar-columns']:2;
?>
<section class="templaza-section templaza-topsidebar-section">
    <div class="<?php echo $topsidebar_layout == 'wide'?'container-fluid':'container'; ?>">
        <div class="row">
            <?php if($topsidebar_columns){
                for($i = 1;$i <= $topsidebar_columns; $i++){
                    $topsidebar_col_opt     = isset($options['topsidebar-column-'.$i])?$options['topsidebar-column-'.$i]:array();
                    $topsidebar_col_type    = isset($topsidebar_col_opt['type'])?$topsidebar_col_opt['type']:'';
                    $topsidebar_col_width   = isset($topsidebar_col_opt['width'])?$topsidebar_col_opt['width']:1;
                    $topsidebar_col_class   = isset($topsidebar_col_opt['custom_class'])?$topsidebar_col_opt['custom_class']:'';
                    $topsidebar_col_sidebar = isset($topsidebar_col_opt['sidebar'])?$topsidebar_col_opt['sidebar']:'';
                ?>
                <div class="templaza-column col-lg-<?php echo $topsidebar_col_width; ?><?php
                echo $topsidebar_col_class?' '.$topsidebar_col_class:'';?>">
                    <?php
                    if($topsidebar_col_type && $topsidebar_col_type == 'sidebar') {
                        if(is_active_sidebar($topsidebar_col_sidebar)) {
                        ?>
                          <?php dynamic_sidebar($topsidebar_col_sidebar); ?>
                    <?php
                        }
                    }else{
                        Templates::load_my_layout('topsidebar.'.$topsidebar_col_type);
                    }
                    ?>
                </div>
            <?php }
            }?>
        </div>
    </div>
</section>
