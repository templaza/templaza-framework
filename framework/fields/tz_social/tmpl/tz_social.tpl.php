<?php

defined('TEMPLAZA_FRAMEWORK') or exit;
?>

<script type="text/html" id="tmpl-tzfrm-field-tz_social__<?php echo $this -> field['id'];?>-source">
    <#
    var data_source = JSON.stringify(data);
    #>
    <div class="card mb-2 social-profile-item" data-source="{{data_source}}">
        <div class="border radius p-2 ng-binding"><i class="{{{data.icon}}}"></i> {{{data.title}}}</div>
    </div>
</script>
<script type="text/html" id="tmpl-tzfrm-field-tz_social__<?php echo $this -> field['id'];?>-form">
    <div class="card mb-2 tz-social-item">
        <#
        var title = (typeof data.title !== "undefined" && data.title.trim().length)?data.title:"<?php echo __('Custom social profile', 'templaza-framework');?>";
        #>
        <div class="card-header">
            <span><i class="<# if (data.icon){ #>{{{data.icon}}}<# }else if (data.icon_class){ #>{{{data.icon_class}}}<# } #>" style="<# if (data.color){ #>color: {{{data.color}}}<# } #>"></i> {{{title}}}</span>
            <span class="text-danger float-right" style="cursor: pointer" data-delete-form-item><i class="fa fa-trash"></i></span>
            <div class="clearfix"></div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <label><?php echo __('Link', 'templaza-framework');?></label>
                </div>
                <div class="col-sm-8">
                    <#
                    var link_placeholder = 'https://example.com';
                    if(typeof data.link_placeholder !== "undefined"){
                    link_placeholder = data.link_placeholder;
                    }
                    #>
                    <input type="text" data-input="link" placeholder="{{{link_placeholder}}}" value="{{{data.link}}}"  class="form-control w-100" autocomplete="off" style=""/>
                </div>
            </div>
            <# if (data.icons && data.icons.length > 1){ #>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <label><?php echo __('Icon', 'templaza-framework');?></label>
                </div>
                <div class="col-sm-8">
                    <ul class="list-inline m-0">
                        <# _.each( data.icons, function( value, key ) { #>
                        <li class="select-icon ng-scope<# if (value === data.icon){ #> active<# } #>"><i class="{{{value}}}"></i></li>
                        <# }); #>
                    </ul>
                </div>
            </div>
            <# }else if(data.icon.length == 0 || (data.icon.length > 0 && data.icons.length == 0)){ #>
            <div class="row mt-2">
                <div class="col-sm-4">
                    <label><?php echo __('Icon Class', 'templaza-framework'); ?></label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control w-100" autocomplete="off" data-input="icon" value="{{{data.icon}}}" placeholder="fab fa-youtube"/>
                </div>
            </div>
            <div class="mt-2 row">
                <div class="col-sm-4">
                    <label><?php echo __('Color', 'templaza-framework'); ?></label>
                </div>
                <div class="col-sm-8">
                    <div class="redux-color-rgba-container " data-id="color" data-show-input="1"
                         data-show-initial="" data-show-alpha="1" data-show-palette="" data-show-palette-only="" data-show-selection-palette="" data-max-palette-size="10" data-allow-empty="1" data-clickout-fires-change="" data-choose-text="Choose" data-cancel-text="Cancel" data-input-text="Select Color" data-show-buttons="1" data-palette="null">

                        <input type="text" data-input="color" data-block-id="<?php echo $this -> field['id'];
                        ?>-tz_social-{{{data.random_id}}}" class="form-control redux-color-rgba" autocomplete="off" id="<?php
                        echo $this -> field['id']; ?>-tz_social-color" data-current-color="{{{data.color}}}" data-color="{{{data.color}}}"/>
                        <input type="hidden" class="redux-hidden-alpha" data-id="<?php
                        echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-alpha" id="<?php
                        echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-alpha" value="">
                        <input type="hidden" class="redux-hidden-alpha" data-id="<?php
                        echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-rgba" id="<?php
                        echo $this -> field['id'].'-tz_social'; ?>-{{{data.random_id}}}-rgba" value=""/>
                    </div>
                </div>
            </div>
            <# } #>
        </div>
    </div>
</script>