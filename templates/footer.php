<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Functions;
use TemPlazaFramework\Templates;
if ( !class_exists( 'TemPlazaFramework\TemPlazaFramework' )){
    $templaza_options = array();
}else{
    $templaza_options = Functions::get_theme_options();
}
$ap_quote       = isset($templaza_options['ap_product-quote'])?filter_var($templaza_options['ap_product-quote'], FILTER_VALIDATE_BOOLEAN):false;
$ap_quote_label          = isset($templaza_options['ap_product-quote-label'])?$templaza_options['ap_product-quote-label']:'';
$ap_quote_form          = isset($templaza_options['ap_product-quote-form'])?$templaza_options['ap_product-quote-form']:'';
$ap_quote_form_custom          = isset($templaza_options['ap_product-quote-form-custom'])?$templaza_options['ap_product-quote-form-custom']:'';
$ap_quote_form_url          = isset($templaza_options['ap_product-quote-custom-url'])?$templaza_options['ap_product-quote-custom-url']:'';
?>

            </div><!-- Wrapper -->
        </div><!-- Layout -->
    </div><!-- Content -->
    <?php Templates::load_my_header('backtotop'); ?>

</div><!-- Container -->

<?php
if($ap_quote){
    ?>
<div class="ap_product_quote  uk-position-fixed uk-position-center-right">

    <?php
    if($ap_quote_form =='custom_url'){
        if($ap_quote_form_url !=''){
            ?>
            <a href="<?php echo esc_url($ap_quote_form_url);?>" target="_blank" class="templaza-btn"><?php echo esc_html($ap_quote_label);?></a>
            <?php
        }
    }else{
        ?>
        <a class="templaza-btn" href="#modal-quote" data-uk-toggle>
            <?php echo esc_html($ap_quote_label);?>
        </a>

        <div id="modal-quote" class="uk-flex-top ap-modal" data-uk-modal>
            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                <button class="uk-modal-close-default" type="button" data-uk-close></button>
                <div class="get-price">
                    <?php
                    if($ap_quote_form == 'custom'){
                        echo do_shortcode($ap_quote_form_custom);
                    }else{
                        ?>
                        <h2 class="uk-modal-title"><?php echo esc_html(get_the_title($ap_quote_form)); ?></h2>
                        <?php
                        if(function_exists('wpforms')) {
                            echo do_shortcode('[wpforms id="' . $ap_quote_form . '"]');
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<?php
}
?>