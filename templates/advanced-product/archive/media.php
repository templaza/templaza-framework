<?php
defined('ADVANCED_PRODUCT') or exit();
use Advanced_Product\AP_Templates;
use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Product_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options            = Functions::get_theme_options();
}
$thumbnail       = isset($templaza_options['ap_product-thumbnail-size'])?$templaza_options['ap_product-thumbnail-size']:'large';
$compare_layout  = isset($args['compare_layout'])?$args['compare_layout']:'';

if(isset($_GET['product_loop'])){
    $ap_loop_layout = $_GET['product_loop'];
}elseif($compare_layout !='') {
    $ap_loop_layout = $compare_layout;
}else{
    $ap_loop_layout = isset($templaza_options['ap_product-loop-layout']) ? $templaza_options['ap_product-loop-layout'] : 'style1';
}
?>
<div class="uk-card-media-top uk-position-relative uk-transition-toggle">
    <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail($thumbnail);?>
    </a>
    <?php
    if($ap_loop_layout !='style3'){
        AP_Templates::load_my_layout('archive.btn-actions');
    }
    ?>
</div>