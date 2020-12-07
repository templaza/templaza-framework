<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
?>
<script type="text/html" id="tmpl-field-tz_layout-list__items">
    <?php if($this -> elements && count($this -> elements)){ ?>
        <div data-fl_tz_layout-elements data-modal-title="<?php
        echo esc_html__('Add Element', $this -> text_domain);?>" class="hide">
            <div class="fl_ui-panel-content-container mx-n1">
                <div class="fl_add-element-container container-fluid">
                    <div class="row">
                        <?php foreach($this -> elements as $el){
                            $element    = $el -> get_element();
//                            var_dump($element);
                            if(isset($element['core']) && (bool) $element['core']){
                                continue;
                            }
//                            if(in_array($element['id'], $this -> field['core'])){
//                                continue;
//                            }
                            $icon   = isset($element['icon'])?$element['icon']:'fab fa-wordpress-simple';
                            ?>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 px-1 py-1">
                                <div data-element="<?php echo $element['id']; ?>" class="fl-layout-element-button">
                                    <div class="media d-block d-sm-flex">
                                        <i class="fl_element-icon mr-2 align-self-center <?php
                                        echo $icon; ?>" data-fl-element-icon="<?php echo $icon; ?>"></i>
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-0" data-fl-element-name><?php echo $element['title']; ?></h4>
                                            <small><?php echo $element['desc']; ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</script>
