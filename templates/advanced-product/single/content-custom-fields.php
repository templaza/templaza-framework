<?php

defined('ADVANCED_PRODUCT') or exit();

use Advanced_Product\AP_Functions;
use Advanced_Product\Helper\FieldHelper;
use Advanced_Product\Helper\AP_Custom_Field_Helper;
use Advanced_Product\Helper\AP_Custom_Taxonomy_Helper;

$options    = array();

$widget_heading_style       = isset($options['widget_box_heading_style'])?$options['widget_box_heading_style']:'';

?>
<div class="widget <?php echo esc_attr($widget_heading_style);?> ap-box ap-single-side-box ap-specs">
    <div class="widget-content">
        <h3 class="widget-title is-style-templaza-heading-style1"><span><?php esc_html_e('Specifications', 'baressco'); ?></span>
        </h3>
        <div class="ap-specs">
            <div class="uk-grid-small" data-uk-grid>
                <label class="uk-width-2-5"><?php esc_html_e('Branch', 'baressco'); ?></label>
                <span class=" uk-width-expand">
                        <?php
                        $branches = wp_get_post_terms(get_the_ID(), 'ap_branch');
                        foreach ($branches as $branch) {
                            $ve_make = $branch->slug;
                            echo esc_attr($branch->name);
                        }
                        ?>
                </span>
            </div>
            <div class="uk-grid-small" data-uk-grid>
                <label class="uk-width-2-5"><?php esc_html_e('Category', 'baressco'); ?></label>
                <span class=" uk-width-expand">
                        <?php $categories = wp_get_post_terms(get_the_ID(), 'ap_category');
                        foreach ($categories as $category) {
                            echo esc_attr($category->name);
                        }
                        ?>
                    </span>
            </div>
                <?php
                $custom_categories  = AP_Custom_Taxonomy_Helper::get_taxonomies();
                if($custom_categories){
                    foreach($custom_categories as $custom_category){
                        $slug   = get_field('slug', $custom_category -> ID);

                        $term   = get_term(get_field($slug, get_the_ID()), $slug);
                        if($term && isset($term -> name)) {
                            ?>
                            <div class="uk-grid-small" data-uk-grid>
                                <label class="uk-width-2-5"><?php echo esc_html($custom_category->post_title); ?></label>
                                <span class="uk-width-expand">
                                <?php
                                echo esc_html($term->name);
                                ?>
                            </span>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
        <?php
        // Display custom field in specifications

        $fields = FieldHelper::get_fields_by_group('specs', array('post_type' => get_post_type()));
        if($fields && count($fields)){
        ?>
        <?php
            foreach($fields as $field){
                $value = get_field($field['name'], get_the_ID());
                if (!$value) {
                    continue;
                }
                ?>
                <div class="uk-grid-small" data-uk-grid>
                    <label class="uk-width-2-5"><?php echo esc_html($field['label']); ?></label>
                    <span class="<?php echo esc_attr($field['name']);?> uk-width-expand"><?php echo esc_html(the_field($field['name'], get_the_ID())); ?></span>
                </div>
        <?php } ?>
        <?php
        }
        ?>
        </div>
    </div>
</div>
