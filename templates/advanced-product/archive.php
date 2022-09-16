<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\AP_Templates;
use Advanced_Product\Helper\AP_Helper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
if(isset($_GET['columns'])){
    $ap_col = $ap_col_large = $ap_col_laptop = $_GET['columns'];
}else{
    $ap_col_laptop       = isset($templaza_options['ap_product-column-laptop'])?$templaza_options['ap_product-column-laptop']:3;
    $ap_col_large        = isset($templaza_options['ap_product-column-large'])?$templaza_options['ap_product-column-large']:3;
    $ap_col              = isset($templaza_options['ap_product-column'])?$templaza_options['ap_product-column']:3;
}
$ap_layout           = isset($templaza_options['ap_product-layout'])?$templaza_options['ap_product-layout']:'grid';
$ap_col_tablet       = isset($templaza_options['ap_product-column-tablet'])?$templaza_options['ap_product-column-tablet']:2;
$ap_col_mobile       = isset($templaza_options['ap_product-column-mobile'])?$templaza_options['ap_product-column-mobile']:1;
$ap_col_gap          = isset($templaza_options['ap_product-column-gap'])?$templaza_options['ap_product-column-gap']:'';
if($ap_layout == 'masonry'){
    $grid_option = 'masonry: true';
}else{
    $grid_option = '';
}
?>

<?php
if ( have_posts()) {
    ?>
<div class="templaza-ap-archive
  uk-child-width-1-<?php echo esc_attr($ap_col);?>@l
  uk-child-width-1-<?php echo esc_attr($ap_col_large);?>@xl
  uk-child-width-1-<?php echo esc_attr($ap_col_laptop);?>@m
  uk-child-width-1-<?php echo esc_attr($ap_col_tablet);?>@s
  uk-child-width-1-<?php echo esc_attr($ap_col_mobile);?>
  uk-grid-<?php echo esc_attr($ap_col_gap);?>
 " data-uk-grid="<?php echo esc_attr($grid_option);?>">
    <?php
    AP_Templates::load_my_layout('archive.content');
    ?>
</div>
<div class="templaza-blog-pagenavi uk-margin-large-top">
    <?php
    do_action('templaza_pagination');
    ?>
</div>
<?php
}
?>