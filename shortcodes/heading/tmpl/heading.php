<?php
defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
use TemPlazaFramework\Fonts;
use TemPlazaFramework\CSS;
use Advanced_Product\Helper\AP_Helper;
extract(shortcode_atts(array(
    'tz_id'                         => '',
    'tz_class'                      => '',
    'heading_tag'                   => 'h1',
    'custom_heading'                => '',
    'heading_custom_class'          => '',
    'heading_color'                 => '',
    'enable_heading_custom_font'     => false,
    'typography_heading_element'    => '',
    'heading_margin'                => '',
    'enable_custom_heading'         => false,
    'enable_heading_inner_tag'      => false,
    'enable_heading_single'         => false,
    'enable_heading_single_meta'    => false,
), $atts));

$title = '';
if ( is_category() ) {
    $title = single_cat_title( '', false );
} elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
} elseif ( is_author() ) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
} elseif ( is_post_type_archive() ) {
    if(is_post_type_archive( 'product' )){
        if(class_exists( 'woocommerce' )) {
            if ( is_shop() ) {
                $title =  woocommerce_page_title(false);
            }else{
                $title = post_type_archive_title( '', false);
            }
        }
    }elseif(is_post_type_archive( 'ap_product' )){
        if ( AP_Helper::is_inventory() ) {
            $inventory_page_id = AP_Helper::get_page_id('inventory');
            $title =  get_the_title($inventory_page_id);
            if($title==''){
                $title = post_type_archive_title( '', false);
            }
        }else{
            $title = post_type_archive_title( '', false);
        }
    }else{
        $title = post_type_archive_title( '', false);
    }
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
}elseif ( is_year() ) {
    $title  = get_the_date( _x( 'Y', 'yearly archives date format' ) );
    $prefix = _x( 'Year:', 'date archive title prefix' );
} elseif ( is_month() ) {
    $title  = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
    $prefix = _x( 'Month:', 'date archive title prefix' );
} elseif ( is_day() ) {
    $title  = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
    $prefix = _x( 'Day:', 'date archive title prefix' );
}
if(is_single()){
    $tz_class .=' heading-single';
}

$heading    = $enable_custom_heading?$custom_heading:($title);

//$inner_tag  = $enable_heading_inner_tag?'span':
if (is_single() && $enable_heading_single == false){
    return;
}
if(!empty($heading)){
    $heading    = $enable_heading_inner_tag?'<span>'.$heading.'</span>':$heading;
?>
<div<?php echo !empty($tz_id)?' id="'.esc_attr__($tz_id).'"':''; ?> class="<?php echo esc_attr__($tz_class); ?>">
    <<?php echo $heading_tag; ?><?php echo !empty($heading_custom_class)?' class="'
        .esc_attr__($heading_custom_class).'"':'';?>><?php echo $heading; ?></<?php echo $heading_tag; ?>>
    <?php
    if(is_single() && $enable_heading_single_meta == true){
        do_action('templaza_single_meta_post');
    }
    ?>
</div>
<?php
    $heading_color_css ='';
    if($heading_color){
        $heading_color = json_decode($heading_color,true);
        $heading_color = CSS::make_color_rgba_redux($heading_color);
        if($heading_color !=''){
            $heading_color_css .= '#'.$tz_id.'.templaza-heading *{color:'.$heading_color.'}';
            Templates::add_inline_style($heading_color_css);
        }
    }
    $typographies = array(
        array(
            'id'        => 'typography-heading-element',
            'enable'    => (isset($enable_heading_custom_font) && $enable_heading_custom_font =='1'?true:false),
            'class'     => array(
                'desktop' => '#'.$tz_id.' h1, #'.$tz_id.' h2,'
                    .'#'.$tz_id.' h3,#'.$tz_id.' h4,#'.$tz_id.' h5,'
                    .'#'.$tz_id.' h6',
                'tablet' => '#'.$tz_id.' h1, #'.$tz_id.' h2,'
                    .'#'.$tz_id.' h3,#'.$tz_id.' h4,#'.$tz_id.' h5,'
                    .'#'.$tz_id.' h6',
                'mobile' => '#'.$tz_id.' h1, #'.$tz_id.' h2,'
                    .'#'.$tz_id.' h3,#'.$tz_id.' h4,#'.$tz_id.' h5,'
                    .'#'.$tz_id.' h6',
            )
        )
    );
    $designs    = array(
        array(
            'id'        => 'heading_margin',
            'enable'    => true,
            'class'     => array(
                'desktop' => '#'.$tz_id.' h1, #'.$tz_id.' h2,'
                    .'#'.$tz_id.' h3,#'.$tz_id.' h4,#'.$tz_id.' h5,'
                    .'#'.$tz_id.' h6',
                'tablet' => '#'.$tz_id.' h1, #'.$tz_id.' h2,'
                    .'#'.$tz_id.' h3,#'.$tz_id.' h4,#'.$tz_id.' h5,'
                    .'#'.$tz_id.' h6',
                'mobile' => '#'.$tz_id.' h1, #'.$tz_id.' h2,'
                    .'#'.$tz_id.' h3,#'.$tz_id.' h4,#'.$tz_id.' h5,'
                    .'#'.$tz_id.' h6',
            )
        ),

    );

    // Get typographies
    $typographies   = apply_filters('templaza-framework/typography/list', $typographies);

    // Generate typography styles.
    if(count($typographies)) {
        foreach ($typographies as $typo) {
            $enable = isset($typo['enable']) ? (bool)$typo['enable'] : false;
            if ($enable) {
                if (is_array($typo['class'])) {
                    $devices = $typo['class'];
                } else {
                    $devices['desktop'] = $typo['class'];
                    $devices['tablet'] = $typo['class'];
                    $devices['mobile'] = $typo['class'];
                }

                $_styles = Fonts::make_css_style($typography_heading_element, $devices);

                if (count($_styles)) {
                    foreach ($_styles as $device => $style) {
                        Templates::add_inline_style($style, $device);
                    }
                }
            }
        }
    }

}

?>
