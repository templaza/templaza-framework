<?php
defined('TEMPLAZA_FRAMEWORK') or exit();
?>
<script type="text/html" id="tmpl-field-tz_layout-template__element">
    <div class="fl_content_element" data-fl-element_type="{{{data.type}}}" data-icon="{{{data.icon}}}" data-title="{{{data.title}}}">
        <div class="fl_controls">
            <a href="#" class="fl_control fl_column-edit" data-fl-control="edit" data-uk-tooltip="<?php
            echo esc_html__('Edit Element', 'templaza-framework'); ?>"><i class="far fa-edit"></i></a>
            <a href="#" class="fl_control fl_column-clone" data-fl-control="clone" data-uk-tooltip="<?php
            echo esc_html__('Duplicate Element', 'templaza-framework'); ?>"><i class="far fa-copy"></i></a>
            <a href="#" class="fl_control fl_column-delete" data-fl-control="delete" data-uk-tooltip="<?php
            echo esc_html__('Delete Element', 'templaza-framework'); ?>"><i class="far fa-trash-alt"></i></a>
        </div>
        <div class="fl_element-wrapper">
            <span class="fl_element-title">
                <i class="fl_element-icon {{{data.icon}}}"></i>
                <span class="title">{{{data.title}}}</span>
                <# if(typeof data.admin_label !== typeof undefined && data.admin_label && data.admin_label.length){ #>
                <small class="admin-label">{{{data.admin_label}}}</small>
                <# } #>
            </span>
        </div>
    </div>
</script>
