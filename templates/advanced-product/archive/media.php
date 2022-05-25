<?php
defined('ADVANCED_PRODUCT') or exit();
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $agruco_options = array();
}else{
    $agruco_options            = Functions::get_theme_options();
}
$thumbnail       = isset($agruco_options['ap_product-thumbnail-size'])?$agruco_options['ap_product-thumbnail-size']:'large';

if(!empty($thumbnail)){
    ?>
    <div class="uk-card-media-top">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail($thumbnail);?>
        </a>
    </div>
<?php } ?>