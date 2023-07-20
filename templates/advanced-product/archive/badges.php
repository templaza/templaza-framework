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
$show_badges   = isset($templaza_options['ap_product-badges'])?filter_var($templaza_options['ap_product-badges'], FILTER_VALIDATE_BOOLEAN):true;
$thumbnail       = isset($templaza_options['ap_product-thumbnail-size'])?$templaza_options['ap_product-thumbnail-size']:'large';
$sale_label       = isset($templaza_options['ap_product-sale-label'])?$templaza_options['ap_product-sale-label']:'';
$rent_label       = isset($templaza_options['ap_product-rent-label'])?$templaza_options['ap_product-rent-label']:'';
$sold_label       = isset($templaza_options['ap_product-sold-label'])?$templaza_options['ap_product-sold-label']:'';
$contact_label       = isset($templaza_options['ap_product-contact-label'])?$templaza_options['ap_product-contact-label']:'';
$rent_sale       = isset($templaza_options['ap_product-sale-rent-label'])?$templaza_options['ap_product-sale-rent-label']:'';
$product_type   = get_field('ap_product_type', get_the_ID());
$label = $cl = '';
if($show_badges && is_array($product_type)){
    if(count($product_type) == 2){
        $label = $rent_sale;
        $cl = 'sale-rent';
    }else{
        if(in_array('sale', $product_type)){
            $label = $sale_label;
            $cl = 'sale';
        }elseif(in_array('rental', $product_type)){
            $label = $rent_label;
            $cl = 'rental';
        }elseif(in_array('sold', $product_type)){
            $label = $sold_label;
            $cl = 'sold';
        }elseif(in_array('contact', $product_type)){
            $label = $contact_label;
            $cl = 'contact';
        }else{
            $label = __('All','templaza-framework');
            $cl = 'sale-rent';
        }
    }

    ?>
    <div class="ap-ribbon <?php echo esc_attr($cl);?>">
    <span class="ap-ribbon-content">
        <?php
        echo esc_html($label);
        ?>
    </span>
    </div>
<?php
}