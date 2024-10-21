<?php
/* Base importer layout */

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Admin\Admin_Page_Function;

if(!isset($this -> item['plugins'])){
    $this -> item['plugins']    = array();
}

if(isset($this -> item) && isset($this -> item['plugins']) && count($this -> item['plugins'])){
    ?>
    <?php $uniqid  = uniqid();?>
    <div class="border-bottom border-gray uk-margin-top uk-margin-bottom uk-padding-small uk-padding-remove-horizontal tzinst-plugin__install">
        <h5 class="mb-3"><?php echo esc_html__('The following plugins are required to import content:', 'templaza-framework'); ?></h5>
        <?php if($this -> item['plugins'] && count($this -> item['plugins'])){?>
            <div class="uk-grid-small" data-uk-grid>
                <div class="uk-width-expand uk-text-muted" uk-leader="fill: .">
                    <label class="uk-text-secondary"><input class="uk-checkbox" type="checkbox" data-checkbox-plugin-all> <?php echo esc_html__("All Plugins","templaza-framework"); ?></label>
                </div>
                <div class="tzinst-plugin__actions">
                    <a href="javascript:" class="js-tzinst-plugin__install-all text-danger uk-hidden"><?php
                        echo esc_html__('Install Selected', 'templaza-framework'); ?></a>
                    <a href="javascript:" class="js-tzinst-plugin__update-all text-info uk-hidden"><?php
                        echo esc_html__('Update Selected', 'templaza-framework'); ?></a>
                    <a href="javascript:" class="js-tzinst-plugin__activate-all text-primary uk-hidden"><?php
                        echo esc_html__('Activate Selected', 'templaza-framework'); ?></a>
                </div>
            </div>
            <div class="items uk-padding-small uk-padding-remove-horizontal uk-overflow-auto uk-height-max-medium">
                <?php

                foreach($this -> item['plugins'] as $plugin_code => $plugin){
                    $plugin_slug        = isset($plugin['slug'])?$plugin['slug']:$plugin_code;
                    $installedVersion   = Admin_Page_Function::get_plugin_version_by_slug($plugin_slug);
                    $canUpdate          = $installedVersion && isset($plugin['version']) && $plugin['version'] && version_compare($plugin['version'], $installedVersion, '>');
                    $disabled           = (Admin_Page_Function::is_plugin_active($plugin_slug) && !$canUpdate)?' disabled':'';
                    $disabled_text      = !empty($disabled)?' uk-text-muted':'';
                    ?>
                    <div class="uk-grid-small uk-text-small" data-plugin-item uk-grid>
                        <div class="uk-width-expand uk-text-muted uk-text-small" uk-leader="fill: .">
                            <label class="<?php echo !empty($disabled_text)?esc_attr($disabled_text):'uk-text-secondary';?>"><input class="uk-checkbox" type="checkbox"<?php
                                echo esc_attr($disabled); ?>> <?php echo esc_html($plugin['name']); ?></label>
                            <?php
                            if($canUpdate){
                                ?>
                                <span class="uk-label uk-label-danger uk-text-small uk-text-capitalize"><?php echo esc_html__('New version', 'templaza-framework'); ?></span>
                            <?php } ?>
                        </div>
                        <div>
                            <?php
                            $btnText        = 'Install';
                            $btnClass       = ' uk-text-danger install';
                            if($canUpdate){
                                $btnText    = 'Update';
                                $btnClass   = ' uk-text-warning update';
                            }else{
                                if(Admin_Page_Function::is_plugin_active($plugin_slug)){
                                    $btnText    = 'Activated';
                                    $btnClass   = ' uk-text-success activated';
                                }elseif(Admin_Page_Function::is_plugin_installed($plugin_slug)){
                                    $btnText    = 'Activate';
                                    $btnClass   = ' uk-text-primary activate';
                                }
                            }
                            ?>
                            <a href="javascript:"
                                <?php echo esc_attr($disabled);?>
                               class="js-tzinst-plugin__install<?php echo esc_attr($btnClass);?>"
                               data-plugin="<?php echo esc_attr($plugin_slug); ?>"
                               data-nonce="<?php echo esc_attr(wp_create_nonce(TEMPLAZA_FRAMEWORK_NAME.'-action')); ?>"
                               data-plugin_name="<?php echo esc_attr($plugin['name']);?>"
                               data-tgmpa_nonce="<?php echo esc_attr( wp_create_nonce( 'tgmpa-install' ) ); ?>"
                               data-tgmpa-update_nonce="<?php echo esc_attr( wp_create_nonce( 'tgmpa-update' ) ); ?>"
                               data-tgmpa-activate_nonce="<?php echo esc_attr( wp_create_nonce( 'tgmpa-activate' ) ); ?>"><?php
                                echo esc_html($btnText); ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
