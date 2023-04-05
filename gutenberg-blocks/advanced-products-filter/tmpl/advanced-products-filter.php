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
$max_height         = (isset($attributes['max_height']))?$attributes['max_height']:'';
$column             = (isset($attributes['column']))?$attributes['column']:1;
$column_large       = (isset($attributes['column_large']))?$attributes['column_large']:1;
$column_laptop      = (isset($attributes['column_laptop']))?$attributes['column_laptop']:1;
$column_tablet      = (isset($attributes['column_tablet']))?$attributes['column_tablet']:1;
$column_mobile      = (isset($attributes['column_mobile']))?$attributes['column_mobile']:1;
$instant            = (isset($attributes['instant']))?$attributes['instant']:false;
$update_url         = (isset($attributes['update_url']))?$attributes['update_url']:true;
$enable_ajax        = (isset($attributes['enable_ajax']))?$attributes['enable_ajax']:true;
$enable_keyword     = (isset($attributes['enable_keyword']))?$attributes['enable_keyword']:false;
$limit_height     = (isset($attributes['limit_height']))?$attributes['limit_height']:false;
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

$shortcode .= ' enable_ajax="'.($enable_ajax?1:0).'"';
$shortcode .= ' instant="'.($instant?1:0).'"';
$shortcode .= ' update_url="'.($update_url?1:0).'"';
$shortcode .= ' column="'.($column?$column:1).'"';
$shortcode .= ' column_large="'.($column_large?$column_large:1).'"';
$shortcode .= ' column_laptop="'.($column_laptop?$column_laptop:1).'"';
$shortcode .= ' column_tablet="'.($column_tablet?$column_tablet:1).'"';
$shortcode .= ' column_mobile="'.($column_mobile?$column_mobile:1).'"';
if(!empty($max_height)) {
    $shortcode .= ' max_height="' . ($max_height ? $max_height : "") . '"';
}
$shortcode .= ' limit_height="'.($limit_height?1:0).'"';
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
