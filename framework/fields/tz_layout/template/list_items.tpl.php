<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
?>
<script type="text/html" id="tmpl-field-tz_layout-list__items">
    <?php if($this -> elements && count($this -> elements)){ ?>
        <div data-fl_tz_layout-elements data-modal-title="<?php
        echo esc_html__('Add Element', $this -> text_domain);?>" class="hide">
            <div class="fl_ui-panel-content-container">
                <div class="fl_add-element-container">
                    <div class="uk-child-width-1-6@m uk-child-width-1-4@s uk-grid-small" data-uk-grid>
                        <?php foreach($this -> elements as $el){
                            $element    = $el -> get_element();
                            if(isset($element['core']) && (bool) $element['core']){
                                continue;
                            }
                            $icon   = isset($element['icon'])?$element['icon']:'fab fa-wordpress-simple';
                            ?>
                            <div class="">
                                <div data-element="<?php echo $element['id']; ?>" class="fl-layout-element-button">
                                    <div class="media uk-flex uk-flex-column uk-flex-middle px-1 py-4">
                                        <i class="fl_element-icon mx-0 <?php
                                        echo $icon; ?>" data-fl-element-icon="<?php echo $icon; ?>"></i>
                                        <div class="media-body uk-flex uk-flex-column uk-text-center uk-flex-middle mt-3">
                                            <h6 class="mt-0 mb-2" data-fl-element-name><?php echo $element['title']; ?></h6>
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
