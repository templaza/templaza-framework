<?php

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Helpers\HelperLicense;

$themes = $this -> getThemes();

?>
<div class="tzinst-theme-install<?php echo !HelperLicense::is_authorised($this -> theme_name)?' no-license':''?>">
    <div class="uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-3@l uk-grid-match" data-uk-grid>
        <?php
        if(!empty($themes)){
            foreach($themes as $item){

                $is_update  = false;
                ?>
        <div class="item">
            <div class="item-inner uk-card uk-card-default uk-card-small uk-border-rounded uk-overflow-hidden uk-flex uk-flex-column">
                <?php if(!empty($item['thumbnail'])){?>
                <div class="uk-card-media-top">
                    <img src="<?php echo esc_url($item['thumbnail']);?>" alt="<?php echo esc_attr($item['title']);?>" class="uk-width-1-1"/>
                </div>
                <?php } ?>
                <div class="uk-card-body uk-height-1-1">
                    <h3 class="uk-card-title"><?php echo esc_html($item['title']); ?>
                        <?php
                        if(isset($item['name']) && !empty($item['name'])) {
                            $theme = wp_get_theme($item['name']);
                            if($theme -> exists()){
                                $is_update  = version_compare($theme -> get('Version'), $item['version'], '<');
                                ?>
                                <div class="uk-card-badge uk-label  uk-position-relative uk-position-top-left uk-text-normal uk-text-capitalize"><?php
                                    /* translators: %s - Installed. */
                                    echo sprintf(esc_html__('Installed Version: %s', 'templaza-framework'),esc_html($theme -> get('Version')));
                                    ?></div>
                            <?php }
                        } ?></h3>
                    <?php if(isset($item['desc']) && !empty($item['desc'])){ ?>
                    <p><?php echo esc_html($item['desc']); ?></p>
                    <?php } ?>
                </div>

                <div class="action uk-padding-small uk-padding-remove-top uk-flex uk-flex-wrap">
                    <button class="uk-button<?php echo esc_attr($is_update)?' uk-button-warning':' uk-button-primary'; ?> uk-margin-small-bottom uk-width-1-1" data-theme-pack="<?php
                    echo esc_attr($item['code']);?>" data-theme-title="<?php echo esc_attr($item['title']);
                    ?>" data-theme-pack-type="<?php echo esc_attr($item['ext_code']); ?>" data-install-theme><?php
                        if($is_update){
                            echo '<span data-uk-icon="icon: refresh; ratio: 0.8"></span>';
                            esc_html_e('Update Theme', 'templaza-framework');
                        }else{
                            esc_html_e('Install Theme', 'templaza-framework');
                        } ?></button>
                    <div class="uk-button-group uk-width-1-1">
                        <?php if(!empty($item['demo_url'])){ ?>
                        <a class="uk-button uk-button-default uk-margin-small-bottom uk-width-1-1" href="<?php
                        echo esc_url($item['demo_url']); ?>"><?php esc_html_e('View Demo', 'templaza-framework'); ?></a>
                        <?php } ?>
                        <?php if(!empty($item['doc_url'])){ ?>
                        <a class="uk-button uk-button-default uk-margin-small-bottom uk-width-1-1" href="<?php
                        echo esc_url($item['doc_url']) ?>"><?php esc_html_e('Document', 'templaza-framework'); ?></a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
        <?php }
        } ?>

    </div>

    <div class="tzinst-preloader uk-overlay-primary uk-position-cover" style="display: none;">
        <div class="uk-position-center">
            <span data-uk-spinner="ratio: 2"></span>
        </div>
    </div>
</div>
