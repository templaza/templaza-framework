<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;

extract(shortcode_atts(array(
    'tz_id'                    => '',
    'tz_class'                 => '',
    'heading_tag'              => 'h1',
    'custom_heading'           => '',
    'heading_custom_class'     => '',
    'enable_custom_heading'    => false,
    'enable_heading_inner_tag' => false,
), $atts));

$options            = Functions::get_theme_options();
$title = '';
if ( is_category() ) {
    $title = single_cat_title( '', false );
} elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
} elseif ( is_author() ) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
} elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
} elseif ( is_tax() ) {
    $title = single_term_title( '', false );
} elseif ( is_home() ) {
    $title = single_post_title( '', false );
} elseif ( is_page() ) {
    $title = single_post_title( '', false );
} elseif ( is_404() ) {
    $title = __('Not Found','templaza-framework');
} elseif ( is_search() ) {
    $title = __('Search Results','templaza-framework');
}elseif ( is_single() ) {
    $title = single_post_title( '', false );
}

$heading    = $enable_custom_heading?$custom_heading:($title);

//$inner_tag  = $enable_heading_inner_tag?'span':

if(!empty($heading)){
    $heading    = $enable_heading_inner_tag?'<span>'.$heading.'</span>':$heading;
?>
<div<?php echo !empty($tz_id)?' id="'.esc_attr__($tz_id).'"':''; ?> class="<?php echo esc_attr__($tz_class); ?>">
    <<?php echo $heading_tag; ?><?php echo !empty($heading_custom_class)?' class="'
        .esc_attr__($heading_custom_class).'"':'';?>><?php echo $heading; ?></<?php echo $heading_tag; ?>>
</div>
<?php
}
?>
