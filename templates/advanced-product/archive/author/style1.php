<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Helper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use TemPlazaFramework\Functions;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$post_id =  get_the_ID();
$author_id = get_post_field ('post_author', $post_id);
$url='http://sss';

?>
<div class="ap-author-block uk-grid-collapse uk-flex-middle ap-author-style1" data-uk-grid>
    <div class="ap-author-img-box">
        <a href="<?php echo esc_url($url);?>">
        <img class="uk-width-small" width="40" height="40" src="<?php echo esc_url( get_avatar_url( $author_id,300));?>" alt="<?php echo get_the_author_meta( 'display_name' , $author_id );?>">
        </a>
    </div>
    <div class="uk-width-expand ap-author-info">
        <h4 class="ap-author-name uk-margin-remove-bottom">
            <a href="<?php echo esc_url($url);?>">
            <?php echo get_the_author_meta( 'display_name' , $author_id );?>
            </a>
        </h4>
        <p class="uk-text-meta uk-margin-remove-top">

        </p>
    </div>
</div>
