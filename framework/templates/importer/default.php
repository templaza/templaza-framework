<?php
/* Base importer layout */

defined('TEMPLAZA_FRAMEWORK') or exit();

use TemPlazaFramework\Helpers\HelperLicense;

$items  = method_exists($this, 'get_theme_demo_datas')?$this -> get_theme_demo_datas():array();

if($items && count($items)){
    $optImported    = get_option($this -> imported_key, array());
    if(isset($optImported['pack']) && !is_array($optImported['pack'])){
        $optImported['pack']    = (array) $optImported['pack'];
    }
    ?>
    <div class="tzinst-demo-import<?php echo !HelperLicense::is_authorised($this -> theme_name)?' no-license':''?>">
        <div class="uk-child-width-expand@s" uk-grid>
            <?php foreach($items as $code => $item){
                $theme_name             = isset($item['slug'])?$item['slug']:$code;
                $this -> item           = $item;
                $this -> product_code   = $theme_name;

                ?>
            <div class="uk-width-1-3">
                <div class="uk-card uk-card-default uk-card-small uk-border-rounded uk-overflow-hidden">
                    <div class="uk-card-media-top">
                        <img src="<?php echo $item['thumb']; ?>" alt="<?php echo $item['title']; ?>"/>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title"><?php echo $item['title']; ?><?php
                            if(isset($optImported['pack']) && in_array($theme_name, $optImported['pack'] )) {
                                ?><small class="badge badge-success btn-sm font-weight-normal"><?php
                                echo __('Imported', $this -> text_domain); ?></small><?php
                            }?></h3>
                        <p><?php echo $item['desc'];?></p>
                    </div>
                    <div class="action uk-padding-small uk-padding-remove-top uk-flex uk-flex-wrap">
                        <?php if(isset($item['demo-datas']) && count($item['demo-datas'])){ ?>
                            <button type="button" data-toggle="modal" data-target="#tzinst-modal__import-<?php
                            echo $theme_name; ?>" uk-toggle="target: #tzinst-modal__import-<?php
                            echo $theme_name; ?>" class="uk-button uk-button-primary uk-margin-small-bottom uk-width-1-1" data-install-demo-data><?php
                                _e('Install Demo Data', $this -> text_domain);
                                ?></button>
                        <?php } ?>
                        <div class="uk-button-group uk-width-1-1">
                            <?php if(isset($item['demo_url']) && !empty($item['demo_url'])){ ?>
                                <a href="<?php echo $item['demo_url']; ?>" target="_blank" class="uk-button uk-button-default uk-margin-small-bottom uk-width-1-1"><?php
                                    _e('Preview', $this -> text_domain);
                                    ?></a>
                            <?php } ?>
                            <?php if(isset($item['doc_url']) && !empty($item['doc_url'])){ ?>
                                <a href="<?php echo $item['doc_url']; ?>" target="_blank" class="uk-button uk-button-default uk-margin-small-bottom uk-width-1-1"><?php
                                    _e('Manual', $this -> text_domain);
                                    ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if(isset($item['demo-datas']) && count($item['demo-datas']) && !HelperLicense::has_expired($this -> theme_name)){ ?>
                    <div id="tzinst-modal__import-<?php echo $theme_name;
                    ?>" tabindex="-1" role="dialog" data-install-demo-data__modal data-modal-title="<?php
                    echo esc_attr(sprintf(__('Demo Content Pack » %s', $this -> text_domain), $item['title']));
                    ?>" uk-modal="bg-close: false;">
                        <div class="uk-modal-dialog uk-width-2xlarge">
                            <div class="uk-modal-header">
                                <h3 class="uk-modal-title"><?php
                                    echo esc_attr(sprintf(__('Demo Content Pack » %s', $this -> text_domain), $item['title']));
                                    ?></h3>
                            </div>
                            <div class="uk-modal-body" uk-overflow-auto>
                                <?php if(isset($optImported['pack']) && $optImported['pack'] == $theme_name) { ?>
                                    <div class="alert alert-warning"><?php echo _e('The data of Home Version 1 has been imported. You should consider importing it again, because it may cause duplicated data.', $this -> text_domain); ?></div>
                                <?php } ?>
                                <div data-import-message-box></div>
                                <?php echo $this -> load_template('plugins'); ?>
                                <?php echo $this -> load_template('demo_datas'); ?>
                            </div>
                            <div class="uk-modal-footer uk-text-right uk-position-relative">
                                <!--                                    <div class="js-processing-box processing-box uk-margin-small-bottom uk-hidden">-->
                                <!--                                        <progress class="uk-progress js-progress-bar uk-position-top progress-rounded-0" value="10" max="100"></progress>-->
                                <!--                                    </div>-->
                                <div class="js-processing-box processing-box uk-margin-small-bottom uk-hidden">
                                    <div class="progress uk-position-absolute uk-width-1-1 uk-position-top-left rounded-0">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated js-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="action">
                                    <button type="button" class="uk-button uk-button-default uk-margin-small-right uk-modal-close" data-dismiss="modal"><?php
                                        echo _e('Close', $this -> text_domain); ?></button>
                                    <button type="button" class="uk-button uk-button-danger uk-margin-small-right uk-hidden" data-tzinst-stop-importing><?php
                                        echo _e('Stop Importing', $this -> text_domain); ?></button>
                                    <button type="button" class="uk-button uk-button-primary js-tzinst-import">
                                        <span class="spinner-border spinner-border-sm uk-margin-small-right uk-hidden js-tzinst-importing-icon"></span><?php
                                        _e('Install Demo Data', $this -> text_domain);
                                        ?></button>
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