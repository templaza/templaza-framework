<?php
/* Base importer layout */

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Admin_Functions;
use TemPlazaFramework\Helpers\HelperLicense;
use TemPlazaFramework\Admin\Admin_Page_Function;

$items  = method_exists($this, 'get_theme_demo_datas')?$this -> get_theme_demo_datas():array();

if($items && count($items)){
    $optImported    = get_option($this -> imported_key, array());
    if(isset($optImported['pack']) && !is_array($optImported['pack'])){
        $optImported['pack']    = (array) $optImported['pack'];
    }
    $pass       = Admin_Functions::check_system_requirement();
    ?>
    <div class="tzinst-demo-import<?php echo !HelperLicense::is_authorised($this -> theme_name)?' no-license':''?>">
        <div class="uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-3@l" data-uk-grid>
            <?php foreach($items as $code => $item){
                $theme_name             = isset($item['slug'])?$item['slug']:$code;
                $this -> item           = $item;
                $this -> product_code   = $theme_name;

                $isImported = isset($optImported['pack']) && in_array($theme_name, $optImported['pack']);
                ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-small uk-border-rounded uk-overflow-hidden">
                        <div class="uk-card-media-top">
                            <img src="<?php echo esc_url($item['thumb']); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="uk-width-1-1"/>
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title"><?php echo esc_html($item['title']); ?><?php
                                if(isset($optImported['pack']) && in_array($theme_name, $optImported['pack'] )) {
                                    ?><sup class="badge badge-success btn-sm font-weight-normal uk-label uk-label-success uk-text-normal uk-text-capitalize uk-text-capitalize uk-margin-small-left uk-margin-small-bottom"><?php
                                    echo esc_html__('Imported', 'templaza-framework'); ?></sup><?php
                                }?></h3>
                            <p><?php echo esc_html($item['desc']);?></p>
                        </div>
                        <div class="action uk-padding-small uk-padding-remove-top uk-flex uk-flex-wrap">
                            <?php if(isset($item['demo-datas']) && count($item['demo-datas'])){ ?>
                                <button type="button" data-toggle="modal" data-target="#tzinst-modal__import-<?php
                                echo !$pass?'sysinfo-'.esc_attr($item['slug']):esc_attr($theme_name); ?>" data-uk-toggle="target: #tzinst-modal__import-<?php
                                echo !$pass?'sysinfo-'.esc_attr($item['slug']):esc_attr($theme_name); ?>" class="uk-button uk-button-primary uk-margin-small-bottom uk-width-1-1" data-install-demo-data><?php
                                    esc_html_e('Install Demo Data', 'templaza-framework');
                                    ?></button>
                            <?php } ?>
                            <div class="uk-button-group uk-width-1-1">
                                <?php if(isset($item['demo_url']) && !empty($item['demo_url'])){ ?>
                                    <a href="<?php echo esc_url($item['demo_url']); ?>" target="_blank" class="uk-button uk-button-default uk-margin-small-bottom uk-width-1-1"><?php
                                        esc_html_e('Preview', 'templaza-framework');
                                        ?></a>
                                <?php } ?>
                                <?php if(isset($item['doc_url']) && !empty($item['doc_url'])){ ?>
                                    <a href="<?php echo esc_url($item['doc_url']); ?>" target="_blank" class="uk-button uk-button-default uk-margin-small-bottom uk-width-1-1"><?php
                                        esc_html_e('Manual', 'templaza-framework');
                                        ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($item['demo-datas']) && count($item['demo-datas']) && !HelperLicense::has_expired($this -> theme_name)){ ?>
                        <?php if(!$pass || $isImported){ ?>
                            <div id="tzinst-modal__import-sysinfo-<?php echo esc_attr($item['slug']); ?>" data-uk-modal>
                                <div class="uk-modal-dialog">
                                    <div class="uk-modal-body uk-text-danger">
                                        <?php if(!$pass){ ?>
                                        <p><?php $text = esc_html__('Currently, there are some values in PHP settings not sufficient enough for the theme to work properly. Please configure them again to ensure the theme has a smooth performance.', 'templaza-framework');
                                            echo esc_html($text);
                                            ?></p>
                                        <?php } ?>
                                        <?php
                                        /* Confirm clear data first */
                                        if($isImported) {
                                        ?>
                                        <p><?php
                                            // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
                                            /* translators: %s - Supported. */
                                            $text = esc_html__('Before importing the demo content of this theme, we suggest that you should clear the database of the current theme
                                            You can refer to "<a href=\'%s\' target=\'_blank\'>WordPress Database Reset</a>" plugin to implement the database reset.', 'templaza-framework');
                                            echo sprintf($text, esc_url(admin_url('plugin-install.php?s=WordPress%2520Database%2520Reset&tab=search&type=term')));
                                            ?></p>
                                        <?php } ?>
                                        <p><?php esc_html_e('Do you want to continue import demo data?', 'templaza-framework');?></p>
                                        <div class="action uk-margin-small-top">
                                            <a class="uk-button uk-button-danger uk-button-small" target="_blank" href="<?php
                                            echo esc_url(admin_url('admin.php?page=templaza-framework#system-information'));
                                            ?>"><?php esc_html_e('See PHP Settings', 'templaza-framework');?></a>
                                        </div>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button class="uk-button uk-button-default uk-modal-close" type="button"><?php
                                            esc_html_e('Cancel', 'templaza-framework');?></button>
                                        <a href="#tzinst-modal__import-<?php echo esc_attr($theme_name);
                                        ?>" class="uk-button uk-button-primary" uk-toggle><?php
                                            esc_html_e('Ok', 'templaza-framework');?></a>
                                    </div>
                                </div>
                            </div>
                        <?php }?>

                        <div id="tzinst-modal__import-<?php echo esc_attr($theme_name);
                        ?>" tabindex="-1" role="dialog" data-install-demo-data__modal data-modal-title="<?php
                        /* translators: %s - Supported. */
                        echo esc_attr(sprintf(esc_html__('Demo Content Pack » %s', 'templaza-framework'), esc_html($item['title'])));
                        ?>" uk-modal="bg-close: false;">
                            <div class="uk-modal-dialog uk-width-2xlarge">
                                <div class="uk-modal-header">
                                    <h3 class="uk-modal-title"><?php
                                        /* translators: %s - Supported. */
                                        echo esc_attr(sprintf(esc_html__('Demo Content Pack » %s', 'templaza-framework'), esc_html($item['title'])));
                                        ?></h3>
                                </div>
                                <div class="uk-modal-body" uk-overflow-auto>
                                    <?php if(isset($optImported['pack']) && $optImported['pack'] == $theme_name) { ?>
                                        <div class="alert alert-warning"><?php echo esc_html__('The data of Home Version 1 has been imported. You should consider importing it again, because it may cause duplicated data.', 'templaza-framework'); ?></div>
                                    <?php } ?>
                                    <div data-import-message-box></div>
                                    <?php echo $this -> load_template('plugins'); ?>
                                    <?php echo $this -> load_template('demo_datas'); ?>
                                </div>
                                <div class="uk-modal-footer uk-text-right uk-position-relative">
                                    <div class="js-processing-box processing-box uk-margin-small-bottom uk-hidden">
                                        <div class="progress uk-position-absolute uk-width-1-1 uk-position-top-left rounded-0">
                                            <progress class="uk-progress uk-border-square" value="" max="100"></progress>
                                        </div>
                                    </div>
                                    <div class="action">
                                        <button type="button" class="uk-button uk-button-default uk-margin-small-right uk-modal-close" data-dismiss="modal"><?php
                                            echo esc_html__('Close', 'templaza-framework'); ?></button>
                                        <button type="button" class="uk-button uk-button-danger uk-margin-small-right uk-hidden" data-tzinst-stop-importing><?php
                                            echo esc_html__('Stop Importing', 'templaza-framework'); ?></button>
                                        <button type="button" class="uk-button uk-button-primary js-tzinst-import">
                                            <span class="spinner-border spinner-border-sm uk-margin-small-right uk-hidden js-tzinst-importing-icon"></span>
                                            <span class="js-tzinst-installing"><?php
                                                esc_html_e('Install Demo Data', 'templaza-framework');
                                            ?></span>
                                            <span class="js-tzinst-installed uk-hidden"><?php
                                                esc_html_e('Installed', 'templaza-framework');
                                            ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            <?php } ?>
        </div>
    </div>
<?php } ?>