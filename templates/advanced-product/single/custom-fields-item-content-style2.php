<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\AP_Custom_Field_Helper;

$field  = isset($args['field'])?$args['field']:'';
$show_icon  = get_field('ap_show_single_custom_field_icon', 'option');
if (!empty($field) && ($acf_f = AP_Custom_Field_Helper::get_custom_field_option_by_id($field -> ID, array('exclude_core_field' => false)))) {

    $product_id  = isset($args['product_id'])?$args['product_id']:'';
    $f_value    = get_field($acf_f['name'], $product_id);
    $f_icon     = isset($acf_f['icon'])?$acf_f['icon']:'';
    $f_icon_image   = isset($acf_f['icon_image']) && !empty($acf_f['icon_image'])?$acf_f['icon_image']:'';
    if(!empty($f_value)){
        if($acf_f['type'] =='true_false'){
        ?>
            <div class="uk-width-1-2 uk-width-1-4@s">
                <div class="ap-single-field-content">
                    <?php
                    if( !empty($f_icon)){
                        if($f_icon['type'] == 'uikit-icon'){
                            ?>
                            <i data-uk-icon="icon:<?php echo esc_attr($f_icon['icon']); ?>;"></i>
                            <?php
                        }else if((empty($f_icon['type']) || empty($f_icon['icon'])) && !empty($f_icon_image)){
                            echo wp_get_attachment_image($f_icon_image, 'thumbnail', '',
                                array('data-uk-svg' => ''));
                        }else{
                            ?>
                            <i class="<?php echo esc_attr($f_icon['icon']); ?>"></i>
                            <?php
                        }
                    }
                    echo esc_html($acf_f['label']); ?>
                </div>
            </div>
        <?php
        }elseif($acf_f['type']=='wysiwyg'){
            ?>
            <div class="uk-width-1-1 ap-content-full">
                <?php echo get_field($acf_f['name'], $product_id,false); ?>
            </div>
            <?php
        }elseif($acf_f['type']=='gallery'){
            ?>
            <div class="uk-width-1-1">
                <div class="ap-content-gallery uk-child-width-1-3@s uk-child-width-1-2 uk-grid uk-grid-small" data-uk-grid data-uk-lightbox="animation: scale">
                    <?php
                    foreach ($f_value as $image) {
                        ?>
                        <div class="uk-transition-toggle uk-inline-clip uk-text-center">
                            <a  class="uk-width-1-1 ap-gallery-item uk-cover-container uk-inline uk-position-relative" href="<?php echo esc_url($image['url']); ?>" data-caption="<?php echo esc_attr($image['caption']); ?>">
                                <img data-uk-cover src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
                                <?php if($image['caption']){?>
                                <span class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-primary uk-padding-small">
                                    <?php echo esc_attr($image['caption']); ?>
                                </span>
                                <?php } ?>
                            </a>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class=" uk-width-1-4@l  uk-width-1-3@m  uk-width-1-2 ">
                <div class="uk-flex uk-flex-middle">
                    <div class=" uk-width-auto ap-field-icon">
                        <?php
                        if( !empty(array_filter($f_icon)) || !empty($f_icon_image)){
                            ?>
                            <span>
                                <?php
                                if($f_icon['type'] == 'uikit-icon'){
                                    ?>
                                    <i data-uk-icon="icon:<?php echo esc_attr($f_icon['icon']); ?>;"></i>
                                    <?php
                                }elseif((empty($f_icon['type']) || empty($f_icon['icon'])) && !empty($f_icon_image)){
                                    echo wp_get_attachment_image($f_icon_image, 'thumbnail', '',
                                        array('data-uk-svg' => ''));
                                }elseif(!empty($f_icon['icon'])){
                                    ?>
                                    <i class="<?php echo esc_attr($f_icon['icon']); ?>"></i>
                                    <?php
                                }
                                ?>
                                </span>
                            <?php
                        }
                        if($acf_f['type'] =='ap_icon'){
                            if( !empty(array_filter($f_value))){
                                ?>
                                <span>
                                    <?php
                                    if($f_value['type']=='uikit-icon'){
                                        ?>
                                        <i data-uk-icon="icon:<?php echo esc_attr($f_value['icon']); ?>;"></i>
                                        <?php
                                    }else{
                                        ?>
                                        <i class="<?php echo esc_attr($f_value['icon']); ?>"></i>
                                        <?php
                                    }
                                    ?>

                                </span>
                                <?php
                            }
                        }
                        if($acf_f['type'] =='image'){
                            if( is_array($f_value) && !empty(array_filter($f_value))){
                                ?>
                                <span>
                                <?php
                                if($f_value['url']){
                                    ?>
                                    <img src="<?php echo esc_url($f_value['url']); ?>"/>
                                    <?php
                                }
                                ?>
                            </span>
                                <?php
                            }elseif(filter_var($f_value, FILTER_VALIDATE_URL)){
                                ?>
                                <span>
                                    <img src="<?php echo esc_url($f_value); ?>"/>
                                </span>
                                <?php
                            }else{
                                ?>
                                <span>
                                    <img src="<?php echo esc_url(wp_get_attachment_url( $f_value )); ?>"/>
                                </span>
                                    <?php
                            }
                        }

                        ?>
                    </div>
                    <div class=" uk-width-expand uk-text-left field-value">
                        <div class="ap-field-label"><?php echo esc_html($acf_f['label']);?></div>
                        <div class="ap-field-value">
                        <?php
                        if($acf_f['type'] == 'file'){
                            $file_url   = '';
                            if(is_array($f_value)){
                                $file_url   = $f_value['url'];
                            }elseif(is_numeric($f_value)){
                                $file_url   = wp_get_attachment_url($f_value);
                            }else{
                                $file_url   = $f_value;
                            }
                            ?>
                            <a href="<?php echo esc_url($file_url); ?>" download><?php
                                echo esc_html__('Download', 'templaza-framework')?></a>
                            <?php
                        }elseif($acf_f['type'] == 'taxonomy'){
                            $term_arr = get_field($acf_f['name'], $product_id);
                            if(!empty($term_arr) && is_array($term_arr)){
                                foreach ($term_arr as $term_id){
                                    $term = get_term( $term_id, $acf_f['taxonomy'] );
                                    if($term){
                                        $term_link_t = get_term_link( $term_id, $acf_f['taxonomy'] );
                                        if ( ! is_wp_error( $term_link_t ) ) {
                                            ?>
                                            <a href="<?php echo esc_url($term_link_t);?>"><?php echo esc_html($term->name);?></a>
                                            <?php
                                        }
                                    }
                                }
                            }

                        }elseif($acf_f['type'] == 'date_picker'){
                            $date_val = date_create(get_field($acf_f['name'], $product_id));
                            if($acf_f['display_format']){
                                $unixtimestamp = strtotime( get_field( $acf_f['name'] ) );
                                echo date_i18n( $acf_f['display_format'], $unixtimestamp );
                            }else{
                                $unixtimestamp = strtotime( get_field( $acf_f['name'] ) );
                                echo date_i18n( get_option('date_format'), $unixtimestamp );
                            }
                        }elseif($acf_f['type'] == 'ap_icon' || $acf_f['type'] == 'image'){

                        }else{
                            ?><?php echo esc_html(the_field($acf_f['name'], $product_id)); ?>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} ?>