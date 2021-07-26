<?php
/* Base importer layout */

use TemPlazaFramework\Admin\Admin_Page_Function;

if(!isset($this -> item['plugins'])){
    $this -> item['plugins']    = array();
}

if(isset($this -> item) && isset($this -> item['plugins']) && count($this -> item['plugins'])){
?>
    <?php $uniqid  = uniqid();?>
    <div class="border-bottom border-gray mt-3 mb-4 ml-n3 mr-n3 pl-3 pr-4 pb-3 tzinst-plugin__install">
        <h5 class="mb-3"><?php echo __('The following plugins are required to import content:', $this -> text_domain); ?></h5>
        <?php if($this -> item['plugins'] && count($this -> item['plugins'])){?>
            <div class="d-flex justify-content-between align-items-end w-100 pl-2 small text-muted item">
                <div class="w-100 flex-1 title">
                    <div class="custom-control custom-checkbox d-inline-block bg-white">
                        <input type="checkbox" class="custom-control-input" id="tzinst-checkbox__plugin-<?php
                        echo $uniqid;?>" data-checkbox-plugin-all>
                        <label class="position-relative custom-control-label" for="tzinst-checkbox__plugin-<?php echo $uniqid;?>"><?php echo __("All Plugins"); ?></label>
                    </div>
                </div>
                <span class="text-right tzinst-plugin__actions">
                    <a href="javascript:"
                       class="js-tzinst-plugin__install-all text-danger d-none"><?php
                        echo __('Install Selected', $this -> text_domain); ?></a>
                    <a href="javascript:"
                       class="js-tzinst-plugin__update-all text-info d-none"><?php
                        echo __('Update Selected', $this -> text_domain); ?></a>
                    <a href="javascript:"
                       class="js-tzinst-plugin__activate-all text-primary d-none"><?php
                        echo __('Activate Selected', $this -> text_domain); ?></a>
                </span>
            </div>
            <div class="items mh-px-300 pt-2 overflow-auto">
                <?php

                foreach($this -> item['plugins'] as $plugin_code => $plugin){
                    $plugin_slug        = isset($plugin['slug'])?$plugin['slug']:$plugin_code;
                    $installedVersion   = Admin_Page_Function::get_plugin_version_by_slug($plugin_slug);
                    $canUpdate          = $installedVersion && isset($plugin['version']) && $plugin['version'] && version_compare($plugin['version'], $installedVersion, '>');
                    ?>
                    <div class="d-flex justify-content-between w-100 mb-2 pl-2 small text-muted item" data-plugin-item>
                        <div class="w-100 flex-1 title">
                            <div class=" custom-control custom-checkbox d-inline-block bg-white">
                                <input type="checkbox" class="custom-control-input" id="tzinst-checkbox__plugin-<?php
                                echo $plugin_slug; ?>"<?php echo (Admin_Page_Function::is_plugin_active($plugin_slug) && !$canUpdate)?' disabled':''; ?>>
                                <label class="position-relative custom-control-label" for="tzinst-checkbox__plugin-<?php
                                echo $plugin_slug; ?>"><?php echo $plugin['name']; ?></label>
                            </div>
                            <?php
                            if($canUpdate){
                            ?>
                            <span class="badge badge-danger"><?php echo __('New version', $this -> text_domain); ?></span>
                            <?php } ?>
                        </div>
                        <span class="">
                            <?php
                            $btnText        = 'Install';
                            $btnClass       = ' text-danger install';
                            if($canUpdate){
                                $btnText    = 'Update';
                                $btnClass   = ' text-info update';
                            }else{
                                if(Admin_Page_Function::is_plugin_active($plugin_slug)){
                                    $btnText    = 'Activated';
                                    $btnClass   = ' text-success activated';
                                }elseif(Admin_Page_Function::is_plugin_installed($plugin_slug)){
                                        $btnText    = 'Activate';
                                        $btnClass   = ' text-primary activate';
                                }
                            }
                            ?>
                            <a href="javascript:"
                               class="js-tzinst-plugin__install<?php echo $btnClass;?>"
                               data-plugin="<?php echo esc_attr($plugin_slug); ?>"
                               data-nonce="<?php echo esc_attr(wp_create_nonce(TEMPLAZA_FRAMEWORK_NAME.'-action')); ?>"
                               data-plugin_name="<?php echo esc_attr($plugin['name']);?>"
                               data-tgmpa_nonce="<?php echo esc_attr( wp_create_nonce( 'tgmpa-install' ) ); ?>"
                               data-tgmpa-update_nonce="<?php echo esc_attr( wp_create_nonce( 'tgmpa-update' ) ); ?>"
                               data-tgmpa-activate_nonce="<?php echo esc_attr( wp_create_nonce( 'tgmpa-activate' ) ); ?>"><?php
                                echo __($btnText, $this -> text_domain); ?></a>
                        </span>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
