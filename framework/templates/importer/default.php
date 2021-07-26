<?php
/* Base importer layout */

use TemPlazaFramework\Helpers\HelperLicense;

$items  = method_exists($this, 'get_theme_demo_datas')?$this -> get_theme_demo_datas():array();

if($items && count($items)){
    $optImported    = get_option($this -> imported_key, array());
    if(isset($optImported['pack']) && !is_array($optImported['pack'])){
        $optImported['pack']    = (array) $optImported['pack'];
    }
?>
<div class="tzinst-demo-import<?php echo !HelperLicense::is_authorised($this -> theme_name)?' no-license':''?>">
    <div class="row">
        <?php foreach($items as $code => $item){
            $theme_name             = isset($item['slug'])?$item['slug']:$code;
            $this -> item           = $item;
            $this -> product_code   = $theme_name;
            ?>
        <div class="col-md-3 mb-4">
            <div class="card rounded-3 p-0 mt-0 border-0 h-100 box">
                <img class="card-img-top mw-100 rounded-top" src="<?php echo $item['thumb']; ?>" alt="<?php echo $item['title']; ?>"/>
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="card-title"><?php echo $item['title']; ?><?php
                    if(isset($optImported['pack']) && in_array($theme_name, $optImported['pack'] )) {
                        ?><small class="badge badge-success btn-sm font-weight-normal"><?php
                        echo __('Imported', $this -> text_domain); ?></small><?php
                    }?></h5>
                    <p class="card-text"><?php echo $item['desc'];?></p>
                    <?php if(HelperLicense::is_authorised($this -> theme_name)){ ?>
                    <div class="d-flex justify-content-between mt-auto action">
                        <?php if(isset($item['demo-datas']) && count($item['demo-datas'])){ ?>
                        <button type="button" data-toggle="modal" data-target="#tzinst-modal__import-<?php
                        echo $theme_name; ?>" class="btn btn-sm btn-primary w-100 mr-2" data-install-demo-data><?php
                            _e('Install Demo Data', $this -> text_domain);
                            ?></button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-outline-primary mr-2"><?php
                            _e('Preview', $this -> text_domain);
                            ?></button>
                        <button type="button" class="btn btn-sm btn-outline-primary"><?php
                            _e('Manual', $this -> text_domain);
                            ?></button>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <?php if(isset($item['demo-datas']) && count($item['demo-datas']) && !HelperLicense::has_expired($this -> theme_name)){ ?>
            <div id="tzinst-modal__import-<?php echo $theme_name;
            ?>" class="modal fade" tabindex="-1" role="dialog" data-install-demo-data__modal data-modal-title="<?php
            echo esc_attr(sprintf(__('Demo Content Pack » %s', $this -> text_domain), $item['title']));
            ?>">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
<!--                        <div class="modal-header">-->
<!--                            <h5 class="modal-title">--><?php //echo sprintf(__('Demo Content Pack » %s', $this -> text_domain), $item['title']);?><!--</h5>-->
<!--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                <span aria-hidden="true">&times;</span>-->
<!--                            </button>-->
<!--                        </div>-->
                        <div class="modal-body">
                            <?php if(isset($optImported['pack']) && $optImported['pack'] == $theme_name) { ?>
                            <div class="alert alert-warning"><?php echo _e('The data of Home Version 1 has been imported. You should consider importing it again, because it may cause duplicated data.', $this -> text_domain); ?></div>
                            <?php } ?>
                            <div data-import-message-box></div>
                            <?php echo $this -> load_template('plugins'); ?>
                            <?php echo $this -> load_template('demo_datas'); ?>
                        </div>
                        <div class="modal-footer position-relative">
                            <div class="js-processing-box processing-box mb-3 d-none">
                                <div class="progress position-absolute w-100 fixed-top rounded-0">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                            </div>
                            <div class="action">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php
                                    echo _e('Close', $this -> text_domain); ?></button>
                                <button type="button" class="btn btn-danger d-none" data-tzinst-stop-importing><?php
                                    echo _e('Stop Importing', $this -> text_domain); ?></button>
                                <button type="button" class="btn btn-primary js-tzinst-import">
                                    <span class="spinner-border spinner-border-sm mb-1 mr-1"></span><?php
                                    _e('Install Demo Data', $this -> text_domain);
                                    ?></button>
                            </div>
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