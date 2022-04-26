<?php

defined( 'ABSPATH' ) || exit;

//var_dump($attributes);

//$submit_text        = '';
$submit_icon        = '';
$submit_icon_pos    = '';
$title              = (isset($attributes['title']) && !empty($attributes['title']))?$attributes['title']:'';
$title_tag          = (isset($attributes['title_tag']) && !empty($attributes['title_tag']))?$attributes['title_tag']:'h3';
$title_display      = (isset($attributes['title_display']) && !empty($attributes['title_display']))?$attributes['title_display']:'uk-display-block';
$submit_text        = (isset($attributes['submit_text']) && !empty($attributes['submit_text']))?$attributes['submit_text']:esc_html__('Search', 'templaza-framework');
$enable_keyword     = (isset($attributes['enable_keyword']) && !empty($attributes['enable_keyword']))?$attributes['enable_keyword']:false;
$fields_include     = (isset($attributes['ap_custom_fields']) && !empty($attributes['ap_custom_fields']))?$attributes['ap_custom_fields']:'';
$shortcode          = '';
$shortcode          = '[advanced-product-form';
if(!empty($fields_include) && count($fields_include)) {
    $shortcode .= ' include="'.implode(',', $fields_include).'"';
}else{
    $shortcode .= ' include=""';
}
if(!empty($submit_text)){
    $shortcode  .= ' submit_text="'.$submit_text.'"';
}
if(!empty($submit_icon)){
    if ($submit_icon['library'] == 'svg'){
        $shortcode  .= ' submit_icon="'.$submit_icon['value']['url'].'"';
    }else{
        $shortcode  .= ' submit_icon="'.$submit_icon['value'].'"';
    }
}
if(!empty($submit_icon_pos)){
    $shortcode  .= ' submit_icon_position="'.$submit_icon_pos.'"';
}
$shortcode .= ' enable_keyword="'.($enable_keyword?1:0).'"]';
?>
<div class="templaza-framework-gutenberg-adv-product-filters">
    <?php
//    if($title){
//        echo '<'.esc_html($title_tag).' class="inventory-title-search '.esc_html($title_display).'"> '.esc_html($title).'</'.esc_html($title_tag).'>';
//    }
    ?>
    <?php echo do_shortcode($shortcode); ?>
</div>